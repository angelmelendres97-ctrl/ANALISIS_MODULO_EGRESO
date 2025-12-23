# README 2 – Diagramas UML y modelo de datos del Módulo de Egreso

## Visión general del modelo
El módulo se basa en entidades contables y de proveedores que se relacionan al registrar un egreso. Las clases/tablas clave provienen de las operaciones ejecutadas en `_Ajax.server.php` y `mayorizacion.inc.php`.

### Diagrama de clases (Mermaid)
```mermaid
classDiagram
    class SAEASTO {
        +string asto_cod_asto
        +int asto_cod_empr
        +int asto_cod_sucu
        +int asto_cod_ejer
        +int asto_num_prdo
        +int asto_cod_mone
        +int asto_cod_usua
        +string asto_cod_tdoc
        +string asto_ben_asto
        +string asto_det_asto
        +string asto_est_asto
    }
    class SAEDIR {
        +string asto_cod_asto
        +int asto_cod_empr
        +int asto_cod_sucu
        +int ccli_cod
        +int clpv_cod
        +string factura
        +date fec_vence
        +decimal debito
        +decimal credito
        +decimal debito_ext
        +decimal credito_ext
    }
    class SAEDASI {
        +string asto_cod_asto
        +int asto_cod_empr
        +int asto_cod_sucu
        +string dasi_cod_cuen
        +int ccos_cod_ccos
        +decimal dml
        +decimal cml
        +decimal dme
        +decimal cme
        +decimal tip_camb
        +string dasi_det_asi
        +int dasi_cod_clie
    }
    class SAEDCHC {
        +int dchc_cod_ctab
        +string dchc_cod_asto
        +int asto_cod_empr
        +int asto_cod_sucu
        +int asto_cod_ejer
        +int asto_num_prdo
        +string dchc_num_dchc
        +decimal dchc_val_dchc
        +string dchc_cta_dchc
        +date dchc_fec_dchc
        +string dchc_benf_dchc
    }
    class SAESECU {
        +int secu_cod_empr
        +int secu_cod_sucu
        +string secu_cod_tidu
        +int secu_cod_modu
        +int secu_cod_ejer
        +int secu_num_prdo
        +string secu_egr_comp
        +string secu_asi_comp
    }
    class SAECLPV {
        +int clpv_cod_clpv
        +string clpv_nom_clpv
        +string clpv_ruc_clpv
    }
    class SAEEMAI {
        +int emai_cod_empr
        +int emai_cod_clpv
        +string emai_ema_emai
    }
    class SAEDIRE {
        +int dire_cod_empr
        +int dire_cod_clpv
        +string dire_dir_dire
    }

    SAESECU -- SAEASTO : provee secuencia
    SAEASTO <|-- SAEDIR : cabecera
    SAEASTO <|-- SAEDASI : cabecera
    SAEASTO <|-- SAEDCHC : cabecera
    SAEDIR --> SAECLPV : referencia proveedor
    SAEDASI --> SAECLPV : referencia proveedor
    SAEDCHC --> SAEDASI : origen pago
    SAECLPV --> SAEEMAI : contacto
    SAECLPV --> SAEDIRE : dirección
```

### Justificación y fuentes
- `mayorizacion_class::secu_asto()` usa `saesecu` para leer/actualizar `secu_egr_comp` y `secu_asi_comp`, garantizando unicidad por empresa, sucursal, ejercicio y período.【F:mayorizacion.inc.php†L66-L107】
- `mayorizacion_class::saeasto()` inserta la cabecera del asiento (`saeasto`) con datos de empresa, moneda, beneficiario, tipo documental y usuario web.【F:mayorizacion.inc.php†L111-L147】
- Durante el guardado se recorren las líneas del grid para poblar `saedir` (documentos de proveedor) con factura, vencimiento y montos en ambas monedas.【F:_Ajax.server.php†L5900-L5950】
- Las líneas contables se registran en `saedasi` con cuenta contable, centro de costo, montos, cotización y banderas de banco/cheque cuando aplica.【F:_Ajax.server.php†L6078-L6172】
- Si la línea es bancaria se inserta un cheque en `saedchc` y se actualiza el correlativo en `saectab` con el número generado.【F:_Ajax.server.php†L6174-L6197】
- Los datos del proveedor (RUC, dirección, correo) se obtienen de `saeclpv`, `saedire` y `saeemai` para completar retenciones y beneficiarios.【F:_Ajax.server.php†L5924-L5944】

## Diagrama UML de componentes
```mermaid
flowchart LR
    subgraph UI[UI - egreso.php]
        F1[Formulario egreso]
        JS[Funciones JS/Xajax]
    end

    subgraph Server[Servidor PHP]
        A1[_Ajax.server.php]
        A2[mayorizacion.inc.php]
        A3[Dbo / conexión BD]
    end

    subgraph DB[Base de datos]
        B1[(Informix/SAE)]
    end

    F1 --> JS
    JS -- llamadas asíncronas --> A1
    A1 --> A2
    A1 --> A3
    A2 --> A3
    A3 --> B1
```

### Interacción narrativa
1. **UI**: el usuario captura datos y desencadena funciones JS que envían peticiones Xajax al servidor (`_Ajax.server.php`).【F:egreso.php†L121-L210】
2. **Controlador**: el servidor valida el balance, obtiene secuenciales y delega en `mayorizacion.inc.php` para construir cabecera (`saeasto`) y detalle (`saedasi`).【F:_Ajax.server.php†L5751-L5839】【F:mayorizacion.inc.php†L111-L200】
3. **Persistencia**: mediante la clase `Dbo`, las operaciones SQL se ejecutan contra la base Informix/SAE en una transacción, incluyendo documentos (`saedir`) y cheques (`saedchc`).【F:_Ajax.server.php†L5900-L5950】【F:_Ajax.server.php†L6174-L6197】
4. **Respuesta**: Xajax retorna HTML/JS para refrescar grids y totales en la UI sin recarga de página.【F:_Ajax.server.php†L5731-L5744】

