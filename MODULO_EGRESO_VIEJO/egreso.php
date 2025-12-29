<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? include_once('../_Modulo.inc.php');?>
<? include_once(HEADER_MODULO);?>
<? if ($ejecuta) { ?>
<? /********************************************************************/ ?>

<!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/bootstrap-3.3.7-dist/css/bootstrap.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>js/treeview/css/bootstrap-treeview.css" media="screen">
    <link rel="stylesheet" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/dataTables/dataTables.bootstrap.min.css">
    <!--JavaScript-->
    <script type="text/javascript" language="JavaScript" src="<?=$_COOKIE["JIREH_INCLUDE"]?>js/treeview/js/bootstrap-treeview.js"></script>
    <script type="text/javascript" language="javascript" src="<?=$_COOKIE["JIREH_INCLUDE"]?>js/Webjs.js"></script>
    <script type="text/javascript" src="<?=$_COOKIE["JIREH_INCLUDE"]?>js/dataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=$_COOKIE["JIREH_INCLUDE"]?>js/dataTables/dataTables.bootstrap.min.js"></script>

	
	<script src="js/jquery.min.js" type="text/javascript"></script>

<!-- FUNCIONES PARA MANEJO DE PESTA�AS  -->

<!--CSS-->  
    <link rel="stylesheet" type="text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="screen" /><link type="text/css" href="css/style.css" rel="stylesheet"></link>
    <link type="text/css" href="css/style.css" rel="stylesheet"></link>
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
    <script type="text/javascript" language="javascript" src="<?=$_COOKIE["JIREH_INCLUDE"]?>css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	
<script>
	
	function genera_formulario(){
		xajax_genera_formulario();
	}                

    function cargar_sucu(){
		xajax_genera_formulario( 'sucursal', xajax.getFormValues("form1") );
	}
        
    function cargar_tran(){
		xajax_genera_formulario( 'tran', xajax.getFormValues("form1") );
	}
        
        function autocompletar(empresa, event, op) {
            if (event.keyCode == 13 || event.keyCode == 115) { // F4
				var empl        = document.form1.clpv_empl.checked; 				
                var cliente_nom = '';
				
				if(empl==false){
					if(op==0){
						 cliente_nom = document.getElementById('cliente_nombre').value;
					}else{
						 cliente_nom = document.getElementById('clpv_nom').value;
					}
					var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
					var pagina = '../comprob_egreso/buscar_cliente.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cliente=' + cliente_nom+'&empresa='+empresa+'&op='+op;
					window.open(pagina, "", opciones);
				}else{
					cliente_nom = document.getElementById('cliente_nombre').value;
					var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
					var pagina = '../comprob_egreso/buscar_empl.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cliente=' + cliente_nom+'&empresa='+empresa+'&op='+op;
					window.open(pagina, "", opciones);
					
				}// fin if
            }
        }
        
        function guardar(){
            if (ProcesarFormulario()==true){
				document.getElementById("guardar").style.display = "none";
				jsShowWindowLoad();
                xajax_guardar( xajax.getFormValues("form1") );
            }
        }

		
		function habilitar_boton(){
            document.getElementById("guardar").style.display = "inherit";
		}
	
	
        function consultar(){
                xajax_consultar( xajax.getFormValues("form1") );
        }

        function cerrar_ventana(){
    		CloseAjaxWin();
    	}
    
        function anadir_mp(){
                xajax_agrega_modifica_grid_mp(0, 0, xajax.getFormValues("form1"));
        }
        
        function cargar_grid_mp(){
                xajax_cargar_grid_mp(0, xajax.getFormValues("form1"));
        }
        
        function cargar_grid_in(){
                xajax_cargar_grid_in(0, xajax.getFormValues("form1"));
        }
        
        function anadir_in(){
                xajax_agrega_modifica_grid_in(0, 0, xajax.getFormValues("form1"));
        }
        
        
        function facturas(empresa, event ) {
            if (event.keyCode == 13 || event.keyCode == 115) { // F4
                var factura = document.getElementById('factura').value;
                if( factura.length == 0){
                    factura = '';
                }
                var sucu    = document.getElementById('sucursal').value;
                var clpv    = document.getElementById('clpv_cod').value;
                var tran    = document.getElementById('tran').value;
                var det     = document.getElementById('det_dir').value;
				var coti    = document.getElementById('cotizacion').value;
                var mone    = document.getElementById('moneda').value;
				var coti_ext= document.getElementById('cotizacion_ext').value;
				
                var array   = [factura, sucu, clpv, empresa, tran, det, coti, mone, coti_ext]; 
                AjaxWin('<?=$_COOKIE["JIREH_INCLUDE"]?>','../comprob_egreso/buscar_factura.php?sesionId=<?=session_id()?>&mOp=true&mVer=false&array='+array,'DetalleShow','iframe','FACTURAS','800','300','10','10','1','1');
            }
        }
          
        function cod_retencion(empresa, event) {
            if (event.keyCode == 13 || event.keyCode == 115) { // F4
                var codret = '';
                codret   = document.getElementById('cod_ret').value;
				clpv_cod = document.getElementById('clpv_cod').value;
				
                var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
                var pagina = '../comprob_egreso/buscar_codret.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&codret=' + codret+'&empresa='+empresa+'&clpv_cod='+clpv_cod;
                window.open(pagina, "", opciones);
            }
        }
        
        function fact_retencion(empresa, event ) {
            if (event.keyCode == 13 || event.keyCode == 115) { // F4
                var factura = document.getElementById('fact_ret').value;
                if( factura.length == 0){
                    factura = '';
                }
                var sucu    = document.getElementById('sucursal').value;
                var clpv    = document.getElementById('clpv_cod').value;
                var cod_ret = document.getElementById('cod_ret').value;
                var array   = [factura, sucu, clpv, empresa, cod_ret]; 
                AjaxWin('<?=$_COOKIE["JIREH_INCLUDE"]?>','../comprob_egreso/buscar_fact_ret.php?sesionId=<?=session_id()?>&mOp=true&mVer=false&array='+array,'DetalleShow','iframe','FACTURAS','800','300','10','10','1','1');
            }
        }
        
        
        function anadir_ret(){
                xajax_agrega_modifica_grid_ret(0, xajax.getFormValues("form1"));
        }
        
        function auto_dasi(empresa, event, op) {
            if (event.keyCode == 13 || event.keyCode == 115) { // F4
                if(op==0){
                     var nom = document.getElementById('nom_cta').value;
                }else{
                     var cod = document.getElementById('cod_cta').value;
                }
				  var nom = document.getElementById('nom_cta').value;
                var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
                var pagina = '../comprob_egreso/buscar_cuentas.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cuenta=' + nom+'&empresa='+empresa+'&op='+op+'&codigo='+cod;
                window.open(pagina, "", opciones);
            }
        }
        
        function anadir_dasi(){
				var valor = document.getElementById('val_cta').value;
				if( valor.length > 0 ){
					xajax_agrega_modifica_grid_dia(0, xajax.getFormValues("form1"));
				} else {
					alert('!!! Por favor Ingrese el Valor...');
				}
        }
        
        function numero_ret(){
                xajax_numero_ret(  xajax.getFormValues("form1"));
        }
    
        function total_diario(){
                xajax_total_diario(  xajax.getFormValues("form1"));
        }
        
        function cargar_detalle(){
                var msn = document.getElementById('detalle').value;
                document.getElementById('det_dir').value 		= msn.toUpperCase();
                document.getElementById('ret_det').value 		= msn.toUpperCase();
				document.getElementById('detalla_diario').value = msn.toUpperCase();
				document.getElementById('detalle').value        = msn.toUpperCase();
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
		function vista_previa( ){
			var idempresa  = document.getElementById("empresa").value;
			var idsucursal  = document.getElementById("sucursal").value;
            var cod_prove = document.getElementById("cliente").value;
            var asto_cod  = document.getElementById("asto_cod").value;
            var ejer  = document.getElementById("ejer_cod").value;
            var prdo  = document.getElementById("prdo_cod").value;
			var tipo = document.getElementById("tipo_doc").value;
			var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
			var pagina = '../contabilidad_comprobante/vista_previa.php?sesionId=<?=session_id()?>&mOp=true&mVer=false&empresa='+ idempresa+'&sucursal='+idsucursal+
								'&asto='+asto_cod+'&ejer='+ejer+'&mes='+prdo+'&tipo='+tipo;
			window.open(pagina,"",opciones);
		}



        function cheque() {            
            var empr    = document.getElementById('empresa').value;
            var sucu    = document.getElementById('sucursal').value;
			var clpv    = document.getElementById('clpv_nom').value;
            var valor   = document.getElementById('val_cta').value;
			var detalle = document.getElementById('detalla_diario').value;
			var moneda  = document.getElementById('moneda').value;
			var coti    = document.getElementById('cotizacion').value;
			var coti_ext= document.getElementById('cotizacion_ext').value;
			var fecha   = document.form1.fecha.value;
			
			var s 		= document.getElementById('val_cta').value;
			// Replace "the" with "a".
			var re 		= /,/g;
			var valor 	= s.replace(re, "");
            
            var array   = [empr, sucu, clpv, valor, detalle, moneda, coti, coti_ext ]; 
            AjaxWin('<?=$_COOKIE["JIREH_INCLUDE"]?>','../comprob_egreso/cheque.php?sesionId=<?=session_id()?>&mOp=true&mVer=false&fecha='+fecha+'&array='+array,'DetalleShow','iframe','CHEQUE','800','300','10','10','1','1');
            
        }

        function cargar_coti(){
            xajax_cargar_coti(xajax.getFormValues("form1"));
        }
		
		function anadir_dir(){
			var tran    = document.getElementById('tran').value;
			if( tran.length > 0 ){
				xajax_agrega_modifica_grid_dir_ori(0, xajax.getFormValues("form1") );
			}else{
				alert('Por favor seleccione Transaccion....');
			}
        }
        		
		function prestamo(){
                var empr    = document.getElementById('empresa').value;
                var sucu    = document.getElementById('sucursal').value;
				var clpv    = document.getElementById('cliente_nombre').value;
				var detalle = document.getElementById('detalle').value;
				var clpv    = document.getElementById('cliente').value;
				var coti    = document.getElementById('cotizacion').value;
				var mone    = document.getElementById('moneda').value;
			
				if(clpv.length == 0 || detalle.length == 0){
					alert('Por favor Ingrese Beneficiario o Detalle...');					
				}else{
					var array   = [empr, sucu, clpv, detalle, mone, coti ]; 

					AjaxWin('<?=$_COOKIE["JIREH_INCLUDE"]?>','../comprob_egreso/prestamo_empleado.php?sesionId=<?=session_id()?>&mOp=true&mVer=false&&array='+array,'DetalleShow','iframe','Prestamo','900','380','10','10','1','1');
				}                
        } 		
		
		function prestamosClientes(){
			 AjaxWin('<?=$_COOKIE["JIREH_INCLUDE"]?>','../solicitud_cre/credito.php?sesionId=<?=session_id()?>&mOp=true&mVer=false&id=','DetalleShow','iframe','PRESTAMOS','1000','500','0','0','0','0');
		}
		
		function prestamoAprobado(){
			document.getElementById('miModal').innerHTML = '';
			$("#miModal").modal("show");
			xajax_reporte_credito(xajax.getFormValues("form1"));
		}
		
		function seleccionaPrestamo(a, b){
			xajax_checkPrestamo(a, b);
		}
		
		function parametrosPrestamo(){
			document.getElementById('miModal').innerHTML = '';
			$("#miModal").modal("show");
			xajax_parametrosPrestamo(xajax.getFormValues("form1"));
		}
		
		function ventanaCuentasContables(event, op){
			if (event.keyCode == 115 || event.keyCode == 13) { // F4
				var cuenta = document.getElementById('cuenta_' + op).value;				
				var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=1100, height=500, top=300, left=100";
                var pagina = '../comprob_egreso/cuentas_contables.php?sesionId=<?= session_id() ?>&mOp=true&mVer=false&cuenta=' + cuenta + '&op=' + op;
                window.open(pagina, "", opciones);
			}
		}
		
		function cuentaAplicada(a, b){
			document.getElementById('cuenta_' + b).value = a;	
		}
		
		function centro_costo_cuen(id){
			if(id=='S'){
				document.getElementById('ccosn').value    = '';
				document.getElementById('ccosn').disabled = false;
			}else if(id=='N'){
				document.getElementById('ccosn').value    = '';
				document.getElementById('ccosn').disabled = true;
			}
		}
		
		
		function centro_actividad(id){
			if(id=='S'){
				document.getElementById('actividad').value    = '';
				document.getElementById('actividad').disabled = false;
			}else if(id=='N'){
				document.getElementById('actividad').value    = '';
				document.getElementById('actividad').disabled = true;
			}
		}
		
		
		function cargar_lista_tran(op){
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
		
		
		function cargar_lista_subcliente(  ) {
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
		
		
		function controlPeriodoIfx(){
			xajax_controlPeriodoIfx(xajax.getFormValues("form1"));
		}
		
		
		function calculaValorRetenido(){
			xajax_calculaValorRetenido(xajax.getFormValues("form1"));
		}
		
		//// nommina
		function nomina(){
			document.getElementById('miModal').innerHTML = '';
			$("#miModal").modal("show");
			xajax_nomina(xajax.getFormValues("form1"));
		}
		
		function buscar_nomina(){
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
		
		function generar_cheques_empleados(){
			document.getElementById('miModal2').innerHTML = '';
			$("#miModal2").modal("show");
			xajax_generar_cheques_empleados('nuevo',xajax.getFormValues("form1"));
			
		}
		
		 function cargar_cuenta(){
          xajax_generar_cheques_empleados( 'cuenta', xajax.getFormValues("form1"));
        }

        function procesar_cheques_nomina(){
          xajax_procesar_cheques_nomina(  xajax.getFormValues("form1"));
        }
		
		function vista_previa_diario(sucursal, cod_prove, asto_cod, ejer_cod, prdo_cod) {
            var opciones = "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=730, height=380, top=255, left=130";
            var pagina = '../diario_conta/vista_previa.php?sesionId=<?= session_id() ?>&sucursal='+  sucursal+'&cod_prove='+cod_prove+'&asto='+asto_cod+'&ejer='+ejer_cod+'&mes='+prdo_cod;
            window.open(pagina, "", opciones);
        }		
		
		function modificar_valor( id, empresa, sucursal ){
				xajax_form_modificar_valor(  id, empresa, sucursal, xajax.getFormValues("form1"));
		}
		
		function abre_modal(){				
            $("#mostrarmodal").modal("show");
        }
		
		function procesar( id, opcion ){
				xajax_modificar_valor(  id, opcion, xajax.getFormValues("form1"));
				$("#mostrarmodal").modal("hide");
		}
		
		function convertir_dir(){
			xajax_convertir_dir(xajax.getFormValues("form1"));
		}
		
		
		function mascara(o,f){  
			v_obj=o;  
			v_fun=f;  
			setTimeout("execmascara()",1);  
		}  
		
		function execmascara(){   
			v_obj.value=v_fun(v_obj.value);
		}
	
		function cpf(v){     
			v=v.replace(/([^0-9\.]+)/g,''); 
			v=v.replace(/^[\.]/,''); 
			v=v.replace(/[\.][\.]/g,''); 
			v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2'); 
			v=v.replace(/\.(\d{1,2})\./g,'.$1'); 
			v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');    
			v = v.split('').reverse().join('').replace(/^[\,]/,''); 
			return v;  
		}  
	
	
		function enter_dir(event){
			if (event.keyCode == 115 || event.keyCode == 13) { // F4
				anadir_dir();
			}
		}
	
		function enter_dasi(event){
			if (event.keyCode == 115 || event.keyCode == 13) { // F4
				anadir_dasi();
			}
		}
		
		
		function documento_digito(){
			xajax_documento_digito(xajax.getFormValues("form1"));
		}
		
</script>



<!--DIBUJA FORMULARIO FILTRO-->
<body>
<div class="container-fluid">
    <form id="form1" name="form1" action="javascript:void(null);">
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
						<div id="divDir"     class="table-responsive"></div>
						<div id="divTotDir"  class="table-responsive"></div>
					</div>
					<div role="tabpanel" class="tab-pane" id="divRetencionMenu">
						<div id="divFormRet" class="table-responsive"></div>
						<div id="divRet"     class="table-responsive"></div>
						<div id="divTotRet"  class="table-responsive"></div>
					</div>
					<div role="tabpanel" class="tab-pane" id="divDiarioMenu">
						<div id="divFormDiario" class="table-responsive"></div>
						<div id="divDiario"     class="table-responsive"></div>
						<div id="divTotDiario"  class="table-responsive"></div>
					</div>
				</div>
			</div>
			<div style="width: 100%;">
				<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
				<div class="modal fade" id="miModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
			</div>
			<div id="miModal_Diario"    class="col-md-12" ></div>
     </form>
</div>
</body>
<script>genera_formulario();</script>
<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>