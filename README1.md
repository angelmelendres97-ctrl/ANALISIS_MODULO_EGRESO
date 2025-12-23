# README 1 – Análisis funcional y técnico del Módulo de Egreso

## Propósito y alcance
Este documento describe de forma funcional y técnica el Módulo de Egreso orientado al pago a proveedores. Resume la arquitectura, los componentes principales, los flujos de ejecución y las operaciones sobre datos que soportan la registración contable de egresos.

## Arquitectura general
- **Frontend PHP/JS (`egreso.php`)**: construye el formulario de egreso, carga estilos y librerías (Bootstrap, DataTables) y define funciones JavaScript que delegan en el servidor vía Xajax (por ejemplo `guardar()`, `consultar()`, `anadir_mp()`), habilitando interacción asíncrona desde la interfaz.【F:egreso.php†L1-L120】【F:egreso.php†L121-L210】
- **Controlador Xajax (`_Ajax.server.php`)**: centraliza la lógica del proceso de egreso, atendiendo las llamadas asíncronas para generar grids, validar saldos, registrar asientos y persistir adjuntos. Maneja sesiones de usuario y conexiones a la base de datos (PostgreSQL/Informix) a través de la clase `Dbo`.【F:_Ajax.server.php†L5751-L5839】
- **Servicios de mayorización (`mayorizacion.inc.php`)**: encapsulan reglas de negocio contable (secuenciación de asientos, generación de asientos en `saeasto`, detalle diario `saedasi` y cheques `saedchc`).【F:mayorizacion.inc.php†L11-L107】【F:mayorizacion.inc.php†L149-L200】
- **Recursos auxiliares**: hojas de estilo, scripts de autocompletado/búsqueda (`buscar_cliente.php`, `buscar_cuentas.php`) y vistas previas de comprobantes complementan la experiencia de usuario.

## Flujo funcional de un egreso
1. **Captura de datos**: el usuario ingresa empresa, sucursal, proveedor, fecha, monto, moneda y detalle desde `egreso.php`. Validaciones en cliente evitan guardar si el asiento ya existe o si no se completa la información básica.【F:egreso.php†L151-L210】
2. **Envío asíncrono**: las acciones de búsqueda, cálculo y guardado se envían a Xajax, que mantiene los grids de diario, retenciones y directorio en variables de sesión (`aDataGirdDiar`, `aDataGirdRet`, `aDataGirdDir`).【F:_Ajax.server.php†L5751-L5799】
3. **Validación contable**: antes de persistir, se calcula que los débitos y créditos locales y extranjeros se encuentren balanceados. Si la diferencia es cero y existen líneas, se continúa; de lo contrario, el guardado no se ejecuta.【F:_Ajax.server.php†L5805-L5828】
4. **Mayorización y secuencias**: se abre transacción Informix, se solicita el siguiente secuencial de asiento y comprobante de egreso (`secu_asto`, `secu_dia`) según empresa, sucursal y tipo documental (`TIDU`).【F:_Ajax.server.php†L5830-L5841】【F:mayorizacion.inc.php†L66-L107】
5. **Actualización de adjuntos**: cualquier documento pendiente de proveedor se vincula al asiento recién generado y se eliminan adjuntos en estado pendiente tras la asociación.【F:_Ajax.server.php†L5844-L5858】
6. **Persistencia de cabecera (SAEASTO)**: se inserta el asiento contable con datos de empresa, ejercicio, período, moneda, beneficiario y detalle descriptivo del egreso.【F:mayorizacion.inc.php†L111-L147】
7. **Detalle de directorio (SAEDIR)**: por cada factura/retención seleccionada se graba su vencimiento, detalle y montos en moneda local y extranjera, vinculando cliente/proveedor y solicitud de compra si aplica.【F:_Ajax.server.php†L5900-L5950】
8. **Detalle diario (SAEDASI)**: se recorren las líneas contables para registrar débitos/créditos, centros de costo y actividades. Si la línea corresponde a pago bancario se marca como bancaria y se asocia formato/fecha de cheque.【F:_Ajax.server.php†L6078-L6172】
9. **Registro de cheques (SAEDCHC)**: cuando la línea posee cuenta bancaria se inserta el cheque emitido y se actualiza el correlativo en la cuenta bancaria (`saectab`).【F:_Ajax.server.php†L6174-L6197】
10. **Commit/Rollback**: todas las inserciones se ejecutan dentro de la transacción informix; en caso de error se revierte para preservar la integridad del asiento (manejado por `try`/catch en la función `guardar`).【F:_Ajax.server.php†L5829-L5836】

