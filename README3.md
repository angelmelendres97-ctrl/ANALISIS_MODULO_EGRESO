# README 3 – Diagramas de flujo, validaciones y casos de uso del proceso de pago

## Flujo completo de pago a proveedores
1. **Inicio**: Usuario ingresa a `egreso.php`. Se cargan catálogos (empresa, sucursal, transacción, moneda) vía `xajax_genera_formulario` y se muestran grids vacíos.【F:egreso.php†L51-L125】
2. **Selección de proveedor/empleado**: El usuario invoca la búsqueda de beneficiario mediante Enter/F4 (`autocompletar`), abriendo `buscar_cliente.php` o `buscar_empl.php`. El resultado llena campos `clpv_cod` y `clpv_nom`.
3. **Carga de documentos**: Con el beneficiario y transacción seleccionados, se buscan facturas (`facturas`/`facturas_clpv`) o códigos de retención (`cod_retencion`, `fact_retencion`) en modales de búsqueda. Los documentos seleccionados se agregan al grid DIRECTORIO por `agrega_modifica_grid_dir`/`agrega_modifica_grid_dir_ori` en `_Ajax.server.php`.
4. **Validaciones de monto y saldos**: Las funciones de servidor recalculan totales, detectan si hay débitos/créditos desbalanceados y exigen detalle de egreso antes de permitir grabar. El front impide guardar cuando ya existe un asiento (`asto_cod`/`compr_cod`).【F:egreso.php†L87-L99】
5. **Retenciones**: Si aplica, se añaden códigos y facturas de retención; `agrega_modifica_grid_ret` calcula base y valor retenido, actualizando totales del diario.
6. **Diario contable**: `agrega_modifica_grid_dia` genera las partidas de débito y crédito, incluyendo datos de cheque/depósito, centro de costo, actividad y referencia de beneficiario. Se ajusta el texto de detalle (`cargar_detalle`) para sincronizar la narrativa del egreso.【F:egreso.php†L200-L250】
7. **Confirmación y aprobación**: Al presionar Guardar, se ejecutan validaciones de front-end (`ProcesarFormulario`) y de servidor (período abierto, tipo de cambio, numeración disponible). `xajax_guardar` registra el asiento y las tablas relacionadas mediante `mayorizacion_class` (secuenciales, `saeasto`, `saedasi`, `saedir`, `saeret`).【F:mayorizacion.inc.php†L11-L347】
8. **Registro contable y emisión**: Se generan PDFs (`genera_pdf_doc`, `genera_pdf_cheque`, `vista_previa`, `vista_previa1`) y, si corresponde, cheques físicos mediante ventanas de impresión (`cheque`, `cheque_pago`, `imprime_cheque`).【F:egreso.php†L310-L360】
9. **Adjuntos y cierres**: El usuario puede anexar comprobantes (`modal_adjuntos`) y consultar el diario ya registrado (`verDiarioContable`).

## Validaciones y controles
- **Previo a guardar**: campos obligatorios, inexistencia de asientos previos, balance débitos/créditos, detalle del egreso y selección de beneficiario.【F:egreso.php†L87-L132】
- **Período y numeración**: `secu_asto` consulta `saepcon`, `saetcam`, `saeejer`, `saetidu` y `saesecu` para asegurar período abierto y generar secuencias únicas de diario/egreso.【F:mayorizacion.inc.php†L11-L107】
- **Integridad de cuentas**: `saedasi` valida existencia de cuenta en `saecuen`, exige centro de costo/actividad según configuración y normaliza el código de beneficiario.【F:mayorizacion.inc.php†L182-L229】
- **Documentos de soporte**: `saedir` obliga a número de factura, vencimiento, serie y autorizaciones; `saeret` requiere base imponible, porcentaje y datos fiscales para emitir retención.【F:mayorizacion.inc.php†L231-L347】
- **Cheques y pagos**: controles de disponibilidad de chequeras y formato de impresión se realizan en funciones como `controlCheque` y `cheque_pago`/`cheque`, integradas con los grids del diario.【F:egreso.php†L260-L330】【F:_Ajax.comun.php†L61-L104】

## Casos de uso principales
- **Registrar egreso a proveedor**
  - Actor: Usuario operativo.
  - Flujo: abre `egreso.php` → selecciona empresa/sucursal → busca proveedor → agrega facturas → configura retenciones → arma diario → guarda → imprime comprobante/cheque.
- **Registrar egreso a empleado (préstamo/nómina)**
  - Actor: Administrador de nómina.
  - Flujo: abre `egreso.php` → activa búsqueda de empleado (`autocompletar` con opción empleado) → usa `prestamo`/`prestamosClientes` o `nomina` para generar pagos → arma diario y guarda.
- **Aprobar y revisar pagos masivos**
  - Actor: Contador/Administrador.
  - Flujo: desde modales de pagos (`genera_pagos`, `cargar_pagos`) carga pagos previos, revisa totales y genera cheques en lote (`cheque_pago`, `controlCheque`).
- **Emitir retención**
  - Actor: Usuario operativo.
  - Flujo: tras seleccionar factura y beneficiario, agrega retención con `agrega_modifica_grid_ret`, valida base/porcentaje y guarda; luego imprime comprobante de retención desde el mismo formulario.
- **Adjuntar respaldos**
  - Actor: Usuario operativo.
  - Flujo: selecciona el egreso → abre `modal_adjuntos` → carga archivos; estos quedan asociados al asiento y pueden visualizarse con `verAdj`.

## Notas para los diagramas de flujo y casos de uso
- Representar nodos de decisión para: selección de beneficiario (proveedor vs empleado), existencia de facturas, necesidad de retención, balance de diario y disponibilidad de cheque.
- Incluir puntos de error: falta de período abierto, desequilibrio de débitos/créditos, ausencia de detalle, retención sin datos fiscales completos.
- Señalar pasos opcionales como generación de cheques o adjuntos, que pueden omitirse si el pago es por transferencia.
