# README 1 – Análisis funcional y técnico del Módulo de Egreso

## Visión general del flujo de egresos
El módulo se orquesta desde `egreso.php`, donde se cargan los recursos front-end (Bootstrap, DataTables y scripts utilitarios) y se declaran las funciones JavaScript que coordinan la interacción con el servidor mediante llamadas XAJAX y ventanas auxiliares (`AjaxWin`, `window.open`). Las acciones principales son:

- Generar el formulario y catálogos dependientes (empresa, sucursal, transacción) vía `xajax_genera_formulario` y derivadas (`cargar_sucu`, `cargar_tran`).【F:egreso.php†L51-L125】
- Seleccionar beneficiarios (clientes/proveedores o empleados), facturas, códigos de retención y cuentas contables mediante pop‑ups invocados con teclas rápidas (Enter/F4).【F:egreso.php†L63-L195】
- Gestionar la persistencia con `guardar()`, que valida el formulario y dispara `xajax_guardar` para registrar el egreso solo cuando no existe un asiento previo.【F:egreso.php†L87-L99】
- Operar los grids dinámicos de directorio (facturas a pagar), retenciones y diario contable a través de funciones `xajax_agrega_modifica_*`, junto con generación de PDF y cheques.【F:egreso.php†L115-L360】

La comunicación asíncrona se centraliza en `_Ajax.comun.php`, que instancia el servidor XAJAX y registra todas las funciones disponibles para la capa de presentación, abarcando directorio, retenciones, diario, cheques, préstamos, nómina, adjuntos y generación de documentos/PDF.【F:_Ajax.comun.php†L22-L135】 Estas funciones se implementan en `_Ajax.server.php` y archivos auxiliares.

## Componentes y responsabilidades
- **Interfaz (egreso.php):** arma el formulario de egreso, captura eventos de usuario y envía solicitudes asíncronas. Controla modales para búsqueda de facturas, cheques, préstamos y parámetros de pago.
- **Servidor XAJAX (`_Ajax.comun.php` / `_Ajax.server.php`):** expone métodos para poblar catálogos, validar períodos, calcular retenciones, registrar asientos, generar reportes y gestionar adjuntos. `_Ajax.server.php` también arma los grids HTML de directorio, diario y retención en respuestas AJAX.
- **Lógica contable (`mayorizacion.inc.php`):** encapsula la creación de asientos, actualiza secuenciales de comprobantes y persiste en tablas contables (saeasto, saedasi, saedir, saeret).【F:mayorizacion.inc.php†L11-L347】
- **Vistas auxiliares:** archivos como `buscar_factura.php`, `buscar_cliente.php`, `cheque.php`, `prestamo_empleado.php` proveen selectores modales y reportes específicos invocados desde la interfaz.

## Flujo de pago a proveedores
1. **Inicialización:** el usuario abre `egreso.php`; se genera el formulario con listas de empresa/sucursal/transacción vía XAJAX.
2. **Selección de beneficiario y documentos:** se elige proveedor/empleado, se buscan facturas (`buscar_factura.php`) y códigos de retención (`buscar_codret.php`) mediante ventanas emergentes. Los datos se agregan al grid DIRECTORIO.
3. **Cálculo y retenciones:** las funciones `agrega_modifica_grid_ret` y `calculo` ajustan bases imponibles y porcentajes; se muestran totales con `total_diario` y `cargar_tot`.
4. **Armado del diario contable:** `agrega_modifica_grid_dia` distribuye débitos/créditos en moneda local y extranjera, permitiendo indicar centro de costo/actividad y referencias de cheque o depósito.
5. **Validaciones previas:** `controlPeriodoIfx` valida apertura de período y moneda; `controlCheque` revisa disponibilidad/formato de cheques; `documento_digito` valida dígitos de documentos (número de factura o comprobante).
6. **Persistencia:** al confirmar, `xajax_guardar` delega en `mayorizacion_class` para obtener secuenciales (`saesecu`), registrar el encabezado de asiento (`saeasto`), los movimientos (`saedasi`), el detalle de facturas (`saedir`) y retenciones (`saeret`).【F:mayorizacion.inc.php†L11-L347】
7. **Evidencia y pago:** se generan PDFs (`genera_pdf_doc`, `genera_pdf_cheque`) y, cuando aplica, cheques o transferencias con datos de beneficiario y cuenta bancaria. Adjuntos de respaldo se manejan con `modal_adjuntos`/`guardarAdjuntos`.

