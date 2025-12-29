classDiagram
direction LR

class User {
  +id: bigint
  +name: string
  +email: string
}

class Empresa {
  +id: bigint
  +ruc: string
  +nombre_empresa: string
  +motor: string
  +host: string
  +puerto: string
  +usuario: string
  +clave: string
  +nombre_base: string
}

class SolicitudPago {
  +id: bigint
  +fecha: date
  +motivo: text
  +estado: string  // BORRADOR | APROBADA | ANULADA
  +tipo_solicitud: string
  +monto_aprobado: numeric
  +monto_estimado: numeric
  +monto_utilizado: numeric
  +creado_por_id: bigint
  +aprobado_por_id: bigint?
  +aprobada_at: timestamp?
  +created_at: timestamp
  +updated_at: timestamp
}

class SolicitudPagoContexto {
  +id: bigint
  +solicitud_pago_id: bigint
  +conexion: string
  +empresa_id: bigint
  +sucursal_codigo: string
  +created_at: timestamp
}

class SolicitudPagoDetalle {
  +id: bigint
  +solicitud_pago_id: bigint

  %% Identificador de origen en ERP (clave compuesta)
  +erp_conexion: string
  +erp_empresa_id: bigint
  +erp_sucursal: string
  +erp_tabla: string   // "SAEDMCP"
  +erp_clave: string   // hash/clave única armada con campos de SAEDMCP

  %% Datos de auditoría (snapshot)
  +proveedor_ruc: string
  +proveedor_codigo: string?
  +proveedor_nombre: string
  +numero_factura: string
  +fecha_emision: date?
  +fecha_vencimiento: date?
  +monto_factura: numeric
  +saldo_al_crear: numeric

  %% Abono (una sola vez)
  +abono_aplicado: numeric
  +estado_abono: string  // SIN_ABONO | ABONADO | ABONADO_PARCIAL

  +created_at: timestamp
}

class ERPFacturaDTO {
  +conexion: string
  +empresa_id: string
  +sucursal: string
  +proveedor_ruc: string
  +proveedor_codigo: string
  +proveedor_nombre: string
  +numero_factura: string
  +fecha_emision: date
  +fecha_vencimiento: date
  +monto: numeric
  +saldo: numeric
  +erp_unique_key: string
}

class ERPService {
  +listarProveedoresAgrupados(contextos, filtros) List
  +listarFacturasProveedor(contextos, proveedor_ruc) List~ERPFacturaDTO~
  +marcarPagoEnERP(detalles_aprobados) void
}

User "1" --> "*" SolicitudPago : creado_por
User "1" --> "*" SolicitudPago : aprobado_por
SolicitudPago "1" --> "*" SolicitudPagoContexto : contextos
SolicitudPago "1" --> "*" SolicitudPagoDetalle : detalles
Empresa "1" --> "*" SolicitudPagoContexto : empresa
ERPService ..> ERPFacturaDTO : retorna
ERPService ..> SolicitudPagoDetalle : usa_para_aprobar







Refactoriza mis módulos de Filament para que mantengan exactamente la misma funcionalidad actual, pero usando una estructura de base de datos normalizada para Solicitudes de Pago. Los módulos a refactorizar son: solicitud-pago-facturas.php, solicitud-pagos.php y presupuesto-pago-proveedores.php. La interfaz debe seguir permitiendo seleccionar múltiples conexiones, empresas y sucursales, listar proveedores agrupados por RUC (aunque tengan códigos distintos según empresa/sucursal), visualizar facturas desde el ERP (tabla SAEDMCP) y asignar abonos por factura. Debe conservar el flujo de “Guardar borrador” (editable) y “Aprobar y enviar” (definitivo e inmutable). El abono se realiza una sola vez al aprobar; después la solicitud no puede modificarse y la información se usa para contabilidad.

No quiero crear tablas espejo de facturas ni proveedores del ERP. Las facturas se consultan siempre directamente desde SAEDMCP. Sin embargo, al guardar detalles localmente necesito persistir un identificador de origen ERP (una clave única construida desde campos de la factura en SAEDMCP junto con el contexto: conexión/empresa/sucursal) y un snapshot mínimo para auditoría y contabilidad (RUC, nombre proveedor, número factura, fechas, monto, saldo al momento, abono aplicado). La cabecera de solicitud no debe guardar listas concatenadas de proveedores, ni arrays JSON de proveedores seleccionados; esa información debe quedar en los detalles y/o en la tabla de contextos.

Analiza mis migraciones actuales relacionadas con solicitud_pagos y solicitud_pago_detalles. Elimina o deja de usar columnas desnormalizadas como proveedor_nombre en cabecera cuando se esté usando para almacenar múltiples proveedores, y elimina el guardado de JSON empresas_seleccionadas, sucursales_seleccionadas, proveedores_seleccionados como persistencia de negocio (si existen solo para UI temporal, no deben persistirse). Asume que voy a ejecutar una migración desde cero con php artisan migrate:fresh (refresh total), así que puedes borrar migraciones viejas y crear nuevas limpias para estas entidades.

Crea de nuevo (desde cero) tres tablas locales: solicitud_pagos, solicitud_pago_detalles y solicitud_pago_contextos. La tabla solicitud_pagos debe ser la cabecera y guardar solo datos globales: id, id_empresa (empresa dueña del sistema o la empresa principal si aplica), fecha, motivo, estado (valores: BORRADOR y APROBADA; opcional ANULADA si ya existe), tipo_solicitud, monto_aprobado, monto_estimado, monto_utilizado, creado_por_id, aprobado_por_id (nullable), aprobada_at (nullable), created_at y updated_at. Asegura FKs hacia empresas y users (creado_por_id y aprobado_por_id). Evita guardar información de proveedores en esta tabla (nada de listas concatenadas). Si existen columnas históricas que ya no aplican, elimínalas en la nueva migración.

