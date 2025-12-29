<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenCompraController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orden-compra/{ordenCompra}/pdf', [OrdenCompraController::class, 'descargarPdf'])->name('orden-compra.pdf');
