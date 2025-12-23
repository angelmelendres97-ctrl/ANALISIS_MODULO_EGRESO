<?

/********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? include_once('../_Modulo.inc.php'); ?>
<? include_once(HEADER_MODULO); ?>
<? if ($ejecuta) { ?>
	<? /********************************************************************/ ?>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="<?= $_COOKIE["JIREH_INCLUDE"] ?>css/bootstrap-3.3.7-dist/css/bootstrap.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?= $_COOKIE["JIREH_INCLUDE"] ?>css/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?= $_COOKIE["JIREH_INCLUDE"] ?>js/treeview/css/bootstrap-treeview.css" media="screen">
	<link rel="stylesheet" href="<?= $_COOKIE["JIREH_INCLUDE"] ?>css/dataTables/dataTables.bootstrap.min.css">
	<!--JavaScript-->
	<script type="text/javascript" language="JavaScript" src="<?= $_COOKIE["JIREH_INCLUDE"] ?>js/treeview/js/bootstrap-treeview.js"></script>
	<script type="text/javascript" language="javascript" src="<?= $_COOKIE["JIREH_INCLUDE"] ?>js/Webjs.js"></script>
	<script type="text/javascript" src="<?= $_COOKIE["JIREH_INCLUDE"] ?>js/dataTables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?= $_COOKIE["JIREH_INCLUDE"] ?>js/dataTables/dataTables.bootstrap.min.js"></script>


	<script src="js/jquery.min.js" type="text/javascript"></script>


	<!-- FUNCIONES PARA MANEJO DE PESTA�AS  -->

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="<?= $_COOKIE["JIREH_INCLUDE"] ?>css/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="screen" />
	<link type="text/css" href="css/style.css" rel="stylesheet">
	</link>
	<link type="text/css" href="css/style.css" rel="stylesheet">
	</link>
	<link rel="stylesheet" href="media/css/bootstrap.css">
	<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">

	<!--Javascript-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="media/js/jquery-1.10.2.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="media/js/dataTables.bootstrap.min.js"></script>
	<script src="media/js/bootstrap.js"></script>
	<script type="text/javascript" language="javascript" src="<?= $_COOKIE["JIREH_INCLUDE"] ?>css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

	<script>
		function vista_previa1(id) {
			xajax_genera_pdf_doc1(id, xajax.getFormValues("form1"));
		}

		function genera_formulario() {
			xajax_genera_formulario();
		}

		function cargar_sucu() {
			xajax_genera_formulario('sucursal', xajax.getFormValues("form1"));
		}

		function cargar_tran() {
			xajax_genera_formulario('tran', xajax.getFormValues("form1"));
		}

		function autocompletar(empresa, event, op) {
			if (event.keyCode == 13 || event.keyCode == 115) { // F4
				var empl = document.form1.clpv_empl.checked;
				var cliente_nom = '';

				if (empl == false) {
					if (op == 0) {
						cliente_nom = document.getElementById('cliente_nombre').value;
					} else {
						cliente_nom = document.getElementById('clpv_nom').value;
					}
					var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
					var pagina = '../comprob_egreso/buscar_cliente.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cliente=' + cliente_nom + '&empresa=' + empresa + '&op=' + op;
					window.open(pagina, "", opciones);
				} else {
					cliente_nom = document.getElementById('cliente_nombre').value;
					var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
					var pagina = '../comprob_egreso/buscar_empl.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cliente=' + cliente_nom + '&empresa=' + empresa + '&op=' + op;
					window.open(pagina, "", opciones);

				} // fin if
			}
		}

		function guardar() {
			if (ProcesarFormulario() == true) {
				var asto_cod = document.getElementById('asto_cod').value;
				var compr_cod = document.getElementById('compr_cod').value;
				if (asto_cod == '' && compr_cod == '') {
					document.getElementById("guardar").style.display = "none";
					jsShowWindowLoad();
					xajax_guardar(xajax.getFormValues("form1"));
				} else {
					alert('Egreso ya registrado');
				}
			}
		}


		function habilitar_boton() {
			document.getElementById("guardar").style.display = "inherit";
		}


		function consultar() {
			xajax_consultar(xajax.getFormValues("form1"));
		}

		function cerrar_ventana() {
			CloseAjaxWin();
		}

		function anadir_mp() {
			xajax_agrega_modifica_grid_mp(0, 0, xajax.getFormValues("form1"));
		}

		function cargar_grid_mp() {
			xajax_cargar_grid_mp(0, xajax.getFormValues("form1"));
		}

		function cargar_grid_in() {
			xajax_cargar_grid_in(0, xajax.getFormValues("form1"));
		}

		function anadir_in() {
			xajax_agrega_modifica_grid_in(0, 0, xajax.getFormValues("form1"));
		}


		function facturas(empresa, event) {
			if (event.keyCode == 13 || event.keyCode == 115) { // F4
				var factura = document.getElementById('factura').value;
				if (factura.length == 0) {
					factura = '';
				}
				var sucu = document.getElementById('sucursal').value;
				var clpv = document.getElementById('clpv_cod').value;
				var tran = document.getElementById('tran').value;
				var det = document.getElementById('det_dir').value;
				var coti = document.getElementById('cotizacion').value;
				var mone = document.getElementById('moneda').value;
				var coti_ext = document.getElementById('cotizacion_ext').value;

				var array = [factura, sucu, clpv, empresa, tran, det, coti, mone, coti_ext];
				AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '../comprob_egreso/buscar_factura.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&array=' + array, 'DetalleShow', 'iframe', 'FACTURAS', '800', '300', '10', '10', '1', '1');
			}
		}

		function cod_retencion(empresa, event) {
			if (event.keyCode == 13 || event.keyCode == 115) { // F4
				var codret = '';
				codret = document.getElementById('cod_ret').value;
				clpv_cod = document.getElementById('clpv_cod').value;

				var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
				var pagina = '../comprob_egreso/buscar_codret.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&codret=' + codret + '&empresa=' + empresa + '&clpv_cod=' + clpv_cod;
				window.open(pagina, "", opciones);
			}
		}

		function fact_retencion(empresa, event) {
			if (event.keyCode == 13 || event.keyCode == 115) { // F4
				var factura = document.getElementById('fact_ret').value;
				if (factura.length == 0) {
					factura = '';
				}
				var sucu = document.getElementById('sucursal').value;
				var clpv = document.getElementById('clpv_cod').value;
				var cod_ret = document.getElementById('cod_ret').value;
				var array = [factura, sucu, clpv, empresa, cod_ret];
				AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '../comprob_egreso/buscar_fact_ret.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&array=' + array, 'DetalleShow', 'iframe', 'FACTURAS', '800', '300', '10', '10', '1', '1');
			}
		}


		function anadir_ret() {
			xajax_agrega_modifica_grid_ret(0, xajax.getFormValues("form1"));
		}

		function auto_dasi(empresa, event, op) {
			if (event.keyCode == 13 || event.keyCode == 115) { // F4
				if (op == 0) {
					var nom = document.getElementById('nom_cta').value;
				} else {
					var cod = document.getElementById('cod_cta').value;
				}
				var nom = document.getElementById('nom_cta').value;
				var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
				var pagina = '../comprob_egreso/buscar_cuentas.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cuenta=' + nom + '&empresa=' + empresa + '&op=' + op + '&codigo=' + cod;
				window.open(pagina, "", opciones);
			}
		}

		function anadir_dasi() {
			var valor = document.getElementById('val_cta').value;
			if (valor.length > 0) {

				var constancia_detraccion_sn = document.getElementById('constancia_detraccion_sn').value;
				if (constancia_detraccion_sn == 'S') {

					var date = new Date();
					var anio = date.getFullYear();
					var mes = (date.getMonth() + 1);
					var dia = date.getDate();

					if (mes < 10) {
						mes = '0' + mes;
					}

					var fecha_ini = anio + "-" + mes + "-" + dia;

					Swal.fire({
						title: 'Constancia de depostito de detraccion',
						html: `
                                            <div class="col-md-12" style="margin-top: 5px !important">
                                                <div class="form-row">

                                                    <div class="col-md-6">
                                                        <label for="empresa">* Numero:</label>
                                                        <input type="text" class="form-control input-sm" placeholder="" value="" id="numero_deposito_detraccion_ad" name="numero_deposito_detraccion_ad" style="text-transform: uppercase" />
                                                    </div>

													<div class="col-md-6">
                                                        <label for="empresa">* Fecha de Emision:</label>
                                                        <input type="date" class="form-control input-sm" placeholder="" value="${fecha_ini}" id="fecha_emision_detraccion_ad" name="fecha_emision_detraccion_ad"  />
                                                    </div>

                                                </div>
                                            </div>`,

						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						width: '50%',
					}).then((result) => {
						if (result.value) {
							var numero_deposito_detraccion_ad = document.getElementById('numero_deposito_detraccion_ad').value;
							var fecha_emision_detraccion_ad = document.getElementById('fecha_emision_detraccion_ad').value;
							document.getElementById('constancia_detraccion_sn').value = 'N';
							document.getElementById('numero_deposito_detraccion').value = numero_deposito_detraccion_ad;
							document.getElementById('fecha_emision_detraccion').value = fecha_emision_detraccion_ad;
							xajax_agrega_modifica_grid_dia(0, xajax.getFormValues("form1"));
						} else {
							document.getElementById('constancia_detraccion_sn').value = 'N';
							document.getElementById('numero_deposito_detraccion').value = '';
							document.getElementById('fecha_emision_detraccion').value = '';
							xajax_agrega_modifica_grid_dia(0, xajax.getFormValues("form1"));
						}
					});
				} else {
					document.getElementById('constancia_detraccion_sn').value = 'N';
					document.getElementById('numero_deposito_detraccion').value = '';
					document.getElementById('fecha_emision_detraccion').value = '';
					xajax_agrega_modifica_grid_dia(0, xajax.getFormValues("form1"));
				}

			} else {
				alert('!!! Por favor Ingrese el Valor...');
			}
		}

		function numero_ret() {
			xajax_numero_ret(xajax.getFormValues("form1"));
		}

		function total_diario() {
			xajax_total_diario(xajax.getFormValues("form1"));
		}

		function cargar_detalle() {
			var msn = document.getElementById('detalle').value;
			document.getElementById('det_dir').value = msn.toUpperCase();
			document.getElementById('ret_det').value = msn.toUpperCase();
			document.getElementById('detalla_diario').value = msn.toUpperCase();
			document.getElementById('detalle').value = msn.toUpperCase();
		}



		function generar_pdf() {
			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=370, top=255, left=130";
			var pagina = '../../Include/documento_pdf.php?sesionId=<?= session_id() ?>';
			window.open(pagina, "", opciones);
		}

		function generar_pdf2() {
			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=.370, top=255, left=130";
			var pagina = '../../Include/documento_pdf_compras.php?sesionId=<?= session_id() ?>';
			window.open(pagina, "", opciones);
		}

		function imprimirJustificaciones(cod_pgs, tipo) {
			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			var pagina = '../apropres_pago/_view_apropres_pago.php?sesionId=<?= session_id() ?>&codigo=' + cod_pgs;
			window.open(pagina, "", opciones);
		}

		function adjuntos_prod(idempresa, idsucursal, codpedi) {
			xajax_form_adjuntos(idempresa, idsucursal, codpedi, xajax.getFormValues("form1"));
		}

		function abre_modal() {
			$("#ModalPago47").modal("show");
		}

		function seleccionaItem(empr, sucu, ejer, mes, asto) {
			$("#miModal3").modal("show");
			$("#divInfo").html('');
			$("#divDirectorio").html('');
			$("#divRetencion").html('');
			$("#divDiario").html('');
			$("#divAdjuntos").html('');
			xajax_verDiarioContable(xajax.getFormValues("form1"), empr, sucu, ejer, mes, asto);
		}

		function imprime_cheque(ubi) {
			var empresa = document.getElementById("empresa").value;
			var sucursal = document.getElementById("sucursal").value;
			var cod_prove = document.getElementById("cliente").value;
			var asto_cod = document.getElementById("asto_cod").value;
			var ejer_cod = document.getElementById("ejer_cod").value;
			var prdo_cod = document.getElementById("prdo_cod").value;
			var formato = document.getElementById("formato").value;
			var ftrn_tip_movi = document.getElementById("ftrn_tip_movi").value;


			var id = empresa + '/' + sucursal + '/' + asto_cod + '/' + ejer_cod + '/' + prdo_cod;

			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=700, top=255, left=30";
			var pagina = '../../' + ubi + '?sesionId=<?= session_id() ?>&dato=' + id;
			window.open(pagina, "", opciones);
		}

		function vista_previa() {
			var empresa = document.getElementById("empresa").value;
			var sucursal = document.getElementById("sucursal").value;
			var cod_prove = document.getElementById("cliente").value;
			var asto_cod = document.getElementById("asto_cod").value;
			var ejer_cod = document.getElementById("ejer_cod").value;
			var prdo_cod = document.getElementById("prdo_cod").value;
			var formato = document.getElementById("formato").value;
			var ftrn_tip_movi = document.getElementById("ftrn_tip_movi").value;



			if (ftrn_tip_movi == 'EGRESO') {
				xajax_genera_pdf_doc(empresa, sucursal, asto_cod, ejer_cod, prdo_cod, formato);

			} else {
				var formato = document.getElementById("formato").value;

				xajax_genera_pdf_cheque(asto_cod, formato);
			}

			/*else {

				var id = empresa + '/' + sucursal + '/' + asto_cod + '/' + ejer_cod + '/' + prdo_cod;
				var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=700, top=255, left=30";
				var pagina = '../teso_comprobante/cheque.php?sesionId=<?= session_id() ?>&dato=' + id;
				window.open(pagina, "", opciones);

			}

			/*var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			var pagina = '../comprob_ingreso/vista_previa.php?sesionId=<?= session_id() ?>&sucursal='+  sucursal+'&cod_prove='+cod_prove+'&asto='+asto_cod+'&ejer='+ejer_cod+'&mes='+prdo_cod;
			window.open(pagina, "", opciones);*/

		}


		/*    function vista_previa() {
            var sucursal  = document.getElementById("sucursal").value;
            var cod_prove = document.getElementById("cliente").value;
            var asto_cod  = document.getElementById("asto_cod").value;
            var ejer_cod  = document.getElementById("ejer_cod").value;
            var prdo_cod  = document.getElementById("prdo_cod").value;
			var tipo = document.getElementById("tipo_doc").value;
            var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
            var pagina = '../comprob_egreso/vista_previa.php?sesionId=<?= session_id() ?>&sucursal='+  sucursal+'&cod_prove='+cod_prove+'&asto='+asto_cod+'&ejer='+ejer_cod+'&mes='+prdo_cod+'&tipo='+tipo;
            window.open(pagina, "", opciones);
        }*/
		/*
		function vista_previa( ){
			var idempresa  = document.getElementById("empresa").value;
			var idsucursal  = document.getElementById("sucursal").value;
            var cod_prove = document.getElementById("cliente").value;
            var asto_cod  = document.getElementById("asto_cod").value;
            var ejer  = document.getElementById("ejer_cod").value;
            var prdo  = document.getElementById("prdo_cod").value;
			var tipo = document.getElementById("tipo_doc").value;
			var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			var pagina = '../contabilidad_comprobante/vista_previa.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&empresa='+ idempresa+'&sucursal='+idsucursal+
								'&asto='+asto_cod+'&ejer='+ejer+'&mes='+prdo+'&tipo='+tipo;
			window.open(pagina,"",opciones);
		}
*/
		function cheque() {
			//var alert = window.alert('Massage');
			//alert.show();
			//alert.modal('hide');
			//alert('Cheque...');

			var empr = document.getElementById('empresa').value;
			var sucu = document.getElementById('sucursal').value;
			var str = document.getElementById('clpv_nom').value;
			var clpv = str.replace(/&/g, ""); //str.substring(0, 50);
			clpv = clpv.replace(/,/g, ""); //str.substring(0, 50);

			var valor = document.getElementById('val_cta').value;
			var detalle = document.getElementById('detalla_diario').value;
			var moneda = document.getElementById('moneda').value;
			var coti = document.getElementById('cotizacion').value;
			var coti_ext = document.getElementById('cotizacion_ext').value;
			var cliente = document.getElementById('cliente').value;
			var fecha = document.form1.fecha.value;

			var s = document.getElementById('val_cta').value;

			// Replace "the" with "a".
			var re = /,/g;
			var valor = s.replace(re, "");

			var array = [empr, sucu, clpv, valor, detalle, moneda, coti, coti_ext, cliente];
			AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '../comprob_egreso/cheque.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&fecha=' + fecha + '&array=' + array, 'DetalleShow', 'iframe', 'CHEQUE', '800', '300', '10', '10', '1', '1');

		}

		function cargar_coti() {
			xajax_cargar_coti(xajax.getFormValues("form1"));
		}

		function anadir_dir(cuenta = '') {
			var tran = document.getElementById('tran').value;
			if (tran.length > 0) {
				xajax_agrega_modifica_grid_dir_ori(0, xajax.getFormValues("form1"), cuenta);
			} else {
				alert('Por favor seleccione Transaccion....');
			}
		}

		function prestamo() {
			var empr = document.getElementById('empresa').value;
			var sucu = document.getElementById('sucursal').value;
			var clpv = document.getElementById('cliente_nombre').value;
			var detalle = document.getElementById('detalle').value;
			var clpv = document.getElementById('cliente').value;
			var coti = document.getElementById('cotizacion').value;
			var mone = document.getElementById('moneda').value;

			if (clpv.length == 0 || detalle.length == 0) {
				alert('Por favor Ingrese Beneficiario o Detalle...');
			} else {
				var array = [empr, sucu, clpv, detalle, mone, coti];

				AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '../comprob_egreso/prestamo_empleado.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&&array=' + array, 'DetalleShow', 'iframe', 'Prestamo', '900', '380', '10', '10', '1', '1');
			}
		}

		function prestamosClientes() {
			AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '../solicitud_cre/credito.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&id=', 'DetalleShow', 'iframe', 'PRESTAMOS', '1000', '500', '0', '0', '0', '0');
		}

		function prestamoAprobado() {
			document.getElementById('miModal').innerHTML = '';
			$("#miModal").modal("show");
			xajax_reporte_credito(xajax.getFormValues("form1"));
		}

		function seleccionaPrestamo(a, b) {
			xajax_checkPrestamo(a, b);
		}

		function parametrosPrestamo() {
			document.getElementById('miModal').innerHTML = '';
			$("#miModal").modal("show");
			xajax_parametrosPrestamo(xajax.getFormValues("form1"));
		}

		function ventanaCuentasContables(event, op) {
			if (event.keyCode == 115 || event.keyCode == 13) { // F4
				var cuenta = document.getElementById('cuenta_' + op).value;
				var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=1100, height=500, top=300, left=100";
				var pagina = '../comprob_egreso/cuentas_contables.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cuenta=' + cuenta + '&op=' + op;
				window.open(pagina, "", opciones);
			}
		}

		function cuentaAplicada(a, b) {
			document.getElementById('cuenta_' + b).value = a;
		}

		function centro_costo_cuen(id) {
			if (id == 'S') {
				document.getElementById('ccosn').value = '';
				document.getElementById('ccosn').disabled = false;
			} else if (id == 'N') {
				document.getElementById('ccosn').value = '';
				document.getElementById('ccosn').disabled = true;
			}
		}


		function centro_actividad(id) {
			if (id == 'S') {
				document.getElementById('actividad').value = '';
				document.getElementById('actividad').disabled = false;
			} else if (id == 'N') {
				document.getElementById('actividad').value = '';
				document.getElementById('actividad').disabled = true;
			}
		}


		function cargar_lista_tran(op) {
			xajax_cargar_lista_tran(xajax.getFormValues("form1"), op);
		}


		function eliminar_lista_tran() {
			var sel = document.getElementById("tran");
			for (var i = (sel.length - 1); i >= 1; i--) {
				aBorrar = sel.options[i];
				aBorrar.parentNode.removeChild(aBorrar);
			}
		}

		function anadir_elemento_tran(x, i, elemento) {
			var lista = document.form1.tran;
			var option = new Option(elemento, i);
			lista.options[x] = option;
		}


		function cargar_lista_subcliente() {
			xajax_cargar_lista_subcliente(xajax.getFormValues("form1"));
		}


		function eliminar_lista_subcliente() {
			var sel = document.getElementById("ccli");
			for (var i = (sel.length - 1); i >= 1; i--) {
				aBorrar = sel.options[i];
				aBorrar.parentNode.removeChild(aBorrar);
			}
		}

		function anadir_elemento_subcliente(x, i, elemento) {
			var lista = document.form1.ccli;
			var option = new Option(elemento, i);
			lista.options[x] = option;
		}


		function controlPeriodoIfx() {
			xajax_controlPeriodoIfx(xajax.getFormValues("form1"));
		}


		function calculaValorRetenido() {
			xajax_calculaValorRetenido(xajax.getFormValues("form1"));
		}

		//// nommina
		function nomina() {
			document.getElementById('miModal').innerHTML = '';
			$("#miModal").modal("show");
			xajax_nomina(xajax.getFormValues("form1"));
		}

		function buscar_nomina() {
			xajax_buscar_nomina(xajax.getFormValues("form1"));
		}

		function marcar(source) {
			checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
			for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles
			{
				if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
				{
					checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
				}
			}
			//xajax_suma(xajax.getFormValues("form1"));
		}

		function generar_cheques_empleados() {
			document.getElementById('miModal2').innerHTML = '';
			$("#miModal2").modal("show");
			xajax_generar_cheques_empleados('nuevo', xajax.getFormValues("form1"));

		}

		function cargar_cuenta() {
			xajax_generar_cheques_empleados('cuenta', xajax.getFormValues("form1"));
		}

		function procesar_cheques_nomina() {
			xajax_procesar_cheques_nomina(xajax.getFormValues("form1"));
		}

		function vista_previa_diario(sucursal, cod_prove, asto_cod, ejer_cod, prdo_cod) {
			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			var pagina = '../diario_conta/vista_previa.php?sesionId=<?= session_id() ?>&sucursal=' + sucursal + '&cod_prove=' + cod_prove + '&asto=' + asto_cod + '&ejer=' + ejer_cod + '&mes=' + prdo_cod;
			window.open(pagina, "", opciones);
		}

		function vista_previa_diario2(idempresa, sucursal, cod_prove, asto_cod, ejer_cod, prdo_cod) {
			xajax_genera_pdf_doc_compras(idempresa, sucursal, asto_cod, ejer_cod, prdo_cod);
			// var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			// var pagina = '../contabilidad_comprobante/vista_previa.php?sesionId=<?= session_id() ?>&sucursal='+  sucursal+'&cod_prove='+cod_prove+'&asto='+asto_cod+'&ejer='+ejer_cod+'&mes='+prdo_cod;
			// window.open(pagina, "", opciones);
		}

		function generar_pdf_compras() {
			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=.370, top=255, left=130";
			var pagina = '../../Include/documento_pdf3.php?sesionId=<?= session_id() ?>';
			//         var pagina = '../pedido/vista_previa.php?sesionId=<?= session_id() ?>&codigo='+codigo;
			//AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '/documento_pdf3.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false, 'DetalleShow', 'iframe', 'Pedidos', '590', '200', '10', '10', '1', '1');
			window.open(pagina, "", opciones);
		}

		function genera_documento(tipo_documento, id, clavAcce, clpv, num_fact, ejer, asto, fec_emis, sucu) {
			xajax_genera_documento(tipo_documento, id, clavAcce, clpv, num_fact, ejer, asto, fec_emis, sucu);
		}

		function modificar_valor(id, empresa, sucursal) {
			xajax_form_modificar_valor(id, empresa, sucursal, xajax.getFormValues("form1"));
		}


		function abre_modal_fact() {
			$("#mostrarmodalfact").modal("show");
		}

		function procesar(id, opcion) {
			xajax_modificar_valor(id, opcion, xajax.getFormValues("form1"));
			$("#mostrarmodal").modal("hide");
		}

		function convertir_dir() {
			xajax_convertir_dir(xajax.getFormValues("form1"));
		}


		function mascara(o, f) {
			v_obj = o;
			v_fun = f;
			setTimeout("execmascara()", 1);
		}

		function execmascara() {
			v_obj.value = v_fun(v_obj.value);
		}

		function cpf(v) {
			v = v.replace(/([^0-9\.]+)/g, '');
			v = v.replace(/^[\.]/, '');
			v = v.replace(/[\.][\.]/g, '');
			v = v.replace(/\.(\d)(\d)(\d)/g, '.$1$2');
			v = v.replace(/\.(\d{1,2})\./g, '.$1');
			v = v.toString().split('').reverse().join('').replace(/(\d{3})/g, '$1,');
			v = v.split('').reverse().join('').replace(/^[\,]/, '');
			return v;
		}


		function enter_dir(event) {
			if (event.keyCode == 115 || event.keyCode == 13) { // F4
				anadir_dir();
			}
		}

		function enter_dasi(event) {
			if (event.keyCode == 115 || event.keyCode == 13) { // F4
				anadir_dasi();
			}
		}


		function documento_digito() {
			xajax_documento_digito(xajax.getFormValues("form1"));
		}


		function facturas_clpv(empresa, event) {
			var factura = document.getElementById('factura').value;
			if (factura.length == 0) {
				factura = '';
			}
			var sucu = document.getElementById('sucursal').value;
			var clpv = document.getElementById('clpv_cod').value;
			var tran = document.getElementById('tran').value;
			var det = document.getElementById('det_dir').value;
			var coti = document.getElementById('cotizacion').value;
			var mone = document.getElementById('moneda').value;
			var coti_ext = document.getElementById('cotizacion_ext').value;

			var array = [factura, sucu, clpv, empresa, tran, det, coti, mone, coti_ext];
			AjaxWin('<?= $_COOKIE["JIREH_INCLUDE"] ?>', '../comprob_egreso/buscar_factura.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&array=' + array, 'DetalleShow', 'iframe', 'FACTURAS', '800', '300', '10', '10', '1', '1');

		}


		function ftrn_tip_movi22() {
			xajax_ftrn_tip_movi(xajax.getFormValues("form1"));
		}

		function autocompletar_btn() {
			$("#ModalPago").modal("show");
			xajax_genera_pagos(xajax.getFormValues("form1"));
		}

		function cargar_pagos(codpago, tipo) {

			var empresa = document.getElementById('empresa').value;
			var sucu = document.getElementById('sucursal').value;
			var clpv = document.getElementById('clpv_cod').value;
			var tran = document.getElementById('tran').value;
			var det = document.getElementById('det_dir').value;
			var coti = document.getElementById('cotizacion').value;
			var mone = document.getElementById('moneda').value;
			var coti_ext = document.getElementById('cotizacion_ext').value;

			cerrarModal();

			if (tipo == 'PAGO FACTURAS') {
				//xajax_reporte_facturas_pagos(codpago);
				xajax_agrega_modifica_grid_dir_pago(0, xajax.getFormValues("form1"), 0, coti, mone, coti_ext, codpago, tipo);
				//facturas_clpv(empresa, event );
			} else {
				xajax_agrega_modifica_grid_dir_pago(0, xajax.getFormValues("form1"), 0, coti, mone, coti_ext, codpago, tipo);
			}
		}



		function cerrarModal() {
			$("#ModalPago").html("");
			$("#ModalPago").modal("hide");
		}

		function cheque_pago(nom, val, bandera = false) {
			var empr = document.getElementById('empresa').value;
			var sucu = document.getElementById('sucursal').value;
			var str = document.getElementById('clpv_nom').value;
			var clpv = str.replace(/&/g, ""); //str.substring(0, 50);
			clpv = clpv.replace(/,/g, ""); //str.substring(0, 50);

			var valor = document.getElementById('val_cta').value;
			var detalle = document.getElementById('detalla_diario').value;
			var moneda = document.getElementById('moneda').value;
			var coti = document.getElementById('cotizacion').value;
			var coti_ext = document.getElementById('cotizacion_ext').value;
			var cliente = document.getElementById('cliente').value;
			var fecha = document.form1.fecha.value;

			var s = document.getElementById('val_cta').value;

			// Replace "the" with "a".
			var re = /,/g;
			var valor = s.replace(re, "");

			var array = [empr, sucu, nom, val, detalle, moneda, coti, coti_ext, cliente];

			xajax_modal_cheque(fecha, array, bandera);
		}

		function abre_modalch() {
			$("#mostrarmodal").modal("show");
		}

		function cerrarModalch() {
			$("#mostrarmodal").html("");
			$("#mostrarmodal").modal("hide");
		}

		function cargar(codpgs) {
			var detalle = document.getElementById("detalle_fact_vent").value;
			if (detalle != '') {

				var empresa = document.getElementById('empresa').value;

				var coti = document.getElementById('cotizacion').value;
				var mone = document.getElementById('moneda').value;
				var coti_ext = document.getElementById('cotizacion_ext').value;
				xajax_agrega_modifica_grid_dir(0, xajax.getFormValues("form1"), 0, empresa, coti, mone, coti_ext, codpgs);
				$("#mostrarmodal").modal("hide");
				setTimeout(
					function() {
						cheque()
					}, 2000
				);
			} else {
				alert('Debe de ingresar un detalle');
			}

		}

		function recalcular_valor_total() {
			var valor_monto_total = document.getElementById('monto_letrac').value;

			var array_valor_cuota = document.querySelectorAll('[id^="valor_cuota_"]');
			var total_coutas = 0;
			var total_porcentaje = 0;
			array_valor_cuota.forEach(element_ => {
				var numero_variable = element_.id.replace('valor_cuota_', '');
				var valor_cuota = document.getElementById('valor_cuota_' + numero_variable).value
				total_coutas += parseFloat(valor_cuota);

				if (!isNaN(valor_cuota) && !isNaN(valor_monto_total) && valor_monto_total !== 0) {
					var porcentaje = (valor_cuota / valor_monto_total) * 100;
					document.getElementById('porcentaje_cuota_' + numero_variable).value = parseFloat(porcentaje.toFixed(4));
					total_porcentaje += parseFloat(porcentaje.toFixed(4));
				}

			});
			total_coutas = parseFloat(total_coutas.toFixed(2));

			// Validacion totales color
			var texto = '';
			if (parseFloat(total_coutas) > parseFloat(valor_monto_total)) {
				texto = '<label style="color: red !important">' + total_coutas + '</label>';
				texto_p = '<label style="color: red !important">' + total_porcentaje + '%</label>';
			} else {
				texto = '<label>' + total_coutas + '</label>';
				texto_p = '<label>' + total_porcentaje + '%</label>';
			}
			document.getElementById('div_totales_cuota1').innerHTML = texto_p;
			document.getElementById('div_totales_cuota2').innerHTML = texto;

		}



		function cargarModalOc() {
			var clpv_cod_clpv = document.getElementById('cliente').value;
			if (clpv_cod_clpv != '') {
				$("#modalOcClpv").modal("show");
				xajax_cargarModalOc(xajax.getFormValues("form1"), 1);
			} else {
				alert('Selecciona un proveedor para continuar');
			}

		}


		function vista_previa_(id, empr, sucu) {
			var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			var pagina = '../inventario_anulacion_ad/vista_previa_totales.php?sesionId=<?= session_id() ?>&codigo=' + id + '&empr=' + empr + '&sucu=' + sucu;
			window.open(pagina, "", opciones);
		}

		function seleccionar_oc(minv_cod, minv_secu) {
			document.getElementById('factura').value = minv_secu;
			$("#modalOcClpv").modal("hide");

		}





		//-----------------------------------------------------------
		// 			INICIO ADJUNTOS  SUEJO4967					   //
		//-----------------------------------------------------------


		function abre_modal_adjuntos() {

			var clpv = document.getElementById('clpv_cod').value;

			if (clpv > 0) {


				$("#miModal").html("");
				$("#miModal").modal("show");
				xajax_modal_adjuntos(xajax.getFormValues("form1"));



			} else {

				Swal.fire({
					position: 'center',
					type: 'warning',
					title: '<h5>Porfavor selecione un <b>Beneficiario</b> para continuar</h5>',
					showConfirmButton: true,
					confirmButtonText: 'Aceptar',
					timer: 2000
				})

			}


		}

		function setup_adj() {
			Webcam.reset();
			Webcam.attach('#my_camera_adj');
			$("#my_camera_adj").css("display", "block");
			$("#my_camera_adj_btn").css("display", "block");
			$("#results_adj").css("display", "none");
			$("#archivo_up").css("display", "none");
			$("#btn_adj_1").css("display", "none");
			$("#btn_adj_2").css("display", "none");
		}

		function muestra_adj() {
			$("#my_camera_adj").css("display", "none");
			$("#my_camera_adj_btn").css("display", "none");
			$("#results_adj").css("display", "none");
			$("#archivo_up").css("display", "block");
			$("#btn_adj_1").css("display", "none");
			$("#btn_adj_2").css("display", "block");
			Webcam.reset()
		}



		function guardarAdjuntosImg() {
			var base64image = document.getElementById("imageprevadj").src;

			Webcam.upload(base64image, 'upload_adj.php', function(code, text) {
				xajax_guardarAdjuntosImg(xajax.getFormValues("form1"), text);
			});
		}

		function guardarAdjuntos() {
			var id = "archivo";

			$(".upload-msg-archivo").text('Cargando...');
			var inputFileImage = document.getElementById(id);
			var files = inputFileImage.files;
			var data = new FormData();
			for (i = 0; i < files.length; i++) {
				var file = files.item(i)
				data.append(i, file);
			}
			$.ajax({
				url: "upload_archivo.php?id=" + id, // Url to which the request is send
				type: "POST", // Type of request to be send, called as method
				data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false, // The content type used when sending data to the server.
				cache: false, // To unable request pages to be cached
				processData: false, // To send DOMDocument or non processed data file it is set to false
				success: function(data) // A function to be called if request succeeds
				{
					$(".upload-msg-archivo").html(data);
					window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function() {
							$(this).remove();
						});
					}, 5000);
				}
			});
		}

		function guardarAjuntospg() {
			xajax_guardarAdjuntos(xajax.getFormValues("form1"));
		}

		function verAdj(id_instalacion) {
			xajax_verAdj(xajax.getFormValues("form1"));
		}

		function guardar_transferencia(bode_cod_bode, tran, bodega_destino) {
			xajax_guardar_transferencia_repa(xajax.getFormValues("form1"), bode_cod_bode, tran, bodega_destino);
		}

		function reimpresion(ult) {
			xajax_reimpresion(xajax.getFormValues("form1"), ult);
		}

		function dowloand(ruta) {
			document.location = "dowloand.php?ruta=" + ruta;
		}



		// ---------------------------------------------------------
		// 				FIN ADJUNTOS SUEJO4967					  //
		// ---------------------------------------------------------



		// --------------------------------------------------------------------
		// LETRAS DE CAMBIO AD
		// --------------------------------------------------------------------

		function abre_modal_canje() {
			xajax_abre_modal_canje(xajax.getFormValues("form1"));
		}

		function abre_modal_letra() {
			$("#mostrarModalLera").modal("show");
		}

		function cierra_modal_letra() {
			$("#mostrarModalLera").modal("hide");
		}

		function procesar_letras() {
			xajax_procesar_letras(xajax.getFormValues("form1"));
		}

		function agregar_canje_letra() {
			var fecha_cuota_letrac = document.getElementById('fecha_cuota_letrac').value;
			var tipo_letrac = document.getElementById('tipo_letrac').value;
			var dias_cuota_letrac = document.getElementById('dias_cuota_letrac').value;
			var cuota_letrac = document.getElementById('cuota_letrac').value;
			var monto_letrac = document.getElementById('monto_letrac').value;

			if (
				fecha_cuota_letrac != '' &&
				tipo_letrac != 0 &&
				dias_cuota_letrac > 0 &&
				cuota_letrac > 0 &&
				monto_letrac > 0
			) {
				Swal.fire({
					title: 'Estas seguro que deseas agregar estas letras de cambio.',
					text: "",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar',
					allowOutsideClick: false,
					width: '40%',
				}).then((result) => {
					if (result.value) {
						xajax_agregar_canje_letra(xajax.getFormValues("form1"));
					}
				});
			} else {
				Swal.fire({
					title: '<h4>Debe llenar todos los campos para el canje de letra</h4>',
					width: 800,
					type: 'error',
					timer: 3000,
					showConfirmButton: false
				})
			}


		}

		function validar_ceros(x) {
			var numero = document.getElementById('documento_letrac_' + x).value;
			<?php
			$u_pais_dig_fact = '0';
			if ($_SESSION['U_PAIS_DIG_FACP']) {
				$u_pais_dig_fact = $_SESSION['U_PAIS_DIG_FACP'];
			}
			?>
			var num_dig = <?php echo $u_pais_dig_fact; ?>;
			let numeroConCeros = numero.toString().padStart(num_dig, '0');
			document.getElementById('documento_letrac_' + x).value = numeroConCeros;
		}

		function validar_ceros_serie(x) {
			var numero = document.getElementById('serie_letrac_' + x).value;
			<?php
			$u_pais_dig_ser = '0';
			if ($_SESSION['U_PAIS_DIG_SERE']) {
				$u_pais_dig_ser = $_SESSION['U_PAIS_DIG_SERE'];
			}
			?>
			var num_dig = <?php echo $u_pais_dig_ser; ?>;
			let numeroConCeros = numero.toString().padStart(num_dig, '0');
			document.getElementById('serie_letrac_' + x).value = numeroConCeros;
		}

		// --------------------------------------------------------------------
		// FIN LETRAS DE CAMBIO AD
		// --------------------------------------------------------------------

		//
	</script>



	<!--DIBUJA FORMULARIO FILTRO-->

	<body>
		<div class="container-fluid">
			<form id="form1" name="form1" action="javascript:void(null);">

				<div class="main row">
					<div class="col-md-12">
						<div id="divFormularioTotal" class="table-responsive" style="z-index: 99999999999999999;"></div>
					</div>
				</div>
				<input type="hidden" value="0" name="cod_solicitud" id="cod_solicitud">
				<div id="divFormularioCabecera" class="table-responsive"></div>
				<div class="col-md-8" id="pestanas" style="float:left; width: 100%;">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li onclick="muestra_botones()" role="presentation" class="active"><a href="#divDirectorioMenu" aria-controls="divFormularioGenerales" role="tab" data-toggle="tab">DIRECTORIO</a></li>
						<li onclick="muestra_botones()" role="presentation"><a href="#divRetencionMenu" aria-controls="divFormularioDatosSalario" role="tab" data-toggle="tab">RETENCION</a></li>
						<li onclick="muestra_botones()" role="presentation"><a href="#divDiarioMenu" aria-controls="divCag" role="tab" data-toggle="tab">DIARIO</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content" style="width: 100%;">
						<div role="tabpanel" class="tab-pane active" id="divDirectorioMenu" style="width: 100%;">
							<div id="divFormDir" class="table-responsive"></div>
							<div id="divDir" class="table-responsive"></div>
							<div id="divTotDir" class="table-responsive"></div>
						</div>
						<div role="tabpanel" class="tab-pane" id="divRetencionMenu">
							<div id="divFormRet" class="table-responsive"></div>
							<div id="divRet" class="table-responsive"></div>
							<div id="divTotRet" class="table-responsive"></div>
						</div>
						<div role="tabpanel" class="tab-pane" id="divDiarioMenu">
							<div id="divFormDiario" class="table-responsive"></div>
							<div id="divDiario" class="table-responsive"></div>
							<div id="divTotDiario" class="table-responsive"></div>
							<div id="divFormularioModalLetra" class="table-responsive"></div>
						</div>
					</div>
				</div>
				<div style="width: 100%;">
					<div class="modal fade" id="ModalPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
					<div class="modal fade" id="ModalPago47" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
					<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
					<div class="modal fade" id="miModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
					<div class="modal fade" id="modalOcClpv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
				</div>
				<div id="miModal_Diario" class="col-md-12"></div>
				<div id="divFormularioCheque" class="table-responsive"></div>




				<div class="modal fade" id="miModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">DIARIO CONTABLE <span id="divTituloAsto"></span></h4>
							</div>
							<div class="modal-body">
								<div>
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#divInfo" aria-controls="divInfo" role="tab" data-toggle="tab">Informacion</a></li>
										<li role="presentation"><a href="#divDirectorio" aria-controls="divDirectorio" role="tab" data-toggle="tab">Directorio</a></li>
										<li role="presentation"><a href="#divRetencion" aria-controls="divRetencion" role="tab" data-toggle="tab">Retencion</a></li>
										<li role="presentation"><a href="#divDiario" aria-controls="divDiario" role="tab" data-toggle="tab">Diario</a></li>
										<li role="presentation"><a href="#divAdjuntos" aria-controls="divAdjuntos" role="tab" data-toggle="tab">Adjuntos</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="divInfo">...</div>
										<div role="tabpanel" class="tab-pane" id="divDirectorio">...</div>
										<div role="tabpanel" class="tab-pane" id="divRetencion">...</div>
										<div role="tabpanel" class="tab-pane" id="divDiario">...</div>
										<div role="tabpanel" class="tab-pane" id="divAdjuntos">...</div>
									</div>

								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>




			</form>
		</div>
	</body>
	<script>
		genera_formulario();
	</script>
	<? /********************************************************************/ ?>
	<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>