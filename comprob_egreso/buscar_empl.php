<?
include_once('../../Include/config.inc.php');
include_once(path(DIR_INCLUDE).'conexiones/db_conexion.php');
include_once(path(DIR_INCLUDE).'comun.lib.php');

if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type = "text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/general.css"/>
        <link href="<?=$_COOKIE["JIREH_INCLUDE"]?>Clases/Formulario/Css/Formulario.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>LISTA DE EMPLEADOS</title>
		
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
            function datos( cod, cli){
				window.opener.document.form1.cliente.value        = cod;
				window.opener.document.form1.cliente_nombre.value = cli;
				window.opener.document.form1.clpv_cod.value       = 0;
				window.opener.document.form1.clpv_nom.value       = cli;
				window.opener.cargar_lista_tran('PV');
				window.opener.cargar_lista_subcliente();
                close();
            }
        </script>
    </head>

    <body>

        <?
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

        $oIfx = new Dbo;
        $oIfx -> DSN = $DSN_Ifx;
        $oIfx -> Conectar();

        $oIfxA = new Dbo;
        $oIfxA -> DSN = $DSN_Ifx;
        $oIfxA -> Conectar();

        $idempresa   = $_GET['empresa'];
        $cliente_nom = $_GET['cliente'];
        $op          = $_GET['op'];

        //  LECTURA SUCIA
        //////////////
		$sql = "select first 50 empl_cod_empl, empl_ape_nomb,  empl_dir_empl,
					empl_ape_empl, empl_nom_empl
					from saeempl where
					empl_cod_empr = $idempresa and
					empl_ape_nomb like '%$cliente_nom%'
					order by empl_ape_empl ";
        //echo $sql;
        ?>
    </body>
    <div id="contenido">
        <?
        $cont=1;
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-hover" align="center" style="width: 98%;">';
        echo '<tr><td colspan="7" align="center" class="bg-primary">LISTA DE EMPLEADOS</td></tr>';
        echo '<tr>
						<td align="center" class="bg-primary">N.-</td>
						<td align="center" class="bg-primary">IDENTIFICACION</td>
						<td align="center" class="bg-primary">NOMBRE</td>
						<td align="center" class="bg-primary">APELLIDO</td>
                        <td align="center" class="bg-primary">DIRECCION</td>
		      </tr>';

        if ($oIfx->Query($sql)) {
            if( $oIfx->NumFilas() > 0 ) {
                do {
                    $empl_cod_empl      = ($oIfx->f('empl_cod_empl'));
                    $empl_ape_nomb		= htmlentities($oIfx->f('empl_ape_nomb'));
                    $empl_dir_empl      = ($oIfx->f('empl_dir_empl'));
                    $empl_ape_empl      = htmlentities($oIfx->f('empl_ape_empl'));
                    $empl_nom_empl      = $oIfx->f('empl_nom_empl');

                    if ($sClass=='off') $sClass='on'; else $sClass='off';
                    echo '<tr height="20" class="'.$sClass.'"
								onMouseOver="javascript:this.className=\'link\';"
								onMouseOut="javascript:this.className=\''.$sClass.'\';">';
                    echo '<td width="100" class="'.$clase.'">';
                    ?>
                    <a href="#"  onclick="datos('<? echo $empl_cod_empl;?>',    '<? echo $empl_ape_nomb;?>' )">
                         <span class="<?echo $clase;?>" ><? echo $cont;?><span>
					</a>
                    <?
                    echo '</td>';					
					
                    echo '<td width="100" align="right" class="'.$clase.'">';
					?>
                    <a href="#" onclick="datos('<? echo $empl_cod_empl;?>',    '<? echo $empl_ape_nomb;?>' )">
                        <span class="<?echo $clase;?>" > <? echo $empl_cod_empl;?></span>
					</a>
                    <?
                    echo '</td>';
					
                    echo '<td class="'.$clase.'">'
                    ?>
                    <a href="#" onclick="datos('<? echo $empl_cod_empl;?>',    '<? echo $empl_ape_nomb;?>' )">
                        <span class="<?echo $clase;?>" > <? echo $empl_nom_empl;?> </span>
					</a>
                    <?
                    echo '</td>';
                    echo '<td class="'.$clase.'">';
                    ?>
                    <a href="#" onclick="datos('<? echo $empl_cod_empl;?>',    '<? echo $empl_ape_nomb;?>'  )">
                        <span class="<?echo $clase;?>" > <? echo $empl_ape_empl;?></span>
					</a>
                    <?   
                    echo '<td class="'.$clase.'">';
                    ?>
                    <a href="#" onclick="datos('<? echo $empl_cod_empl;?>',    '<? echo $empl_ape_nomb;?>'  )">
                        <span class="<?echo $clase;?>" ><? echo $empl_dir_empl;?> </span>
					</a>
                    <?
                        echo '</td>';
                    ?>
                    <?
                    echo '</tr>';
                    echo '<tr>'; echo '</tr>'; 		echo '<tr>'; echo '</tr>';
                    echo '<tr>'; echo '</tr>'; 		echo '<tr>'; echo '</tr>';
                    $cont++;
                }while($oIfx->SiguienteRegistro());
            }else {
                echo '<span class="fecha_letra">Sin Datos....</span>';
            }
        }
        $oIfx->Free();
        echo '<tr><td colspan="3">Se mostraron '.($cont-1).' Registros</td></tr>';
        echo '</table></div>';
        //echo $cod_producto;

        function fecha_mysql_func2($fecha) {
            $fecha_array = explode('/',$fecha);
            $m = $fecha_array[0];
            $y = $fecha_array[2];
            $d = $fecha_array[1];

            return ( $y.'/'.$m.'/'.$d );
        }
        ?>
    </div>
</html>

