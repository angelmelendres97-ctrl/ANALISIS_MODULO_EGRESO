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
        list($idempresa, $sucu, $clpv_nom, $valor, $detalle, $moneda, $coti, $coti_ext ) = explode(",", $array);
		$valor = number_format($valor,2,'.',',');
        //echo $valor;
		$fecha=$_GET['fecha'];
		//var_dump($fecha);exit;
?>
<script>
      	function cerrar_ventana(){
      		CloseAjaxWin();
      	}        
        
        function cargar_cuenta(){
				xajax_reporte_cheque( 'cuenta', xajax.getFormValues("form1"), <?=$idempresa?>, <?=$sucu?> , '<?=$clpv_nom?>', '<?=$valor?>', '<?=$fecha?>' );
        }

        function cargar(){
                parent.xajax_agrega_modifica_grid_dia_cheque( 0, xajax.getFormValues("form1"), <?=$idempresa?>, 
															 <?=$sucu?>, '<?=$detalle?>' ,  '<?=$moneda?>',  '<?=$coti?>',  '<?=$coti_ext?>' );
        }
        
        function cerrar_ventana(){
      		CloseAjaxWin();
      	}
		
		function controlCheque(){
			xajax_controlCheque(xajax.getFormValues("form1"));
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
        </tr>
        </tr>
      </table>
     </form>
</div>
<script>
xajax_reporte_cheque( 'nuevo', xajax.getFormValues("form1"), <?=$idempresa?>, <?=$sucu?>, '<?=$clpv_nom?>', '<?=$valor?>', '<?=$fecha?>' );
</script>
<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>