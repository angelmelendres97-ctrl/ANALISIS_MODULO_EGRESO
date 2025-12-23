<?php
/* ARCHIVO COMUN PARA LA EJECUCION DEL SERVIDOR AJAX DEL MODULO */

/***************************************************/
/* NO MODIFICAR */
include_once('../../Include/config.inc.php');
include_once(path(DIR_INCLUDE) . 'conexiones/db_conexion.php');
include_once(path(DIR_INCLUDE) . 'comun.lib.php');
include_once(path(DIR_INCLUDE) . 'Clases/Formulario/Formulario.class.php');
require_once(path(DIR_INCLUDE) . 'Clases/xajax/xajax_core/xajax.inc.php');
require_once(path(DIR_INCLUDE) . 'Clases/GeneraDetalleAsientoContable.class.php');
/***************************************************/
/* INSTANCIA DEL SERVIDOR AJAX DEL MODULO*/
$xajax = new xajax('_Ajax.server.php');
$xajax->setCharEncoding('ISO-8859-1');
/***************************************************/
//	FUNCIONES PUBLICAS DEL SERVIDOR AJAX DEL MODULO 
//	Aqui registrar todas las funciones publicas del servidor ajax
//	Ejemplo,
//	$xajax->registerFunction("Nombre de la Funcion");
/***************************************************/
//	Fuciones de lista de pedido
$xajax->registerFunction("genera_formulario");
$xajax->registerFunction("guardar");

// DIRECTORIO
$xajax->registerFunction("agrega_modifica_grid_dir");
$xajax->registerFunction("agrega_modifica_grid_dir_ori");
$xajax->registerFunction("mostrar_grid_dir");
$xajax->registerFunction("elimina_detalle_dir");

//
// RETENCION
$xajax->registerFunction("agrega_modifica_grid_ret");
$xajax->registerFunction("mostrar_grid_ret");
$xajax->registerFunction("elimina_detalle_ret");

// DIARIO
$xajax->registerFunction("agrega_modifica_grid_dia");
$xajax->registerFunction("mostrar_grid_dia");
$xajax->registerFunction("elimina_detalle_dia");

//RETENCION
$xajax->registerFunction("agrega_modifica_grid_ret");
$xajax->registerFunction("mostrar_grid_ret");
$xajax->registerFunction("elimina_detalle_ret");
$xajax->registerFunction("genera_pdf_doc");


$xajax->registerFunction("reporte_facturas");
$xajax->registerFunction("reporte_facturas_ret");
$xajax->registerFunction("calculo");


$xajax->registerFunction("numero_ret");
$xajax->registerFunction("total_diario");


$xajax->registerFunction("cargar_tot");

//CHEQUE
$xajax->registerFunction("reporte_cheque");
$xajax->registerFunction("agrega_modifica_grid_dia_cheque");
$xajax->registerFunction("cargar_coti");



$xajax->registerFunction("formulario_prestamo");
$xajax->registerFunction("generarTablaAmortizacion");
$xajax->registerFunction("guardar_prestamo");

$xajax->registerFunction("reporte_credito");
$xajax->registerFunction("checkPrestamo");
$xajax->registerFunction("parametrosPrestamo");

$xajax->registerFunction("cargar_lista_tran");

$xajax->registerFunction("cargar_lista_subcliente");

$xajax->registerFunction("controlPeriodoIfx");
$xajax->registerFunction("calculaValorRetenido");
$xajax->registerFunction("nomina");
$xajax->registerFunction("buscar_nomina");
$xajax->registerFunction("generar_cheques_empleados");
$xajax->registerFunction("procesar_cheques_nomina");
$xajax->registerFunction("controlCheque");

$xajax->registerFunction("formulario_prestamo");
$xajax->registerFunction("generarTablaAmortizacion");
$xajax->registerFunction("guardar_prestamo");

$xajax->registerFunction("form_modificar_valor");
$xajax->registerFunction("modificar_valor");

$xajax->registerFunction("agrega_modifica_grid_dia_empl");

$xajax->registerFunction("documento_digito");

$xajax->registerFunction("ftrn_tip_movi");

$xajax->registerFunction("genera_pagos");
$xajax->registerFunction("agrega_modifica_grid_dir_pago");
$xajax->registerFunction("modal_cheque");

$xajax->registerFunction("genera_pdf_doc1");
$xajax->registerFunction("form_adjuntos");
$xajax->registerFunction("verDiarioContable");
$xajax->registerFunction("genera_pdf_doc_compras");
$xajax->registerFunction("genera_documento");
$xajax->registerFunction("genera_pdf_cheque");

$xajax->registerFunction("cargarModalOc");


//-----------------------------------------
//REGISTRO DE FUNCIONES ADJUTNOS SUEJO4967
//-----------------------------------------

$xajax->registerFunction("modal_adjuntos");
$xajax->registerFunction("guardarAdjuntos");
$xajax->registerFunction("verAdj");

//-----------------------------------------
//      FIN FUNCIONES ADJUNTOS SUEJO4967
//-----------------------------------------


// --------------------------------------------------------------------
// LETRAS DE CAMBIO AD
// --------------------------------------------------------------------
$xajax->registerFunction("abre_modal_canje");
$xajax->registerFunction("procesar_letras");
$xajax->registerFunction("agregar_canje_letra");
// --------------------------------------------------------------------
// FIN LETRAS DE CAMBIO AD
// --------------------------------------------------------------------



/***************************************************/
