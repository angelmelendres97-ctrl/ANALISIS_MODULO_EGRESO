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
        <title>CODIGO DE RETENCION</title>
        <style type="text/css">
            <!--
            .Estilo1 {
                font-size: 12px;
                font-family: Georgia, "Times New Roman", Times, serif;
                color: #000000;
            }
            -->
        </style>

        <script>
            function datos( a,b,c,d,e){
                window.opener.document.form1.cod_ret.value  = a;
                window.opener.document.form1.ret_porc.value = b;
                window.opener.document.form1.cta_deb.value  = c;
                window.opener.document.form1.cta_cre.value  = d;
                window.opener.document.form1.tipo.value     = e;
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
        $codret      = $_GET['codret'];
		$clpv_cod    = $_GET['clpv_cod'];
		
		$sql = "select clpv_clopv_clpv from saeclpv where
						clpv_cod_empr = $idempresa and
						clpv_cod_clpv = $clpv_cod ";
		$tipoClpv = (consulta_string_func($sql, 'clpv_clopv_clpv', $oIfxA, ''));
		
		if($tipoClpv == 'CL'){
			$sqlTipo = " and tret_ban_crdb = 'DB'";
		}elseif($tipoClpv == 'PV'){
			$sqlTipo = " and tret_ban_crdb = 'CR'";
		}
		
		
		
        //  LECTURA SUCIA
        //////////////
        $sql = "select tret_cod, tret_det_ret, tret_porct, 
                    tret_cta_deb, tret_cta_cre, tret_ban_crdb
                    from saetret where
                    tret_cod_empr = $idempresa and
                    tret_cod    like '%$codret%'
					$sqlTipo	";
        //echo $sql;
        ?>
    </body>
    <div id="contenido">
        <?
        $cont=1;
        echo '<table align="center" border="0" cellpadding="2" cellspacing="1" width="98%" style="border:#999999 1px solid">';
        echo '<tr><th colspan="7" align="center" class="titulopedido">CODIGO RETENCION</th></tr>';
        echo '<tr>
			<th align="left" bgcolor="#EBF0FA" class="titulopedido">ID</th>
			<th align="left" bgcolor="#EBF0FA" class="titulopedido">CODIGO</th>
			<th align="left" bgcolor="#EBF0FA" class="titulopedido">DETALLE</th>
                        <th align="left" bgcolor="#EBF0FA" class="titulopedido">PORCENTAJE</th>
                        <th align="left" bgcolor="#EBF0FA" class="titulopedido">CTA DEBITO</th>
                        <th align="left" bgcolor="#EBF0FA" class="titulopedido">CTA CREDITO</th>
                        <th align="left" bgcolor="#EBF0FA" class="titulopedido"></th>
		  </tr>';

        if ($oIfx->Query($sql)) {
            if( $oIfx->NumFilas() > 0 ) {
                do {
                    $cod_ret     = ($oIfx->f('tret_cod'));
                    $nom_ret     = htmlentities($oIfx->f('tret_det_ret'));
                    $porc_ret    = ($oIfx->f('tret_porct'));
                    $cta_deb     = $oIfx->f('tret_cta_deb');
                    $cta_cre     = $oIfx->f('tret_cta_cre');
                    $tipo        = $oIfx->f('tret_ban_crdb');

                    if ($sClass=='off') $sClass='on'; else $sClass='off';
                    echo '<tr height="20" class="'.$sClass.'"
                                        onMouseOver="javascript:this.className=\'link\';"
                                        onMouseOut="javascript:this.className=\''.$sClass.'\';">';
                    echo '<td>'.$cont.'</td>';
                    echo '<td width="100">';
                    ?>
                    <a href="#" onclick="datos('<? echo $cod_ret;?>',    '<? echo $porc_ret;?>',    '<? echo $cta_deb ?>',      
                                               '<? echo $cta_cre ?>',    '<? echo $tipo ?>' )">
                         <? echo $cod_ret;?></a>
                    <?
                    echo '</td>';
                    echo '<td>'
                    ?>
                    <a href="#" onclick="datos('<? echo $cod_ret;?>',    '<? echo $porc_ret;?>',    '<? echo $cta_deb ?>',      
                                               '<? echo $cta_cre ?>',    '<? echo $tipo ?>' )">
                        <? echo $nom_ret;?></a>
                    <?
                    echo '</td>';
                    echo '<td>';
                    ?>
                    <a href="#" onclick="datos('<? echo $cod_ret;?>',    '<? echo $porc_ret;?>',    '<? echo $cta_deb ?>',      
                                               '<? echo $cta_cre ?>',    '<? echo $tipo ?>' )">
                         <? echo $porc_ret;?></a>
                    <?   
                    echo '<td>';
                    ?>
                    <a href="#" onclick="datos('<? echo $cod_ret;?>',    '<? echo $porc_ret;?>',    '<? echo $cta_deb ?>',      
                                               '<? echo $cta_cre ?>',    '<? echo $tipo ?>' )">
                        <? echo $cta_deb;?></a>
                    <?
                        echo '</td>';
                    ?>
                    <?   
                    echo '<td>';
                    ?>
                    <a href="#" onclick="datos('<? echo $cod_ret;?>',    '<? echo $porc_ret;?>',    '<? echo $cta_deb ?>',      
                                               '<? echo $cta_cre ?>',    '<? echo $tipo ?>' )">
                        <? echo $cta_cre;?></a>
                    <?
                        echo '</td>';
                    ?>
                    <?   
                    echo '<td>';
                    ?>
                    <a href="#" onclick="datos('<? echo $cod_ret;?>',    '<? echo $porc_ret;?>',    '<? echo $cta_deb ?>',      
                                               '<? echo $cta_cre ?>',    '<? echo $tipo ?>' )">
                        <? echo $tipo;?></a>
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
        echo '</table>';
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

