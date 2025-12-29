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
        <title></title>
        		
		<link rel="stylesheet" type = "text/css" href="<?=$_COOKIE["JIREH_INCLUDE"]?>css/general.css">
		<link href="<?=$_COOKIE["JIREH_INCLUDE"]?>Clases/Formulario/Css/Formulario.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type = "text/css" href="css/estilo.css">

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
            function formato(){
                document.getElementById('dos').style.display= "none";
                window.print();
            }

        </script>
    </head>
    <body>
        <?
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

        $oCnx = new Dbo ( );
        $oCnx->DSN = $DSN;
        $oCnx->Conectar ();

        $oIfxA = new Dbo ( );
        $oIfxA->DSN = $DSN_Ifx;
        $oIfxA->Conectar ();

        $oIfx = new Dbo;
        $oIfx -> DSN = $DSN_Ifx;
        $oIfx -> Conectar();

        $idempresa    = $_SESSION['U_EMPRESA'];
        $idsucursal   = $_GET['sucursal'];
        $asto_cod     = $_GET['asto'];
        $ejer_cod     = $_GET['ejer'];
        $prdo_cod     = $_GET['mes'];
        
        //  LECTURA SUCIA
        //////////////
    
        $sql = "select empr_ruc_empr, empr_dir_empr, empr_nom_empr from saeempr where empr_cod_empr = $idempresa ";
        if($oIfx->Query($sql)){
            $empr_ruc = $oIfx->f('empr_ruc_empr');
            $empr_dir = $oIfx->f('empr_dir_empr');
            $empr_nom = $oIfx->f('empr_nom_empr');
        }
        
        
        // DATOS DE LA ASTO
        $sql = "select asto_cod_asto, asto_ben_asto, asto_fec_asto, asto_det_asto,  asto_num_mayo
                    from saeasto where
                    asto_cod_empr = $idempresa and
                    asto_cod_sucu = $idsucursal and
                    asto_cod_asto = '$asto_cod' and
                    asto_cod_ejer = $ejer_cod and
                    asto_num_prdo = $prdo_cod and
                    asto_est_asto <> 'AN'
                    order by 1 ";
        //echo $sql;
        if($oIfx->Query($sql)) {
            if($oIfx->NumFilas()>0) {
                $asto_ben   = $oIfx->f('asto_ben_asto');
                $asto_fec   = fecha_mysql_Ymd($oIfx->f('asto_fec_asto'));
                $asto_det   = $oIfx->f('asto_det_asto');
                $asto_mayo  = $oIfx->f('asto_num_mayo');
            }
        }        
        
        
        $sql = "select ret_num_ret, ret_num_fact, ret_nom_clpv from saeret where
                    asto_cod_empr = $idempresa  and
                    asto_cod_sucu = $idsucursal and
                    rete_cod_asto = '$asto_cod' and
                    asto_cod_ejer = $ejer_cod and
                    asto_num_prdo = $prdo_cod ";
        if($oIfx->Query($sql)) {
            if($oIfx->NumFilas()>0) {
                $ret_num   = $oIfx->f('ret_num_ret');
                $ret_fact  = $oIfx->f('ret_num_fact');
                $ret_clpv  = $oIfx->f('ret_nom_clpv');
            }
        }
        
        // dasi
        $sql = "select dasi_cod_dasi, dasi_cod_cuen, ccos_cod_ccos, dasi_dml_dasi, dasi_cml_dasi, dasi_det_asi
                    from saedasi where
                    asto_cod_empr = $idempresa and
                    asto_cod_sucu = $idsucursal and
                    asto_cod_asto = '$asto_cod' and
                    asto_cod_ejer = $ejer_cod and
                    dasi_num_prdo = $prdo_cod order by 1 ";
        unset($array_dasi);
        $total = 0;
        if($oIfx->Query($sql)) {
            if($oIfx->NumFilas()>0) {
                do{                    
                    $cuen_cod    = $oIfx->f('dasi_cod_cuen');
                    $ccos_cod    = $oIfx->f('ccos_cod_ccos');
                    $debi        = $oIfx->f('dasi_dml_dasi');
                    $cred        = $oIfx->f('dasi_cml_dasi');
                    $det         = $oIfx->f('dasi_det_asi');
                    
                    $sql = "select cuen_nom_cuen from saecuen where
                                cuen_cod_empr = $idempresa and
                                cuen_cod_cuen = '$cuen_cod' ";
                    $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfxA, '');
                    
                    $array_dasi [] = array( $cuen_cod, $ccos_cod, $debi, $cred, $det, $cuen_nom );
                    
                    $total += $debi;
                }while($oIfx->SiguienteRegistro());
            }
        }

        // DIRECTORIO
        $sql = "select  dir_num_fact,   dir_cre_ml,  dire_nom_clpv from saedir where
                    dire_cod_asto = '$asto_cod' and
                    dire_cod_empr = $idempresa and
                    dire_cod_sucu = $idsucursal and
                    asto_cod_ejer = $ejer_cod and
                    asto_num_prdo = $prdo_cod ";
        unset($array_dir);
        $total = 0;
        if($oIfx->Query($sql)) {
            if($oIfx->NumFilas()>0) {
                do{                    
                    $fact_num    = $oIfx->f('dir_num_fact');
                    $cre_ml      = $oIfx->f('dir_cre_ml');
                    $clpv_nom    = $oIfx->f('dire_nom_clpv');
                    
                    $array_dir [] = array( $fact_num, $cre_ml, $clpv_nom  );
                    
                    $total += $debi;
                }while($oIfx->SiguienteRegistro());
            }
        }           

        
        ?>

        <div id="uno"  style="margin: 50px; letter-spacing: 0.4em" width="100%">
            <table align="center" class="table table-striped table-condensed" style="margin-bottom: 0px; width: 100%" align="center">
                <tr>
                    <td colspan="4" style="font:Brandon Grotesque Regular, sans-serif; font-size:24px; height:25px; text-align:center;"><div align="center"><?=$empr_nom?></div></td>
                </tr>
                <tr>
                    <td colspan="4" style="font:Brandon Grotesque Regular, sans-serif; font-size:12px; height:25px; text-align:center;"><div align="center"><?=$empr_dir;?> RUC: <?=$empr_ruc?></div></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="font-size:14px; height:25px; text-align:center;" class="bg-primary">COMPROBANTE DEINGRESO No. <?=$asto_cod;?> </td>
                </tr>
                <tr>
                    <td class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold"><span>FECHA:</span></td>
                    <td align="left"><?=$asto_fec;?></td>
                    <td align="left" class="fecha_letra" style="font-size:10px">FACTURA:</td>
                    <td align="left"><?=$ret_fact;?></td>
                </tr>
                <tr>
                    <td class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold; background-color:#F5F5F5;">MONEDA: </td>
                    <td style="font:font-size:25px; height:25px; text-align:left; font-weight: bold; background-color:#F5F5F5;" align="left">DOLAR</td>
                    <td class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold; background-color:#F5F5F5;">No Retencion:</td>
                    <td style="font:font-size:25px; height:25px; text-align:left; font-weight: bold; background-color:#F5F5F5;"align="left"><?=$ret_num;?></td>
                </tr>
                <tr>
                    <td class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold;">PROVEEDOR: </td>
                    <td style="font:font-size:25px; height:25px; text-align:left; font-weight: bold;"><?=$ret_clpv?></td>
                    <td class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold;">Monto:</td>
                    <td style="font:font-size:25px; height:25px; text-align:left; font-weight: bold;"><?=$total;?></td>
                </tr>
                <tr>
                    <td class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold; background-color:#F5F5F5;">DETALLE: </td>
                    <td colspan="3" class="fecha_letra" style="font:font-size:25px; height:25px; text-align:left; font-weight: bold; background-color:#F5F5F5;"><?=$asto_det?></td>
                </tr>
                <tr>
                    <td colspan="4"><?
                        // DIRECTORIO
                        $i=1;
                        $table_cp .= '<br>';
                        $table_cp .='<table class="table table-bordered table-hover" align="center" style="width: 100%;">
										<tr>
                                                <td colspan="4" class="fecha_letra" style="font:font-size:25px; height:25px; text-align:center; font-weight: bold; background-color:#F5F5F5;" >FACTURAS</td>
                                        </tr>
                                        <tr>
                                                <td class="bg-primary" align="center">N.-</td>
                                                <td class="bg-primary" align="center">FACTURA</td>
                                                <td class="bg-primary" align="center">CLIENTE / PROVEEDOR</td>
                                                <td class="bg-primary" align="center">VALOR</td>
                                        </tr>';
                        $tot_deb = 0;   $tot_cre = 0;   $i = 1;
                        if(count($array_dir)>0){
                            foreach ($array_dir as $val){
                                $fact_num = $val[0]; 
                                $cre_ml   = $val[1]; 
                                $clpv_nom = htmlentities($val[2]); 
                                
                                $table_cp .='<tr height="25">
                                                <td>'.$i.'</td>
                                                <td>'.$fact_num.'</td>
                                                <td>'.$clpv_nom.'</td>
                                                <td align="right">'.$cre_ml.'</td>
                                            </tr>';
                                $i++;
                                $tot_deb += $cre_ml;
                            }
                            $table_cp .='<tr height="25" style="background-color:#DADADA">
                                                <td class="fecha_letra" align="left"></td>
                                                <td class="fecha_letra" ></td>
                                                <td class="fecha_letra" align="right" >TOTAL:</td>
                                                <td class="fecha_letra" align="right">'.$tot_deb.'</td>
                                            </tr>';
                        }
                        
                        $table_cp .= '</table>';
                        ?></td>
                </tr>
                <tr>
                    <td colspan="4"><?
                        // DETALLE
                        $i=1;
                        $table_cp .='<table class="table table-bordered table-hover" align="center" style="width: 100%;">
										<tr>
                                                <td colspan="5" class="fecha_letra" style="font:font-size:25px; height:25px; text-align:center; font-weight: bold; background-color:#F5F5F5;" >DIARIO</td>
                                        </tr>
                                        <tr>
                                                <td class="bg-primary" align="center" >N.-</td>
                                                <td class="bg-primary" align="center" >CUENTA</td>
                                                <td class="bg-primary" align="center" >NOMBRE CUENTA - DETALLE</td>
                                                <td class="bg-primary" align="center" >DEBITO</td>
                                                <td class="bg-primary" align="center" >CREDITO</td>
                                        </tr>';
                        $tot_deb = 0;   $tot_cre = 0;   $i = 1;
                        if(count($array_dasi)>0){
                            foreach ($array_dasi as $val){
                                $cuen_cod = $val[0]; 
                                $ccos_cod = $val[1]; 
                                $debi     = $val[2]; 
                                $cred     = $val[3]; 
                                $det      = htmlentities(substr($val[4],0,25)); 
                                $cuen_nom = htmlentities(substr($val[5],0,25)); 
                                
                                $table_cp .='<tr height="25">
                                                <td align="left"  >'.$i.'</td>
                                                <td align="left"  >'.$cuen_cod.'</td>
                                                <td align="left"  >'.$cuen_nom.''.$det.'</td>
                                                <td align="right" >'.$debi.'</td>
                                                <td align="right" >'.$cred.'</td>
                                            </tr>';
                                $i++;
                                $tot_deb += $debi;
                                $tot_cre += $cred;
                            }
                            $table_cp .='<tr height="25" style="background-color:#DADADA">
                                                <td align="left"></td>
                                                <td ></td>
                                                <td class="fecha_letra" align="right">TOTAL:</td>
                                                <td class="fecha_letra"  align="right">'.$tot_deb.'</td>
                                                <td class="fecha_letra"  align="right">'.$tot_cre.'</td>
                                            </tr>';
                        }
                        
                        $table_cp .= '</table>';
                        echo $table_cp;
                        ?>
					</td>
                </tr>
                <tr>
                    <td colspan="4" align="right"></td>
                </tr>
            </table>
            <table class="table table-striped table-condensed" style="margin-bottom: 0px; width: 100%" >
                <tr height="25" >
                    <td align="CENTER"class="fecha_letra">_______________________&nbsp;&nbsp;</td>
                    <td align="CENTER"class="fecha_letra">_______________________&nbsp;&nbsp;</td>
					<td align="CENTER"class="fecha_letra">_______________________&nbsp;&nbsp;</td>
                </tr>
                <tr height="25" >
                    <td align="CENTER"class="fecha_letra">AUTORIZADO</td>
                    <td align="CENTER"class="fecha_letra">CONTADOR</td>
                    <td align="CENTER"class="fecha_letra">CONTABILIZADO</td>
                </tr>
            </table>

        </div>

        <div id="dos">
            <table width="464" border="0" align="center">
                <tr>
                    <td align="center"><label>
							<div class="btn btn-primary btn-sm" onclick="formato();">
											<span class="glyphicon glyphicon-print"></span>
											Imprimir
							</div>
					</td>
                </tr>
            </table>
        </div>
    </body>
</html>