## Tablas y operaciones SQL clave
Las operaciones de persistencia están concentradas en `mayorizacion.inc.php`:
- **`saesecu`**: obtiene y actualiza secuenciales para diarios y asientos antes de grabar egresos.【F:mayorizacion.inc.php†L11-L107】 (SELECT, UPDATE)
- **`saeasto`**: inserta el encabezado del asiento contable de egreso, incluyendo beneficiario, monto total, moneda, tipo de documento y formato de impresión.【F:mayorizacion.inc.php†L111-L147】 (INSERT)
- **`saedasi`**: registra las partidas de débito/crédito con cuenta contable, centro de costo, retención asociada, bancos/cheques y referencia de transacción.【F:mayorizacion.inc.php†L149-L229】 (INSERT)
- **`saedir`**: guarda el detalle de facturas/directorio con cliente/proveedor, transacción, vencimiento, valores en ML/ME, series y autorizaciones SRI.【F:mayorizacion.inc.php†L231-L293】 (INSERT)
- **`saeret`**: almacena retenciones con base imponible, porcentaje, valor retenido, datos de beneficiario y factura relacionada.【F:mayorizacion.inc.php†L295-L347】 (INSERT)

## Cadena de validaciones y dependencias
- **Secuenciales y período:** se calculan con `secu_asto`, que consulta `saepcon`, `saetcam`, `saeejer`, `saetidu` y `saesecu` para validar moneda, tipo de cambio y período abierto antes de generar números de diario/asiento.【F:mayorizacion.inc.php†L11-L107】
- **Integridad de cuentas y centros:** `saedasi` obtiene el nombre de la cuenta desde `saecuen` y exige centro de costo/actividad cuando corresponda.【F:mayorizacion.inc.php†L182-L229】
- **Compatibilidad de beneficiario:** se normalizan códigos de proveedor/empleado y se admite un valor genérico cuando falta identificación, evitando registros vacíos.【F:mayorizacion.inc.php†L188-L229】
- **Documentos soporte:** `saedir` y `saeret` obligan a fechas, series y autorizaciones cuando se registra facturación o retenciones, asegurando trazabilidad fiscal.【F:mayorizacion.inc.php†L231-L347】

## Integraciones y comunicación
- **XAJAX:** todas las llamadas desde la UI pasan por funciones registradas en `_Ajax.comun.php`, que enrutan a `_Ajax.server.php` para construir HTML y ejecutar lógica de negocio.【F:_Ajax.comun.php†L22-L135】
- **Ventanas auxiliares:** búsquedas y reportes se resuelven en páginas independientes (`buscar_*`, `cheque.php`, `prestamo_empleado.php`) abiertas en ventanas/modal; los resultados se devuelven a la página principal mediante callbacks JavaScript (e.g., `cuentaAplicada`, `cargar`).【F:egreso.php†L132-L355】
- **Generación de documentos:** `genera_pdf_doc`, `genera_pdf_cheque`, `vista_previa` y `vista_previa1` generan comprobantes y cheques a partir de los datos persistidos.【F:egreso.php†L340-L360】

## Consideraciones de mantenimiento
- Mantener sincronizadas las validaciones de front-end (teclas rápidas, obligatoriedad de campos) con las reglas del servidor en `_Ajax.server.php` para evitar inconsistencias.
- Revisar la consistencia de tasas de cambio y períodos contables antes de permitir grabar egresos (dependencia de `saesecu` y `saetcam`).
- Documentar cualquier ampliación de grids (directorios/retenciones/diario) tanto en la UI como en el servidor para preservar los controles de visibilidad y tipos de columna.
