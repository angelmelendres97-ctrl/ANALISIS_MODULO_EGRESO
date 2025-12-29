<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? include_once('../_Modulo.inc.php');?>
<? include_once(HEADER_MODULO);?>
<? if ($ejecuta) { ?>
<? /********************************************************************/ ?>
<?
	if(isset($_REQUEST['mOp'])) $mOp=$_REQUEST['mOp'];
		else $mOp='';
        $array = $_GET['array'];
        list($empr, $sucu, $empl, $detalle, $moneda, $coti ) = explode(",", $array);
      //  echo 'sdsd '.$idempresa;
?>


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
      	function cerrar_ventana(){
      		CloseAjaxWin();
      	}        
        
        function generarTablaAmortizacion(){
			       xajax_generarTablaAmortizacion(  xajax.getFormValues("form1") );
        }
        
        function cerrar_ventana(){
      		CloseAjaxWin();
      	}
		
		function guardar_prestamo(){
				xajax_guardar_prestamo( <?=$empr?>, <?=$sucu?>, xajax.getFormValues("form1"));			
		}

		
		function generar_dasi(){				
                parent.xajax_agrega_modifica_grid_dia_empl( 0, xajax.getFormValues("form1"), <?=$empr?>, 
															 <?=$sucu?>, '<?=$detalle?>' ,  '<?=$moneda?>',  '<?=$coti?>'  );
        }
		
</script>
<!-- Divs contenedores!-->
<div align="center">
    <form id="form1" name="form1" action="javascript:void(null);">
      <table align="center" border="0" cellpadding="2" cellspacing="0" width="100%">
        <tr>
          	<td valign="top" align="center">
                    <div id="divFormularioDetalle"></div>
         	</td>
			<td valign="top" align="center">
                    <div id="divTablaAmortizacion"></div>
         	</td>
        </tr>
        </tr>
      </table>
     </form>
</div>
<script>
xajax_formulario_prestamo( <?=$empr?>, <?=$sucu?>, '<?=$empl?>',  '<?=$detalle?>' );
</script>
<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>