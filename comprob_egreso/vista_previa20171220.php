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
        <title>COMPROBANTE DE EGRESO</title>
       

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
		$tipo     = $_GET['tipo'];
		$usuario = $_SESSION['U_NOMBRECOMPLETO'];
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
        
		$sql="SELECT sucu_nom_sucu FROM saesucu WHERE sucu_cod_sucu='$idsucursal'";
		if($oIfx->Query($sql)){
			$sucu_nom = $oIfx->f('sucu_nom_sucu');
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
		$sql="SELECT clpv_ruc_clpv FROM saeclpv WHERE clpv_nom_clpv='$asto_ben'";
		if($oIfx->Query($sql)){
			$ruc_beneficiario=$oIfx->f('clpv_ruc_clpv');
		}
        $sql = "select dasi_cod_dasi, dasi_cod_cuen, ccos_cod_ccos, dasi_dml_dasi, dasi_cml_dasi, dasi_det_asi
                    from saedasi where
                    asto_cod_empr = $idempresa and
                    asto_cod_sucu = $idsucursal and
                    asto_cod_asto = '$asto_cod' and
                    asto_cod_ejer = $ejer_cod and
                    dasi_num_prdo = $prdo_cod order by 1 ";
					//echo $sql;exit;
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
        $sql = "select  dir_num_fact,   dir_deb_ml,  dire_nom_clpv from saedir where
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
                    $cre_ml      = $oIfx->f('dir_deb_ml');
                    $clpv_nom    = $oIfx->f('dire_nom_clpv');
                    
                    $array_dir [] = array( $fact_num, $cre_ml, $clpv_nom  );
                    
                    $total += $debi;
                }while($oIfx->SiguienteRegistro());
            }
        }           
		$nro_fac=explode(' ',$asto_det);
		$cant=count($nro_fac);
		$nro='';
		for($i=0;$i<=$cant; $i++){
			if(is_numeric($nro_fac[$i])){
				$nro.=$nro_fac[$i].'-';
			}
		}	
        
        ?>
	
        <div id="uno"  style="margin: 20px; letter-spacing: 0.4em" width="100%">
		<div>
				<img src="/Agc/WebApp/imagenes/logos/ag_logo.jpg"/>
			</div>
			<table border="0" width="100%" align="center" style="border: thick solid white; border-collapse: collapse;">
					<tr >
						<td colspan="5" style="font-size:18px; text-align: center"><?php echo $empr_nom?><br><br></td>
					</tr>
					<tr>
						<td colspan="5" style="font-size:12px; text-align: center">SUCURSAL:<?php echo $sucu_nom?><br><br></td>
					</tr>
					<tr>
						<td colspan="5" style="font-size:12px; text-align: center">DIRECCION:<?php echo $empr_dir?><br><br></td>
					</tr>
					<tr>
						<td colspan="5" style="font-size:12px; text-align: center">RUC:<?php echo $empr_ruc?><br><br></td>
					</tr>
					<tr>
						<td colspan="5" style="font-size:14px; text-align: center">COMPROBANTE No:<?php echo $asto_cod?><br><br></td>
					</tr>
					<tr>
						<td  colspan="4" style="font-size:10px; text-align: left"><strong>Fecha:</strong><?php echo $asto_fec;?></td>
						<td style="font-size:10px; text-align: left">Factura:<?php echo $nro;?></td>
					</tr>
					<tr>
						<td  colspan="4" style="font-size:10px; text-align: left"><strong>Moneda:</strong> DOLAR</td>
						<td style="font-size:10px; text-align: left">Nro. Retencion:<?php echo $ret_num;?></td>
					</tr>
					<tr>
						<td colspan="4" style="font-size:10px; text-align: left"><strong>Proveedor:</strong><?php echo $asto_ben?></td>
						<td style="font-size:10px; text-align: left">Monto:<?php echo $total;?></td>
						
					</tr>
					<tr>
						<td colspan="5" style="font-size:10px; text-align: left"><strong>RUC Proveedor:</strong><?php echo $ruc_beneficiario?></td>
					</tr>
					<tr>
						<td colspan="5" style="font-size:10px; text-align: left"><strong>Detalle:</strong><?php echo $asto_det?><br><br></td>
					</tr>
			</table>
			<table width="100%" border="1">
					<tr bgcolor="#C4BFC4">
						<td   align="left"  style="font-size:12px; color:white">N</td>
						<td   align="left"  style="font-size:12px; color:white">FACTURA</td>
						<td    align="left"  style="font-size:12px; color:white">PROVEEDOR</td>
						<td   align="left"  style="font-size:12px; color:white">VALOR</td>
					</tr>
					<?php $tot_deb =0; 
					$x=1;
						if(count($array_dir)>0){
                            foreach ($array_dir as $val){
                                $fact_num = $val[0]; 
                                $cre_ml   = $val[1]; 
                                $clpv_nom = htmlentities($val[2]); 
								//echo $x;exit;
                                ?>
                                <tr>
									<td  align="left"  style="font-size:10px;"><?php echo $x; ?></td>
									<td    align="left"  style="font-size:10px; "><?php echo$fact_num?></td>
									<td   align="left"  style="font-size:10px"><?php echo$clpv_nom?></td>
									<td   align="right" style="font-size:10px"><?php echo$cre_ml?></td>
								</tr>
											<?php
                                $x++;
                                $tot_deb += $cre_ml;
                            }?>
                            <tr bgcolor="#C4BFC4">
								
								<td  style="font-size:12px; color:white" align="right" colspan="3">TOTAL:</td>
								<td style="font-size:12px; color:white"align="right"><?php echo $tot_deb?></td>
                           </tr>
                        <?php }?>
						
			</table>
			<br><br><br><br>
			<table  border="1" width="100%" align="center" >
				<tr bgcolor="#C4BFC4">
					<td style="font-size:12px; text-align: left; color: white" >CUENTA</td>
					<td style="font-size:12px; text-align: left; color: white ">NOMBRE CUENTA</td>
					<?php if(($tipo=='028')||($tipo=='027')){?>
						<td style="font-size:12px; text-align: left; color: white">FACTURA</td>
					<?php }?>
					<?php if(($tipo=='026')||($tipo=='029')){?>
						<td style="font-size:12px; text-align: left; color: white">CENTRO DE COSTO</td>
					<?php }?>
					<td style="font-size:12px; text-align: left; color: white">DEBITO</td>
					<td style="font-size:12px; text-align: left; color: white">CREDITO</td>
				</tr>
				<?php if(count($array_dasi)>0){
					$tot_deb = 0;
                    $tot_cre = 0;
                            foreach ($array_dasi as $val){
                                $cuen_cod = $val[0]; 
                                $ccos_cod = $val[1]; 
                                $debi     = $val[2]; 
                                $cred     = $val[3]; 
                                $det      = htmlentities(substr($val[4],0,25)); 
                                $cuen_nom = htmlentities($val[5]); 
                                ?>
                                <tr class="tr-class" >
									<td style="font-size:10px; text-align: left;"><?php echo $cuen_cod?></td>
									<td style="font-size:10px; text-align: left; "><?php echo $cuen_nom?></td>
									<?php if(($tipo=='028')||($tipo=='027')){?>
									<td style="font-size:10px; text-align: right; "><?php echo $det?></td>
									<?php }?>
									<?php if(($tipo=='026')||($tipo=='029')){?>
									<td style="font-size:10px; text-align: right; "><?php echo $ccos_cod?></td>
									<?php }?>
									<td style="font-size:10px; text-align: right; "><?php echo $debi?></td>
									<td style="font-size:10px; text-align: right;"><?php echo $cred?></td>
                                </tr>
								<?php
                                $i++;
                                $tot_deb += $debi;
                                $tot_cre += $cred;
                            }
                            
                        }?>
					<tr  bgcolor="#C4BFC4">
						
						<td style="font-size:12px; text-align: right; color: white" colspan="3">TOTALES:</td>
						<td style="font-size:12px; text-align: center; color: white"><?PHP echo $tot_deb;?></td>
						<td style="font-size:12px; text-align: center; color: white"><?PHP echo $tot_cre;?></td>
					</tr>
				</table>
				<table width="100%">
				<tr><td><br><br><br><br><br><br></td></tr>
					<tr>
					<td width="15%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Ingresado por:<br><?php echo $usuario;?></td>
						<td width="30%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Firma Autorizada</td>
					<td width="15%"></td>	
						
					</tr>
					<tr><td><br><br><br><br><br><br></td></tr>
					<tr>
					<td width="15%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Revisado por:</td>
						<td width="30%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Recibí Conforme</td>
						
							<td width="15%"></td>
					</tr>
			</table>
		<!--	<table border="0" width="100%" align="center" style="border: thick solid white; border-collapse: collapse;">
				<tr >
					<td colspan="5" style="font-size:18px; text-align: center"><?php echo $empr_nom?><br><br></td>
				</tr>
				<tr>
					<td colspan="5" style="font-size:12px; text-align: center">SUCURSAL:<?php echo $sucu_nom?><br><br></td>
				</tr>
				<tr>
					<td colspan="5" style="font-size:12px; text-align: center">DIRECCION:<?php echo $empr_dir?><br><br></td>
				</tr>
				<tr>
					<td colspan="5" style="font-size:12px; text-align: center">RUC:<?php echo $empr_ruc?><br><br></td>
				</tr>
				<tr>
					<td colspan="5" style="font-size:14px; text-align: center">COMPROBANTE DE EGRESO<br><br></td>
				</tr>
				<tr>
					<td  colspan="4" style="font-size:10px; text-align: left">Fecha:<?php echo $asto_fec;?></td>
					<td style="font-size:10px; text-align: left">EGRESO No:<?php echo $asto_cod;?></td>
				</tr>
				<tr>
					<td  colspan="4" style="font-size:10px; text-align: left">Pagado a:<?php echo $asto_ben;?></td>
					<td style="font-size:10px; text-align: left">ASIENTO No:<?php echo $asto_cod;?></td>
				</tr>
				<tr>
					<td colspan="5" style="font-size:10px; text-align: left">Banco:<?php echo $asto_ben?></td>
					
					
				</tr>
				<tr>
					<td  colspan="4" style="font-size:10px; text-align: left">Cuenta Bancaria:<?php echo $asto_ben;?></td>
					<td style="font-size:10px; text-align: left">Cheque No:<?php echo $asto_cod;?></td>
				</tr>
			</table>
			<table width="100%" border="1">
					<tr bgcolor="#C4BFC4">
						<td class="fecha_letra"   align="left"  style="font-size:12px; color:white">N</td>
						<td class="fecha_letra"   align="left"  style="font-size:12px; color:white">FACTURA</td>
						<td class="fecha_letra"   align="left"  style="font-size:12px; color:white">PROVEEDOR</td>
						<td class="fecha_letra"   align="left"  style="font-size:12px; color:white">VALOR</td>
					</tr>
					<?php $tot_deb =0; 
						if(count($array_dir)>0){
                            foreach ($array_dir as $val){
                                $fact_num = $val[0]; 
                                $cre_ml   = $val[1]; 
                                $clpv_nom = htmlentities($val[2]); 
                                ?>
                                <tr>
									<td  align="left"  style="font-size:10px; color:white"><?php echo $i ?></td>
									<td    align="left"  style="font-size:10px; "><?php echo$fact_num?></td>
									<td   align="left"  style="font-size:10px"><?php echo$clpv_nom?></td>
									<td   align="right" style="font-size:10px"><?php echo$cre_ml?></td>
								</tr>
											<?php
                                $i++;
                                $tot_deb += $cre_ml;
                            }?>
                            <tr>
								<td ></td>
								<td ></td>
								<td >TOTAL:</td>
								<td align="right"><?php echo $tot_deb?></td>
                           </tr>
                        <?php }?>
						<tr><td><br><br><br></td></tr>
			</table>
			<table  border="0" width="100%" align="center" >
				<tr bgcolor="#C4BFC4">
					<td style="font-size:12px; text-align: left; color: white" >CUENTA</td>
					<td style="font-size:12px; text-align: left; color: white ">NOMBRE CUENTA</td>
					<td style="font-size:12px; text-align: left; color: white">PROVEEDOR</td>
					<td style="font-size:12px; text-align: left; color: white">FACTURA</td>
					<td style="font-size:12px; text-align: left; color: white">DEBITO</td>
					<td style="font-size:12px; text-align: left; color: white">CREDITO</td>
				</tr>
				<?php if(count($array_dasi)>0){
                            foreach ($array_dasi as $val){
                                $cuen_cod = $val[0]; 
                                $ccos_cod = $val[1]; 
                                $debi     = $val[2]; 
                                $cred     = $val[3]; 
                                $det      = htmlentities(substr($val[4],0,25)); 
                                $cuen_nom = htmlentities(substr($val[5],0,25)); 
                                ?>
                                <tr class="tr-class" >
									<td style="font-size:12px; text-align: left;"><?php echo $cuen_cod?></td>
									<td style="font-size:12px; text-align: left; "><?php echo $cuen_nom?></td>
									<td style="font-size:12px; text-align: right; "><?php echo $asto_ben?></td>
									<td style="font-size:12px; text-align: right; "><?php echo $ccos_cod?></td>
									<td style="font-size:12px; text-align: right; "><?php echo $debi?></td>
									<td style="font-size:12px; text-align: right;"><?php echo $cred?></td>
                                </tr>
								<?php
                                $i++;
                                $tot_deb += $debi;
                                $tot_cre += $cred;
                            }
                            
                        }?>
					<tr  bgcolor="#C4BFC4">
						
						<td style="font-size:12px; text-align: right; color: white"colspan="4">TOTALES:</td>
						<td style="font-size:12px; text-align: center; color: white"><?PHP echo $tot_deb;?></td>
						<td style="font-size:12px; text-align: center; color: white"><?PHP echo $tot_cre;?></td>
					</tr>
				</table>
			<table width="100%">
				<tr><td><br><br><br><br><br><br></td></tr>
					<tr>
					<td width="15%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Ingresado por:<br><?php echo $usuario;?></td>
						<td width="30%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Firma Autorizada</td>
					<td width="15%"></td>	
						
					</tr>
					<tr><td><br><br><br><br><br><br></td></tr>
					<tr>
					<td width="15%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Revisado por:</td>
						<td width="30%"></td>
						<td width="15%" style="font-size:10px; text-align: center;border-top : 2px solid black;">Recibí Conforme</td>
						
							<td width="15%"></td>
					</tr>
			</table>
			
			
         <!-- <table border="0" width="100%"  align="center">
                <tr>
                    <td colspan="6" class="fecha_letra" style="font-size:16px"><div align="center"><?=$empr_nom?></div></td>
                </tr>
                <tr>
                    <td colspan="6" class="fecha_letra" style="font-size:12px" height="20px"><div align="center"><?=$empr_dir;?> RUC: <?=$empr_ruc?></div></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td colspan="6" align="center" class="fecha_letra" style="font-size:12px">COMPROBANTE DE EGRESO No. <?=$asto_cod;?> </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="fecha_letra" align="left" style="font-size:10px">FECHA: </td>
                    <td  class="fecha_letra" align="left"><?=$asto_fec;?></td>
                    <td   align="left" class="fecha_letra" style="font-size:10px">FACTURA:</td>
                    <td class="fecha_letra" align="left"><?=$ret_fact;?></td>
                </tr>
                <tr>
                    <td class="fecha_letra" align="left" style="font-size:10px">MONEDA: </td>
                    <td  class="fecha_letra" align="left">DOLAR</td>
                    <td   align="left" class="fecha_letra" style="font-size:10px">No Retencion:</td>
                    <td class="fecha_letra" align="left"><?=$ret_num;?></td>
                </tr>
                <tr>
                    <td class="fecha_letra" align="left" style="font-size:10px">PROVEEDOR: </td>
                    <td  class="fecha_letra" align="left"><?=$ret_clpv?></td>
                    <td   align="left" class="fecha_letra" style="font-size:10px">Monto:</td>
                    <td class="fecha_letra" align="left"><?=$total;?></td>
                </tr>
                <tr>
                    <td class="fecha_letra" align="left" style="font-size:10px">DETALLE: </td>
                    <td colspan="3" class="fecha_letra" align="left"><?=$asto_det?></td>
                </tr>
                <tr>
                    <td colspan="6"><?
                        // DIRECTORIO
                        $i=1;
                        $table_cp .= '<br>';
                        $table_cp .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">
                                    <legend class="fecha_letra">FACTURAS</legend>';
                        $table_cp .='<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
                                        <tr>
                                                <td class="fecha_letra" width="10px" >N.-</td>
                                                <td class="fecha_letra" width="20px" >FACTURA</td>
                                                <td class="fecha_letra" width="160px">PROVEEDOR</td>
                                                <td class="fecha_letra" width="50px" >VALOR</td>
                                        </tr>';
                        $tot_deb = 0;   $tot_cre = 0;   $i = 1;
                        if(count($array_dir)>0){
                            foreach ($array_dir as $val){
                                $fact_num = $val[0]; 
                                $cre_ml   = $val[1]; 
                                $clpv_nom = htmlentities($val[2]); 
                                
                                $table_cp .='<tr height="20" class="'.$sClass.'"
                                                onMouseOver="javascript:this.className=\'link\';"
                                                onMouseOut="javascript:this.className=\''.$sClass.'\';">
                                                <td class="fecha_letra" width="10px"   align="left"  style="font-size:10px">
                                                        '.$i.'</td>
                                                <td class="fecha_letra" width="20px"   align="left"  style="font-size:10px">
                                                        '.$fact_num.'</td>
                                                <td class="fecha_letra" width="160px"  align="left"  style="font-size:10px">
                                                        '.$clpv_nom.'</td>
                                                <td class="fecha_letra" width="50px"   align="right" style="font-size:10px">
                                                        '.$cre_ml.'</td>
                                            </tr>';
                                $i++;
                                $tot_deb += $cre_ml;
                            }
                            $table_cp .='<tr height="20" class="'.$sClass.'"
                                                onMouseOver="javascript:this.className=\'link\';"
                                                onMouseOut="javascript:this.className=\''.$sClass.'\';">
                                                <td class="fecha_letra" width="10px" align="left"></td>
                                                <td class="fecha_letra" width="20px"></td>
                                                <td class="fecha_letra" width="160px">TOTAL:</td>
                                                <td class="fecha_letra" width="50px" align="right">'.$tot_deb.'</td>
                                            </tr>';
                        }
                        
                        $table_cp .= '</table></fieldset>';
                        echo $table_cp;
                        ?></td>
                </tr>
                <tr>
                    <td colspan="6"><?
                        // DETALLE
                        $i=1;
                        $table_cp  = '<br>';
                        $table_cp .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">
                                    <legend class="fecha_letra">DIARIO</legend>';
                        $table_cp .='<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
                                        <tr>
                                                <td class="fecha_letra" width="10px" >N.-</td>
                                                <td class="fecha_letra" width="20px" >CUENTA</td>
                                                <td class="fecha_letra" width="160px">NOMBRE CUENTA - DETALLE</td>
                                                <td class="fecha_letra" width="50px" >DEBITO</td>
                                                <td class="fecha_letra" width="50px" >CREDITO</td>
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
                                
                                $table_cp .='<tr height="20" class="'.$sClass.'"
                                                onMouseOver="javascript:this.className=\'link\';"
                                                onMouseOut="javascript:this.className=\''.$sClass.'\';">
                                                <td class="fecha_letra" width="10px"   align="left"  style="font-size:10px">'.$i.'</td>
                                                <td class="fecha_letra" width="20px"   align="left"  style="font-size:10px">'.$cuen_cod.'</td>
                                                <td class="fecha_letra" width="160px"  align="left"  style="font-size:10px">'.$cuen_nom.''.$det.'</td>
                                                <td class="fecha_letra" width="50px"   align="right" style="font-size:10px">'.$debi.'</td>
                                                <td class="fecha_letra" width="50px"   align="right" style="font-size:10px">'.$cred.'</td>
                                            </tr>';
                                $i++;
                                $tot_deb += $debi;
                                $tot_cre += $cred;
                            }
                            $table_cp .='<tr height="20" class="'.$sClass.'"
                                                onMouseOver="javascript:this.className=\'link\';"
                                                onMouseOut="javascript:this.className=\''.$sClass.'\';">
                                                <td class="fecha_letra" width="10px" align="left"></td>
                                                <td class="fecha_letra" width="20px"></td>
                                                <td class="fecha_letra" width="160px">TOTAL:</td>
                                                <td class="fecha_letra" width="50px" align="right">'.$tot_deb.'</td>
                                                <td class="fecha_letra" width="50px" align="right">'.$tot_cre.'</td>
                                            </tr>';
                        }
                        
                        $table_cp .= '</table></fieldset>';
                        echo $table_cp;
                        ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right"></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="6" align="right"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <BR><BR><BR>
            <BR><BR><BR>
            <table align="left" width="100%" >
                <tr>
                    <td align="CENTER"class="fecha_letra">_______________________&nbsp;&nbsp;</td>
                    <td align="CENTER"class="fecha_letra">_______________________&nbsp;&nbsp;</td>
                    <td align="CENTER"class="fecha_letra">_______________________</td>
                </tr>
                <tr>
                    <td align="CENTER"class="fecha_letra">AUTORIZADO</td>
                    <td align="CENTER"class="fecha_letra">CONTADOR</td>
                    <td align="CENTER"class="fecha_letra">CONTABILIZADO</td>
                    <td align="CENTER"class="fecha_letra"></td>
                </tr>
            </table> -->

        </div>


        <div id="dos">
            <table width="464" border="0" align="center">
                <tr>
                    <td align="center"><label>
                            <input name="Submit2" type="submit" class="fecha_letra" value="Imprimir" onclick="formato();" />
                        </label></td>
                </tr>
            </table>

        </div>
    </body>
</html>