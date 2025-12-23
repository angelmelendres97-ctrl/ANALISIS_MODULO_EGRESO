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
        list($factura, $sucu, $clpv, $idempresa ) = explode(",", $array);
//        echo $clpv;
?>
<script>
	function cerrar_ventana(){
		CloseAjaxWin();
	} 
        
        function cargar_fact(num, base){
                parent.document.getElementById('fact_ret').value = num; 
                parent.document.getElementById('ret_base').value = base; 
                parent.cerrar_ventana();
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
xajax_reporte_facturas_ret( <?=$idempresa?>, <?=$sucu?>, '<?=$clpv?>',  '<?=$factura?>' );
</script>
<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>