## Componentes y responsabilidades principales
- **`egreso.php`**: interfaz de usuario, controles de búsqueda y validación previa, disparo de eventos Xajax.
- **`_Ajax.server.php`**: orquestación del flujo; valida balance, prepara secuencias, inserta cabecera/detalle/retenciones/cheques, y actualiza adjuntos.
- **`mayorizacion.inc.php`**: funciones reutilizables para obtener moneda base, tipo de cambio, secuenciales (`saesecu`) e inserciones en tablas contables principales.

## Tablas y operaciones SQL involucradas
- **`saepcon`**: consulta de moneda base (`pcon_mon_base`) y cuentas de utilidad/pérdida para decisiones contables.【F:mayorizacion.inc.php†L15-L27】【F:_Ajax.server.php†L6467-L6474】
- **`saetcam`**: obtención de tipo de cambio vigente para el asiento.【F:mayorizacion.inc.php†L19-L27】
- **`saesecu`**: lectura y actualización de secuenciales de diario y egreso por empresa/sucursal/ejercicio/período.【F:mayorizacion.inc.php†L66-L107】
- **`saeasto`**: inserción de cabecera del asiento de egreso con beneficiario, detalle, tipo documental y usuario.【F:mayorizacion.inc.php†L111-L147】
- **`saedir`**: inserción de detalle de documentos/facturas afectados por el egreso, incluyendo vencimiento, cotización y montos.【F:_Ajax.server.php†L5900-L5950】
- **`saedasi`**: detalle diario contable, registra cuentas, centros de costo, montos en monedas local/extranjera y banderas de banco/cheque.【F:mayorizacion.inc.php†L149-L200】【F:_Ajax.server.php†L6078-L6172】
- **`saedchc`** y **`saectab`**: manejo de cheques emitidos y actualización del correlativo por cuenta bancaria.【F:_Ajax.server.php†L6174-L6197】
- **Tablas complementarias**: `saeclpv` (datos de proveedor), `saedire` (dirección), `saeemai` (correo) para completar retenciones y beneficiarios.【F:_Ajax.server.php†L5924-L5944】

## Validaciones y controles clave
- Balance de débitos/créditos antes de grabar (`tot_loc`, `tot_ext`).【F:_Ajax.server.php†L5805-L5823】
- Evita duplicar egresos ya registrados verificando códigos existentes en el formulario (validación en `guardar()` JS).【F:egreso.php†L151-L180】
- Reglas de negocio para retenciones y cheques se aplican al iterar los grids de sesión, asegurando consistencia de montos y referencias de proveedor.【F:_Ajax.server.php†L5900-L5950】【F:_Ajax.server.php†L6078-L6172】

## Trazabilidad del pago a proveedores
Cada egreso queda ligado a:
- **Proveedor** (`clpv_cod`, `clpv_nom`) y su RUC/dirección/correo obtenidos en tiempo de guardado.【F:_Ajax.server.php†L5924-L5944】
- **Documentos** de respaldo (facturas/retenciones) a través de `saedir` y las líneas diarias `saedasi`.
- **Medio de pago** mediante registros en `saedchc` y actualización de cuentas bancarias.
- **Adjuntos** asociados al proveedor, vinculados al número de asiento para trazabilidad documental.【F:_Ajax.server.php†L5844-L5858】

## Integración y comunicación asíncrona
Las funciones JavaScript del frontend invocan métodos Xajax que retornan HTML de grids y actualizaciones parciales, evitando recargar la página. Los controladores `_Ajax.server.php` generan respuestas `xajaxResponse` con contenido y scripts que mantienen sincronizados los totales, listados y validaciones en el navegador.【F:_Ajax.server.php†L5731-L5744】【F:egreso.php†L121-L150】

