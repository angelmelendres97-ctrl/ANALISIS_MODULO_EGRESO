<?
include_once('../../Include/config.inc.php');
include_once(path(DIR_INCLUDE).'conexiones/db_conexion.php');
include_once(path(DIR_INCLUDE).'comun.lib.php');

if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type = "text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/general.css">
    <link href="<?=$_COOKIE["JIREH_INCLUDE"]?>Clases/Formulario/Css/Formulario.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cuentas Contables</title>

<!--CSS--> 
	<link rel="stylesheet" type="text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/bootstrap-3.3.7-dist/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="js/jquery/plugins/simpleTree/style.css" />
	<link rel="stylesheet" href="media/css/bootstrap.css">
	<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">
	<link type="text/css" href="css/style.css" rel="stylesheet"></link>

	<!--Javascript--> 
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="media/js/jquery-1.10.2.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="media/js/dataTables.bootstrap.min.js"></script>          
	<script src="media/js/bootstrap.js"></script>
	<script type="text/javascript" language="javascript" src="<?=$_COOKIE["JIREH_INCLUDE"]?>css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>    
	<script src="media/js/lenguajeusuario_producto.js"></script>  

<script>
	function datos( a, b, mov, ccos, act ){
        if(mov==1){
                window.opener.document.form1.cod_cta.value = a;
                window.opener.document.form1.nom_cta.value = b;
				
				// CENTRO DE COSTO  - CENTRO ACTIVIDAD
				window.opener.centro_costo_cuen(ccos);
				window.opener.centro_actividad(act);
				/*alert('actividad '+act);
				alert('centro csoto ' + ccos);*/
				close();
		}else{
			alert('La cuenta debe ser de Movimiento....');
		}
	}
</script>
</head>

<body>

<?
	$oCnx = new Dbo ( );
	$oCnx->DSN = $DSN;
	$oCnx->Conectar ();

        $oCnxA = new Dbo ( );
	$oCnxA->DSN = $DSN;
	$oCnxA->Conectar ();

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
	
	$oIfxA = new Dbo;
	$oIfxA -> DSN = $DSN_Ifx;
	$oIfxA -> Conectar();
	
	$empresa = $_GET['empresa'];
        $opcion  = $_GET['op'];
        $cta_nom = $_GET['cuenta'];
        $cta_cod = $_GET['codigo'];
		
		 $sql = "select cuen_cod_cuen, cuen_nom_cuen, cuen_nom_ingl, cuen_mov_cuen, cuen_bie_cuen, cuen_cact_cuen, cuen_ccos_cuen
				from saecuen where
				cuen_cod_empr = $empresa and
				(cuen_cod_cuen like '$cta_nom%' OR cuen_nom_cuen like '$cta_nom%') 
				order by cuen_cod_cuen ";
	
?> 
</body>
<div id="contenido">
	<?	
	$cont=1;
	echo '<div class="table-responsive">';
	echo '<table class="table table-bordered table-hover" align="center" style="width: 98%;">';
	echo '<tr><td colspan="7" align="center" class="bg-primary">Cuentas Contables</td></tr>';
	echo '<tr>
			<td align="center" class="bg-primary">Cuenta</td>
			<td align="center" class="bg-primary">Nombre - Espa&ntilde;ol</td>
			<td align="center" class="bg-primary">Nombre - Ingles</td>
			<td align="center" class="bg-primary">Centro Costos</td>
			<td align="center" class="bg-primary">Centro Actividad</td>
         </tr>';

    if ($oIfx->Query($sql)){
        if( $oIfx->NumFilas() > 0 ){
		do {
			$cod_cuenta        = htmlentities($oIfx->f('cuen_cod_cuen'));
			$nom_cuenta        = htmlentities($oIfx->f('cuen_nom_cuen'));
			$nom_cuenta_ingles = htmlentities($oIfx->f('cuen_nom_ingl'));
			$cta_mov           = $oIfx->f('cuen_mov_cuen');
			$cuen_ccos         = $oIfx->f('cuen_ccos_cuen');
			$cuen_cact         = $oIfx->f('cuen_cact_cuen');
	
			echo '<tr height="25px">';				
				echo '<td width="100">';		
	?>
    				<a href="#" onclick="datos( '<? echo $cod_cuenta;?>', '<? echo $nom_cuenta;?>', '<? echo $cta_mov;?>' , '<? echo $cuen_ccos;?>', '<? echo $cuen_cact;?>' ) ">
					             <? echo $cod_cuenta;?></a>
    <?
				echo '</td>';
				echo '<td>'
	?>
    				<a href="#" onclick="datos( '<? echo $cod_cuenta;?>', '<? echo $nom_cuenta;?>', '<? echo $cta_mov;?>'  , '<? echo $cuen_ccos;?>', '<? echo $cuen_cact;?>' ) ">
						     <? echo $nom_cuenta;?></a>
    <?
				echo '</td>';
				echo '<td>';	
	?>
				<a href="#" onclick="datos( '<? echo $cod_cuenta;?>', '<? echo $nom_cuenta;?>', '<? echo $cta_mov;?>' , '<? echo $cuen_ccos;?>', '<? echo $cuen_cact;?>'  ) ">
						     <? echo $nom_cuenta_ingles;?></a>
	
	<?			echo '</td>';
				echo '<td>';					
    ?>
				<a href="#" onclick="datos( '<? echo $cod_cuenta;?>', '<? echo $nom_cuenta;?>', '<? echo $cta_mov;?>' , '<? echo $cuen_ccos;?>', '<? echo $cuen_cact;?>'  ) ">
						     <? echo $cuen_ccos;?></a>
    <?
				echo '</td>';
				echo '<td>';	
	?>
				<a href="#" onclick="datos( '<? echo $cod_cuenta;?>', '<? echo $nom_cuenta;?>', '<? echo $cta_mov;?>' , '<? echo $cuen_ccos;?>', '<? echo $cuen_cact;?>'  ) ">
						     <? echo $cuen_cact;?></a>
	<?
				echo '</td>';
				echo '</tr>';
				echo '<tr>'; echo '</tr>'; 		echo '<tr>'; echo '</tr>'; 	
				echo '<tr>'; echo '</tr>'; 		echo '<tr>'; echo '</tr>'; 	
				$cont++;
		}while($oIfx->SiguienteRegistro());
            }else{
                echo '<span class="fecha_letra">Sin Datos....</span>';
            }
	}
	$oIfx->Free();
	echo '<tr><td colspan="3">Se mostraron '.($cont-1).' Registros</td></tr>';
	echo '</table>';
	//echo $cod_producto;
?>    
</div>
</html>


