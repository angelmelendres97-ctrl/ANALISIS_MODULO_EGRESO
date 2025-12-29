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
        list($factura, $sucu, $clpv, $idempresa, $tran, $det, $coti, $mone, $coti_ext ) = explode(",", $array);
//        echo $clpv;
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
        
        function cargar(){
                parent.xajax_agrega_modifica_grid_dir( 0, xajax.getFormValues("form1"), 0, '<?=$idempresa?>', '<?=$coti?>' , '<?=$mone?>', '<?=$coti_ext?>' );
        }
        
        function cerrar_ventana(){
      		CloseAjaxWin();
      	}

        function cargar_tot(){
                xajax_cargar_tot( xajax.getFormValues("form1") );
        }

        function valor_fact(id, valor){
                valor = parseFloat(valor);
                document.getElementById(id).value = valor;
                xajax_calculo( xajax.getFormValues("form1") );
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
xajax_reporte_facturas( <?=$idempresa?>, <?=$sucu?>, '<?=$clpv?>',  '<?=$factura?>', '<?=$tran?>', '<?=$det?>'  );
</script>
<? /********************************************************************/ ?>
<? /* NO MODIFICAR ESTA SECCION*/ ?>
<? } ?>
<? include_once(FOOTER_MODULO); ?>
<? /********************************************************************/ ?>