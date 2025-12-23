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
        <title>LISTA DE CLIENTE - PROVEEDORES</title>
		
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
            function datos( cod, cli, ruc, dir, tel, cel, vend ,cont, pre, fpago, tpago, fec, auto, 
                            serie, fec_venc, dia, contr, ini, fin, ema, contribuyente, ab, op, clpv){
                if(op==0){
                    window.opener.document.form1.cliente.value        = cod;
                    window.opener.document.form1.cliente_nombre.value = cli;
                    window.opener.document.form1.clpv_cod.value       = cod;
                    window.opener.document.form1.clpv_nom.value       = cli;
					window.opener.cargar_lista_tran(clpv);
					window.opener.cargar_lista_subcliente();
                }else if(op==1){
                    window.opener.document.form1.clpv_cod.value = cod;
                    window.opener.document.form1.clpv_nom.value = cli;
					window.opener.cargar_lista_tran(clpv);
					window.opener.cargar_lista_subcliente();
                }
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
        $sql = "select first 50 c.clpv_cod_clpv, c.clpv_nom_clpv,  c.clpv_ruc_clpv,
                        c.clpv_cod_vend, c.clpv_cot_clpv, c.clpv_pre_ven, '' as direccion, 
                        '' as telefono, clpv_etu_clpv, clpv_cod_tpago, clpv_cod_fpagop, clpv_pro_pago,
						 c.clpv_clopv_clpv
                        from saeclpv c  where 
                        c.clpv_cod_empr       = $idempresa and
                   --     c.clpv_clopv_clpv     = 'PV' and
                        (c.clpv_nom_clpv like upper('%$cliente_nom%') OR c.clpv_ruc_clpv like upper('%$cliente_nom%'))  
                        group by 1,2,3,4,5,6, 9, 10, 11, 12, 13 
						order by c.clpv_clopv_clpv, 2 ";
        //echo $sql;
        ?>
    </body>
    <div id="contenido">
        <?
        $cont=1;
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-hover" align="center" style="width: 98%;">';
        echo '<tr><td colspan="7" align="center" class="bg-primary">LISTA DE CLIENTES - PROVEEDORES</td></tr>';
        echo '<tr>
						<td align="center" class="bg-primary">ID</td>
						<td align="center" class="bg-primary">TIPO</td>
						<td align="center" class="bg-primary">CODIGO ITEM</td>
						<td align="center" class="bg-primary">PROVEEDOR</td>
                        <td align="center" class="bg-primary">IDENTIFICACION</td>
                        <td align="center" class="bg-primary">CONTRIBUYENTE ESPECIAL</td>
		      </tr>';

        if ($oIfx->Query($sql)) {
            if( $oIfx->NumFilas() > 0 ) {
                do {
                    $codigo      = ($oIfx->f('clpv_cod_clpv'));
                    $nom_cliente = htmlentities($oIfx->f('clpv_nom_clpv'));
                    $ruc         = ($oIfx->f('clpv_ruc_clpv'));
                    $dire        = htmlentities($oIfx->f('direccion'));
                    $telefono    = $oIfx->f('telefono');
                    $celular     = $oIfx->f('celular');
                    $vendedor    = $oIfx->f('clpv_cod_vend');
                    $contacto    = $oIfx->f('clpv_cot_clpv');
                    $precio      = round($oIfx->f('clpv_pre_ven'),0);
                    $fpago       = $oIfx->f('clpv_cod_fpagop');
                    $tpago       = $oIfx->f('clpv_cod_tpago');
                    $prove_dia   = $oIfx->f('clpv_pro_pago');
                    $clpv_etu_clpv = $oIfx->f('clpv_etu_clpv');
                    $contribuyente_especial = $oIfx->f('clpv_etu_clpv');
					$cl_pv       = $oIfx->f('clpv_clopv_clpv');
					 

                    if($clpv_etu_clpv==1) {
                        $clpv_etu_clpv = 'S';
                    }else {
                        $clpv_etu_clpv = 'N';
                    }

                    if(empty($prove_dia)) {
                        $prove_dia = 0;
                    }
                    
                    // correo
                    $sql = "select min( emai_ema_emai ) as correo from saeemai where
                                    emai_cod_empr = $idempresa and
                                    emai_cod_clpv = $codigo ";
                    $correo = acento_func(consulta_string_func($sql, 'correo', $oIfxA, ''));

                    // FECHA DE VENCIMIENTO
                    $fecha_venc = (sumar_dias_func( date("Y-m-d"), $prove_dia)); //  Y/m/d

                    // AUTORIZACION PROVE
                    $sql = "select  max(coa_fec_vali) as coa_fec_vali, coa_aut_usua, coa_seri_docu, coa_fact_ini, coa_fact_fin
                                    from saecoa where
                                    clpv_cod_empr = $idempresa and
                                    clpv_cod_clpv = $codigo group by coa_fec_vali,2,3,4,5 ";
                    $fec_cadu_prove = ''; $auto_prove = ''; $serie_prove = '';  $ini_prove = ''; $fin_prove='';
                    if($oIfxA->Query($sql)) {
                        if($oIfxA->NumFilas()>0) {
                            $fec_cadu_prove = fecha_mysql_func2($oIfxA->f('coa_fec_vali'));
                            $auto_prove = $oIfxA->f('coa_aut_usua');
                            $serie_prove = $oIfxA->f('coa_seri_docu');
                            $ini_prove = $oIfxA->f('coa_fact_ini');
                            $fin_prove = $oIfxA->f('coa_fact_fin');
                        }
                    }
                    $oIfxA->Free();

					if($cl_pv=='CL'){
							$clase = 'letra_rojo';
					}else{
							$clase = 'visited';
					}	

                    if ($sClass=='off') $sClass='on'; else $sClass='off';
                    echo '<tr height="20" class="'.$sClass.'"
								onMouseOver="javascript:this.className=\'link\';"
								onMouseOut="javascript:this.className=\''.$sClass.'\';">';
                    echo '<td align="rigth" class="'.$clase.'">'.$cont.'</td>';
                    echo '<td width="100" class="'.$clase.'">';
                    ?>
                    <a href="#"  onclick="datos('<? echo $codigo;?>',    '<? echo $nom_cliente;?>',  '<? echo $ruc ?>',      
                                               '<? echo $dire ?>',      '<? echo $telefono ?>',     '<? echo $celular ?>',  
                                               '<? echo $vendedor ?>',  '<? echo $contacto ?>',     '<? echo $precio ?>',
                                               '<? echo $fpago ?>',     '<? echo $tpago ?>',        '<? echo $fec_cadu_prove ?>', 
                                               '<? echo $auto_prove ?>','<? echo $serie_prove ?>',  '<? echo $fecha_venc ?>', 
                                               '<? echo $prove_dia ?>', '<? echo $clpv_etu_clpv ?>','<? echo $ini_prove ?>', 
                                               '<? echo $fin_prove ?>', '<? echo $correo ?>',       '<? echo $tipo_pago ?>',
                                               '<? echo $forma_pago ?>','<? echo $op ?>',           '<? echo $cl_pv ?>' )">
                         <span class="<?echo $clase;?>" ><? echo $cl_pv;?><span>
					</a>
                    <?
                    echo '</td>';					
					
                    echo '<td width="100" align="right" class="'.$clase.'">';
					?>
                    <a href="#" onclick="datos('<? echo $codigo;?>',    '<? echo $nom_cliente;?>',  '<? echo $ruc ?>',      
                                               '<? echo $dire ?>',      '<? echo $telefono ?>',     '<? echo $celular ?>',  
                                               '<? echo $vendedor ?>',  '<? echo $contacto ?>',     '<? echo $precio ?>',
                                               '<? echo $fpago ?>',     '<? echo $tpago ?>',        '<? echo $fec_cadu_prove ?>', 
                                               '<? echo $auto_prove ?>','<? echo $serie_prove ?>',  '<? echo $fecha_venc ?>', 
                                               '<? echo $prove_dia ?>', '<? echo $clpv_etu_clpv ?>','<? echo $ini_prove ?>', 
                                               '<? echo $fin_prove ?>', '<? echo $correo ?>',       '<? echo $tipo_pago ?>',
                                               '<? echo $forma_pago ?>','<? echo $op ?>',           '<? echo $cl_pv ?>' )">
                        <span class="<?echo $clase;?>" > <? echo $codigo;?></span>
					</a>
                    <?
                    echo '</td>';
					
                    echo '<td class="'.$clase.'">'
                    ?>
                    <a href="#" onclick="datos('<? echo $codigo;?>',    '<? echo $nom_cliente;?>',  '<? echo $ruc ?>',      
                                               '<? echo $dire ?>',      '<? echo $telefono ?>',     '<? echo $celular ?>',  
                                               '<? echo $vendedor ?>',  '<? echo $contacto ?>',     '<? echo $precio ?>',
                                               '<? echo $fpago ?>',     '<? echo $tpago ?>',        '<? echo $fec_cadu_prove ?>', 
                                               '<? echo $auto_prove ?>','<? echo $serie_prove ?>',  '<? echo $fecha_venc ?>', 
                                               '<? echo $prove_dia ?>', '<? echo $clpv_etu_clpv ?>','<? echo $ini_prove ?>', 
                                               '<? echo $fin_prove ?>', '<? echo $correo ?>',       '<? echo $tipo_pago ?>',
                                               '<? echo $forma_pago ?>', <? echo $op ?>,            '<? echo $cl_pv ?>' )">
                        <span class="<?echo $clase;?>" > <? echo $nom_cliente;?> </span>
					</a>
                    <?
                    echo '</td>';
                    echo '<td class="'.$clase.'">';
                    ?>
                    <a href="#" onclick="datos('<? echo $codigo;?>',    '<? echo $nom_cliente;?>',  '<? echo $ruc ?>',      
                                               '<? echo $dire ?>',      '<? echo $telefono ?>',     '<? echo $celular ?>',  
                                               '<? echo $vendedor ?>',  '<? echo $contacto ?>',     '<? echo $precio ?>',
                                               '<? echo $fpago ?>',     '<? echo $tpago ?>',        '<? echo $fec_cadu_prove ?>', 
                                               '<? echo $auto_prove ?>','<? echo $serie_prove ?>',  '<? echo $fecha_venc ?>', 
                                               '<? echo $prove_dia ?>', '<? echo $clpv_etu_clpv ?>','<? echo $ini_prove ?>', 
                                               '<? echo $fin_prove ?>', '<? echo $correo ?>',       '<? echo $tipo_pago ?>',
                                               '<? echo $forma_pago ?>', '<? echo $op ?>' ,         '<? echo $cl_pv ?>' )">
                        <span class="<?echo $clase;?>" > <? echo $ruc;?></span>
					</a>
                    <?   
                    echo '<td class="'.$clase.'">';
                    ?>
                    <a href="#" onclick="datos('<? echo $codigo;?>',    '<? echo $nom_cliente;?>',  '<? echo $ruc ?>',      
                                               '<? echo $dire ?>',      '<? echo $telefono ?>',     '<? echo $celular ?>',  
                                               '<? echo $vendedor ?>',  '<? echo $contacto ?>',     '<? echo $precio ?>',
                                               '<? echo $fpago ?>',     '<? echo $tpago ?>',        '<? echo $fec_cadu_prove ?>', 
                                               '<? echo $auto_prove ?>','<? echo $serie_prove ?>',  '<? echo $fecha_venc ?>', 
                                               '<? echo $prove_dia ?>', '<? echo $clpv_etu_clpv ?>','<? echo $ini_prove ?>', 
                                               '<? echo $fin_prove ?>', '<? echo $correo ?>',       '<? echo $tipo_pago ?>',
                                               '<? echo $forma_pago ?>', '<? echo $op ?>',          '<? echo $cl_pv ?>' )">
                        <span class="<?echo $clase;?>" ><? echo $clpv_etu_clpv;?> </span>
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

