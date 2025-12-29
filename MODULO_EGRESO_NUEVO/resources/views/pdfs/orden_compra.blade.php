<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Orden de Compra - Formato</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 10px;
        }

        .page {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0px;
        }

        .header-block {
            text-align: center;
            margin-bottom: 10px;
        }

        .header-block .title-main {
            font-size: 16px;
            font-weight: 700;
        }

        .header-block .title-sub {
            font-size: 14px;
            font-weight: 700;
        }

        .header-block .title-insub {
            font-size: 12px;
            font-weight: 700;
        }

        /* Se mantiene .flex y la estructura de información de cabecera */
        .flex {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .left-info {
            width: 100%;
            /* Ajustado para que ocupe todo el espacio de su contenedor */
            font-size: 11px;
        }

        /* Estas clases se mantienen para la sección superior */
        .col-7 {
            width: 60%;
            float: left;
            /* Mantenemos float para que los dos divs de información se pongan lado a lado */
        }

        .col-5 {
            width: 40%;
            float: left;
            /* Mantenemos float para que los dos divs de información se pongan lado a lado */
        }


        .right-box {
            width: 35%;
            font-size: 13px;
            border: 1px solid #000;
            padding: 10px;
        }

        .right-box .row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
        }

        .right-box .title {
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 4px;
            font-size: 11px;
        }

        table th {
            background: #f2f2f2;
            font-weight: 700;
            font-size: 11px;
        }

        th.left {
            text-align: left;
        }

        td.center {
            text-align: center;
        }

        td.right {
            text-align: right;
        }

        table.reducido {
            /* Se ha reducido el ancho para dejar espacio para la tabla de totales.
               Se usa el 100% del contenedor col-8 para que flote correctamente. */
            width: 65%;
        }


        .policies {
            margin-top: 15px;
            font-size: 11px;
        }

        .clearfix {
            clear: both;
        }

        @page {
            size: A4 portrait;
            margin: 20px;
        }

        /* columnas reales para la sección inferior */
        .col-8 {
            width: 66%;
            float: left;
            display: block;
        }

        .col-4 {
            width: 34%;
            float: left;
            display: block;
        }

        /* ESTE CONTENEDOR ES CLAVE: asegura que el bloque de políticas inicie después de los floats */
        .policies-container {
            margin-top: 20px;
            clear: both;
        }

        /* Contenedor que envuelve col-8 y col-4 para la parte inferior */
        .row-flex {
            margin-top: 15px;
            /* No se usa display: flex aquí para confiar en los floats y el clearfix */
            /* Se usa el margen superior original */
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header-block">
            <div class="title-main">INMOBILIARIA BUENA RENTA SA</div>
            <div class="title-sub">ORDEN DE COMPRA N.- 0000045</div>

            @php
                $nombre_formato_oc = '';
                if ($ordenCompra->formato == 'P') {
                    $nombre_formato_oc = 'PROFORMA';
                } else if ($ordenCompra->formato == 'F') {
                    $nombre_formato_oc = 'FACTURA';
                } 
            @endphp

            <div class="title-insub">FORMATO: {{ $nombre_formato_oc }}</div>
        </div>

        <div class="row">
            <div class="col-7">
                <div class="flex">
                    <div class="left-info">
                        <b>Ciudad y Fecha: </b> MACHALA {{ $ordenCompra->fecha_pedido->format('d/m/Y') }}<br>
                        <b>Proveedor: </b> {{ $ordenCompra->proveedor }}<br>
                        <b>Para Uso De: </b> {{ $ordenCompra->uso_compra }}<br>
                        <b>Solicitado Por: </b> {{ $ordenCompra->solicitado_por }}<br>
                        <b>Lugar de Entrega: </b> IMBUESA<br>
                    </div>
                </div>
            </div>

            <div class="col-5">
                <div class="flex">
                    <div class="left-info">
                        <b>Plazo de Entrega: </b> {{ $ordenCompra->fecha_entrega->format('d/m/Y') }}<br>
                        <b>Direccion: </b> <br>
                        <b>Telefono: </b> 0998612034<br>
                        <b>Forma de Pago: </b> <br>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:20px">#</th>
                    <th style="width:100px">Código</th>
                    <th>Descripción</th>
                    <th style="width:40px">Unid.</th>
                    <th style="width:60px">Cant.</th>
                    <th style="width:60px">Precio U.</th>
                    <th style="width:60px">Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach($ordenCompra->detalles as $key => $detalle)
                    <tr>
                        <td class="center">{{ $key + 1 }}</td>
                        <td>{{ $detalle->codigo_producto }}</td>
                        <td>{{ $detalle->producto }}</td>
                        <td class="center">UN</td>
                        <td class="center">{{ $detalle->cantidad }}</td>
                        <td class="right">$ {{ number_format($detalle->costo, 2) }}</td>
                        <td class="right">$ {{ number_format($detalle->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row-flex">

            <div class="col-8">
                <div class="flex" style="margin-top: 5px;">
                    <div class="left-info">
                        <b>Observaciones: </b> {{ $ordenCompra->observaciones }} <br>
                    </div>
                </div>

                <table class="reducido" style="margin-top: 5px;">
                    <thead>

                        <tr>
                            <th style="width:50%" class="left">Tipo Orden Compra</th>
                            @php
                                $nombre_tipo_oc = '';
                                if ($ordenCompra->tipo_oc == 'REEMB') {
                                    $nombre_tipo_oc = 'REEMBOLSO';
                                } else if ($ordenCompra->tipo_oc == 'COMPRA') {
                                    $nombre_tipo_oc = 'COMPRA';
                                } else if ($ordenCompra->tipo_oc == 'PAGO') {
                                    $nombre_tipo_oc = 'PAGO';
                                } else if ($ordenCompra->tipo_oc == 'REGUL') {
                                    $nombre_tipo_oc = 'REGULARIZACION';
                                } else if ($ordenCompra->tipo_oc == 'CAJAC') {
                                    $nombre_tipo_oc = 'CAJA CHICA';
                                }
                            @endphp
                            <td style="width:50%"> {{ $nombre_tipo_oc }} </td>
                        </tr>
                        <tr>
                            <th style="width:50%" class="left">Presupuesto</th>
                            <td style="width:50%">PB</td>
                        </tr>
                        <tr>
                            <th style="width:50%" class="left">Pedidos Compra Afectados</th>
                            <td style="width:50%">
                                00001512 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000125 <br>
                                00000358
                            </td>
                        </tr>

                    </thead>
                </table>
            </div>

            <div class="col-4">
                <table>
                    <thead>
                        <tr>
                            <th style="width:60%" class="left">Subtotal</th>
                            <td style="width:40%" class="right">$ {{ number_format($ordenCompra->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <th style="width:60%" class="left">Descuento</th>
                            <td style="width:40%" class="right">$ {{ number_format($ordenCompra->total_descuento, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width:60%" class="left">Iva</th>
                            <td style="width:40%" class="right">$ {{ number_format($ordenCompra->total_impuesto, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width:60%" class="left">Total</th>
                            <td style="width:40%" class="right">$ {{ number_format($ordenCompra->total, 2) }}</td>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="clearfix"></div>

        </div>


        <div class="policies-container">
            <div class="policies">
                <b>POLÍTICAS PARA LA ORDEN DE COMPRA:</b><br>
                A) Este documento es válido solamente si está firmado por la persona autorizada para aprobar
                compras.<br>
                B) El proveedor sera responsable de revisar los precios establecidos en la presente orden de
                compra,
                esten acorde a los cotizados. Y no podran variar segun el tiempo de vigencia establecido en
                la
                cotizacion<br>
                C) El Proveedor sera responsable de cumplir con las especificaciones y el tiempo ofrecido y
                acordado
                con INMOBILIARIA BUENA RENTA SA. En caso de modificar las especificaciones deberar informar
                a
                INMOBILIARIA BUENA RENTA SA para que esta resuelva si aprueba o no tal modificacion<br>
                D) El caso de inclumpliento de tiempos de entrega, INMOBILIARIA BUENA RENTA SA decidira si
                aceptar o
                no el pedido, y en caso de recibirlo podra multar al proveedor, escontando costos de
                afectacion por
                la no recepcion de la mercaderia en la fecha acordada<br>
            </div>
        </div>

        <div class="policies-container">
            <div class="policies">
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    __________________________________
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    __________________________________
                </p>

                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Elaborado por</b>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Aprobado por</b>
                </p>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>COMPRAS</b>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>GERENCIA</b>
                </p>
            </div>
        </div>

    </div>

</body>

</html>