<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? include_once('../_Modulo.inc.php');?>
<? include_once(HEADER_MODULO);?>
<? if ($ejecuta) { ?>
<? /********************************************************************/ ?>
<?
	if(isset($_REQUEST['mOp'])) $mOp=$_REQUEST['mOp'];
		else $mOp='';
	if(isset($_REQUEST['Id'])) $Id=$_REQUEST['Id'];
		else $Id='-1';
	if(isset($_REQUEST['id_p'])) $id_p=$_REQUEST['id_p'];
		else $id_p='';
	if(isset($_REQUEST['empresa'])) $empresa=$_REQUEST['empresa'];
		else $empresa='';
?>
<script>

        function modificar(){           
            if(ProcesarFormulario()==true){
                xajax_modificar( <?=$id_p?>, <?=$empresa?>, xajax.getFormValues("form1"));
            }
        }

	function cerrar_ventana(){
		CloseAjaxWin();
	}

        function cargar_prod(){
                xajax_genera_formulario_modifica_detalle( <?=$id_p?>, <?=$empresa?>, 'producto', xajax.getFormValues("form1") );
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
xajax_genera_formulario_modifica_detalle( <?=$id_p?>, <?=$empresa?> );
</script>
<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>