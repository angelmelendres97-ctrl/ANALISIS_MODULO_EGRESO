<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Compra #{{ $ordenCompra->id }}</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { margin: 0; }
        .header p { margin: 5px 0; }
        .details, .items { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .details td, .items td, .items th { border: 1px solid #ccc; padding: 8px; }
        .details td { width: 50%; }
        .items th { background-color: #f2f2f2; text-align: left; }
        .items .total-row td { border-top: 2px solid #000; font-weight: bold; }
        .text-right { text-align: right; }
        .footer { text-align: center; margin-top: 50px; font-size: 0.8em; color: #777; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Orden de Compra</h1>
        <p><strong>N°:</strong> {{ $ordenCompra->id }}</p>
        @if($ordenCompra->empresa)
            <p>{{ $ordenCompra->empresa->nombre_empresa }}</p>
        @endif
    </div>

    <table class="details">
        <tr>
            <td>
                <strong>Fecha Pedido:</strong> {{ $ordenCompra->fecha_pedido->format('d/m/Y') }}<br>
                <strong>Fecha Entrega Estimada:</strong> {{ $ordenCompra->fecha_entrega->format('d/m/Y') }}<br>
                <strong>Solicitado Por:</strong> {{ $ordenCompra->solicitado_por }}<br>
                <strong>Para Uso De:</strong> {{ $ordenCompra->uso_compra }}
            </td>
            <td>
                <strong>Proveedor:</strong> {{ $ordenCompra->proveedor }}<br>
                <strong>Identificación:</strong> {{ $ordenCompra->identificacion }}<br>
                <strong>Transacción:</strong> {{ $ordenCompra->trasanccion }}
            </td>
        </tr>
    </table>

    <h3>Detalles de la Orden</h3>
    <table class="items">
        <thead>
            <tr>
                <th>Producto</th>
                <th class="text-right">Cantidad</th>
                <th class="text-right">Costo Unit.</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">IVA (%)</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenCompra->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto }}</td>
                    <td class="text-right">{{ $detalle->cantidad }}</td>
                    <td class="text-right">${{ number_format($detalle->costo, 2) }}</td>
                    <td class="text-right">${{ number_format($detalle->cantidad * $detalle->costo, 2) }}</td>
                    <td class="text-right">{{ $detalle->impuesto }}%</td>
                    <td class="text-right">${{ number_format($detalle->total, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" class="text-right">Total General:</td>
                <td class="text-right">${{ number_format($ordenCompra->total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    @if($ordenCompra->observaciones)
        <h3>Observaciones</h3>
        <p>{{ $ordenCompra->observaciones }}</p>
    @endif

    <div class="footer">
        <p>Documento generado automáticamente.</p>
    </div>

</body>
</html>
