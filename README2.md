# README 2 – Diagramas UML y modelo de datos del Módulo de Egreso

## Modelo de clases (narrativo)
El modelo se deriva de las entidades persistidas y de los servicios de interfaz. A continuación se describe cada clase/tabla con atributos relevantes y relaciones:

- **Empresa/Sucursal** (contexto del módulo): identifican la compañía (`idempresa`) y sucursal (`sucursal`) que parametrizan todos los registros de egreso y asientos.【F:mayorizacion.inc.php†L12-L99】
- **Secuencia (`saesecu`)**: mantiene `secu_egr_comp` y `secu_asi_comp` para numerar diarios y asientos; depende de empresa, sucursal, módulo, ejercicio y período.【F:mayorizacion.inc.php†L66-L107】
- **Asiento (`saeasto`)**: entidad raíz del egreso; atributos incluyen código de asiento (`asto_cod_asto`), empresa, sucursal, ejercicio, período, moneda, usuario, transacción, beneficiario, valor total, fechas y formato de impresión.【F:mayorizacion.inc.php†L111-L147】 Relaciona 1..* con líneas de diario (`saedasi`), directorio (`saedir`) y retenciones (`saeret`).
- **Detalle de asiento (`saedasi`)**: representa cada partida contable con cuenta (`dasi_cod_cuen`), centro de costo, valores en moneda local/extranjera, tipo de cambio, detalle, beneficiario, referencia de transacción y datos de cheques/bancos.【F:mayorizacion.inc.php†L149-L229】 Asociado 1..1 a `saeasto`; puede enlazar opcionalmente con retenciones (`dasi_cod_ret`) y directorio (`dasi_cod_dir`).
- **Directorio/Factura (`saedir`)**: vincula facturas o documentos fuente al asiento, con información de cliente/proveedor, transacción, número de factura, vencimiento, valores ML/ME, series y autorizaciones SRI.【F:mayorizacion.inc.php†L231-L293】 Relación 1..* desde `saeasto`.
- **Retención (`saeret`)**: modela comprobantes de retención asociados al asiento y a la factura/beneficiario, con base imponible, porcentaje, valor retenido, serie y datos de contacto.【F:mayorizacion.inc.php†L295-L347】 Relación 1..* desde `saeasto`; puede reflejarse en `saedasi` mediante `dasi_cod_ret`.
- **Interfaz XAJAX (`_Ajax.comun.php` / `_Ajax.server.php`)**: clases/servicios que exponen métodos de negocio al front-end, actuando como controladores. Registran funciones como `genera_formulario`, `agrega_modifica_grid_*`, `genera_pdf_*`, `controlPeriodoIfx`, entre otras.【F:_Ajax.comun.php†L22-L135】
- **Front-end (`egreso.php`)**: vista principal con métodos JavaScript que consumen los servicios XAJAX, gestionan modales y validan la entrada del usuario.【F:egreso.php†L46-L355】

## Relaciones y cardinalidades
- `Empresa` 1..* `Sucursal` (contextual, implícito en los parámetros de las consultas).
- `Sucursal` 1..* `Secuencia (saesecu)` por módulo/tipo de documento/período.【F:mayorizacion.inc.php†L66-L107】
- `Asiento (saeasto)` 1..* `Detalle (saedasi)`; cada asiento tiene múltiples partidas contables.【F:mayorizacion.inc.php†L149-L229】
- `Asiento (saeasto)` 1..* `Directorio (saedir)`; un egreso puede pagar varias facturas.【F:mayorizacion.inc.php†L231-L293】
- `Asiento (saeasto)` 0..* `Retención (saeret)`; se generan cuando el pago aplica retenciones tributarias.【F:mayorizacion.inc.php†L295-L347】
- `Detalle (saedasi)` 0..1 `Retención (saeret)` vía `dasi_cod_ret`, y 0..1 `Directorio (saedir)` vía `dasi_cod_dir`, para asegurar trazabilidad contable del origen y de la retención.【F:mayorizacion.inc.php†L149-L229】

## Diagrama de clases (texto)
- `Empresa`
  - atributos: idempresa
  - relaciones: 1..* `Sucursal`
- `Sucursal`
  - atributos: sucursal, modulo
  - relaciones: 1..* `Secuencia`
- `Secuencia (saesecu)`
  - atributos: secu_egr_comp, secu_asi_comp, tidu, ejercicio, periodo
  - relaciones: 1..1 `Asiento` (provee numeración)
- `Asiento (saeasto)`
  - atributos: asto_cod_asto, empresa, sucursal, ejercicio, periodo, moneda, usuario_ifx, tipo_doc, beneficiario, valor_total, fecha_asto, detalle, estado, tipo_mov, formato_impr, tidu
  - relaciones: 1..* `Detalle (saedasi)`, 1..* `Directorio (saedir)`, 0..* `Retencion (saeret)`
- `Detalle (saedasi)`
  - atributos: cuenta, centro_costo, deb_ml, cre_ml, deb_me, cre_me, tip_camb, detalle, nom_cta, cod_clpv, cod_tran, cod_ret, cod_dir, banco, cheque
  - relaciones: 1..1 `Asiento`, 0..1 `Retencion`, 0..1 `Directorio`
- `Directorio (saedir)`
  - atributos: cod_dir, cod_clpv, transaccion, num_fact, fecha_venc, detalle, tip_camb, deb_ml, cre_ml, deb_me, cre_me, aut_sri, serie, sucursal_clpv
  - relaciones: 1..1 `Asiento`
- `Retencion (saeret)`
  - atributos: ret_cod, porc_ret, base_imp, valor_ret, num_ret, detalle, tip_camb, deb_ml, cre_ml, deb_me, cre_me, nom_benf, dir_benf, tel_benf, ruc, num_fact, serie, aut_ret, fecha_ret, email, elec_sn
  - relaciones: 1..1 `Asiento`, 0..1 `Detalle (saedasi)`

## Diagrama de componentes (texto)
- **Componente UI (egreso.php):** Renderiza el formulario, grids de directorio/retenciones/diario y acciona eventos. Se comunica con el componente XAJAX mediante llamadas `xajax_*` y abre componentes de búsqueda en ventanas modales.【F:egreso.php†L46-L355】
- **Componente Controlador XAJAX (`_Ajax.comun.php` + `_Ajax.server.php`):** Recibe las peticiones AJAX, valida datos, genera HTML dinámico y delega persistencia en `mayorizacion.inc.php`. Publica servicios de cálculo (retenciones, totales), validación (período, cheques) y generación de documentos.【F:_Ajax.comun.php†L22-L135】
- **Componente Lógico Contable (`mayorizacion.inc.php`):** Ejecuta consultas SQL para numeración, inserción en tablas contables y armado de asientos completos.【F:mayorizacion.inc.php†L11-L347】
- **Componentes de búsqueda/soporte:** scripts individuales (`buscar_factura.php`, `buscar_cliente.php`, `cheque.php`, etc.) que devuelven datos seleccionados a la UI.

## Consideraciones para futuros diagramas
- El diagrama de clases debe reflejar dependencias fuertes entre `saeasto`, `saedasi`, `saedir` y `saeret`, así como la dependencia de numeración en `saesecu`.
- El diagrama de componentes debe mostrar la comunicación asincrónica UI ↔ XAJAX ↔ lógica contable, y los canales auxiliares (ventanas modales) para búsquedas.
- Incluir en UML las clases de servicio (controlPeriodoIfx, controlCheque, genera_pdf_*), reflejando que actúan como orquestadores entre la UI y la base de datos.