La tabla solicitud_pago_contextos debe registrar la selección de filtros/contextos usados para generar la solicitud. Debe contener: id, solicitud_pago_id (FK), conexion (string), empresa_id (FK a empresas), sucursal_codigo (string), timestamps. Agrega un índice único para evitar duplicados exactos por solicitud, por ejemplo: unique(solicitud_pago_id, conexion, empresa_id, sucursal_codigo). Esta tabla reemplaza el uso de JSON en cabecera para empresas/sucursales seleccionadas.

La tabla solicitud_pago_detalles debe guardar una fila por factura seleccionada desde SAEDMCP, incluyendo el abono definido por el usuario. Debe contener: id, solicitud_pago_id (FK), erp_tabla (string, default SAEDMCP), erp_conexion (string), erp_empresa_id (bigint o string según cómo identifiques la empresa en el ERP; si ya usas amdg_id_empresa en tu app, úsalo coherente), erp_sucursal (string), erp_clave (string) como identificador único de origen construido con los campos de SAEDMCP y el contexto, proveedor_ruc (string), proveedor_codigo (string nullable), proveedor_nombre (string), numero_factura (string), fecha_emision (date nullable si aplica), fecha_vencimiento (date nullable), monto_factura (numeric 15,2), saldo_al_crear (numeric 15,2), abono_aplicado (numeric 15,2), estado_abono (string con valores como SIN_ABONO, ABONADO, ABONADO_PARCIAL), timestamps. Crea un unique para evitar duplicar la misma factura dentro de una solicitud: unique(solicitud_pago_id, erp_clave). Crea índices para búsquedas por proveedor_ruc, numero_factura, estado_abono y por contexto (erp_conexion, erp_empresa_id, erp_sucursal). Usa siempre numeric para dinero, no float.

Refactoriza los componentes y lógica de Filament para que el guardado se haga así: cuando el usuario selecciona conexiones/empresas/sucursales y luego selecciona proveedores y facturas con sus abonos, al presionar “Guardar borrador” se crea/actualiza solicitud_pagos en estado BORRADOR, se sincroniza solicitud_pago_contextos con lo seleccionado, y se sincroniza solicitud_pago_detalles con las facturas seleccionadas, guardando por cada factura erp_clave + snapshot + abono_aplicado. El total en cabecera (monto_estimado) debe ser la suma de saldo_al_crear (o la suma de abonos según tu regla actual; respeta la regla que hoy muestra “Total de todas las facturas” en la interfaz). monto_utilizado en borrador debe ser 0 o calculado según tu UI actual, pero al aprobar debe reflejar la suma total de abonos aplicados.

Implementa la acción “Aprobar y enviar” para que sea transaccional: valida que la solicitud esté en BORRADOR, valida que existan detalles, valida que abono_aplicado no exceda saldo_al_crear por detalle y que no sea negativo, recalcula totales desde detalles, luego marca la solicitud como APROBADA, setea aprobado_por_id, aprobada_at y actualiza monto_utilizado. Después de aprobar, bloquea cualquier modificación desde Filament y también desde backend (por ejemplo usando Policies/Observers o validaciones en los métodos update/delete) para garantizar inmutabilidad. La UI debe seguir mostrando el agrupado por proveedor con sus facturas, pero los datos persistidos deben venir desde solicitud_pago_detalles y no desde campos de cabecera con texto concatenado.

Ajusta específicamente estos archivos para que trabajen con la nueva estructura: presupuesto-pago-proveedores.php debe seguir consultando proveedores/facturas en el ERP (SAEDMCP) con los filtros seleccionados, agrupando por proveedor (RUC) aunque cambie el código por contexto, y calculando totales. solicitud-pago-facturas.php debe encargarse de mostrar/gestionar la selección de facturas y el ingreso de abonos por factura, pero ahora debe producir una estructura de datos lista para persistir como filas en solicitud_pago_detalles (una por factura). solicitud-pagos.php debe manejar el ciclo de vida de la solicitud (crear borrador, editar borrador, aprobar), guardando y leyendo desde solicitud_pagos, solicitud_pago_contextos y solicitud_pago_detalles. Mantén la misma experiencia visual y la misma lógica de negocio, pero cambia el almacenamiento para que no guarde cadenas enormes de proveedores ni JSON persistente innecesario.

Cuando construyas erp_clave, no uses un ID local de factura porque no hay espejo. En su lugar, genera una clave estable usando los campos que ya obtienes de SAEDMCP para identificar una factura (por ejemplo combinación de proveedor_codigo/proveedor_ruc, numero_factura, tipo_documento si existe, empresa/sucursal y conexión). La clave debe ser determinística (la misma factura siempre genera la misma clave) para que al guardar borradores no se dupliquen detalles. Usa un hash (sha1/sha256) si la clave compuesta es muy larga, pero conserva además en columnas separadas numero_factura y proveedor_ruc para búsquedas y reportes.

Finalmente, actualiza modelos Eloquent y relaciones: SolicitudPago hasMany SolicitudPagoDetalle y hasMany SolicitudPagoContexto; SolicitudPago belongsTo User creado_por y aprobado_por; SolicitudPagoContexto belongsTo Empresa; SolicitudPagoDetalle belongsTo SolicitudPago. Asegúrate de actualizar casts a decimal para montos y fechas. No dejes referencias antiguas a proveedores_seleccionados, empresas_seleccionadas o sucursales_seleccionadas como persistencia principal. Entrega los cambios completos listos para ejecutar con migrate:fresh y probar que el flujo actual funcione igual con la nueva estructura.
