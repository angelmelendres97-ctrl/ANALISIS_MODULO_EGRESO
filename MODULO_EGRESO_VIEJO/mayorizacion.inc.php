<?php
require_once(path(DIR_INCLUDE).'comun.lib.php');
class mayorizacion_class {
    
    var $propiedad_1;
    var $propiedad_2;
    var $propiedad_3;
    var $Conexion;    

     // TIDU
    function secu_asto($Conexion, $idempresa,  $sucursal, $modulo, $fecha_mov, $user_ifx, $tidu ) {
            // ASIENTO CONTABLE
            // // O B T E N E R     M O N E D A      D E S D E      I N F O R M I X
            $sql    = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
            $moneda = consulta_string_func($sql, 'pcon_mon_base', $Conexion,'', 0);

            // O B T E N E R     T C A M B I O      D E S D E      I N F O R M I X
            $sql = "select tcam_fec_tcam, tcam_cod_tcam, tcam_val_tcam from saetcam where
                                    tcam_cod_mone = $moneda and
                                    mone_cod_empr = $idempresa and
                                    tcam_fec_tcam = (select max(tcam_fec_tcam) from saetcam where
                                                            tcam_cod_mone = $moneda and
                                                            tcam_fec_tcam <= '$fecha_mov' and
                                                            mone_cod_empr = $idempresa) ";
            $tcambio = consulta_string_func($sql, 'tcam_cod_tcam', $Conexion, 0);

            // C O D I G O     D E L     E M P L E A D O     I N F O R M I X
            $sql = "SELECT usua_cod_empl, usua_nom_usua FROM SAEUSUA WHERE USUA_COD_USUA = $user_ifx ";
            if($Conexion->Query($sql)){
                if($Conexion->NumFilas()>0){
                    $empleado      = $Conexion->f('usua_cod_empl');
                    $usua_nom_usua = $Conexion->f('usua_nom_usua');
                }else{
                    $empleado =  '';
                    $usua_nom_usua = '';
                }
            }

            //  ANIO
            $anio = substr($fecha_mov, -4, 4);
            $fecha_ejer='12/31/'.$anio;
            
    //      EJERCICIO  DE  INFORMIX
            $sql = "select ejer_cod_ejer from saeejer where ejer_fec_finl = '$fecha_ejer' and ejer_cod_empr = $idempresa ";
            $idejer = consulta_string_func($sql, 'ejer_cod_ejer', $Conexion, 1);
            
    //      MES
            list($idprdo,$d,$a) = explode('/', $fecha_mov);
            
    //      FECHA  DEL SERVIDOR
            $fecha_servidor = date("m-d-Y");
            $hora =  date("H:i:s");
            
            
            // TIDU
            $sql = "select  tidu_cod_tidu from saetidu where
                        tidu_cod_empr = $idempresa and
                        tidu_cod_modu = $modulo and
                        tidu_tip_tidu = 'EG' and
                        tidu_cod_tidu = '$tidu'    ";
            $tidu = consulta_string($sql, 'tidu_cod_tidu', $Conexion, '');  

            // SECUENCIAL DEL ASIENTO
            $sql = "select  secu_dia_comp, secu_asi_comp, secu_egr_comp from saesecu where
                        secu_cod_empr = $idempresa and
                        secu_cod_sucu = $sucursal and
                        secu_cod_tidu = '$tidu' and
                        secu_cod_modu = $modulo and
                        secu_cod_ejer = $idejer and
                        secu_num_prdo = $idprdo ";
            if($Conexion->Query($sql)){
                if($Conexion->NumFilas()>0){
                    $secu_dia  = $Conexion->f('secu_egr_comp');
                    $secu_asto = $Conexion->f('secu_asi_comp');
                }
            }
            $Conexion->Free();

            $secu_dia_tmp  = substr($secu_dia,5);
            $secu_asto_tmp = substr($secu_asto,5);
            $ini_secu_dia  = substr($secu_dia, 0,5);
            $ini_secu_asto = substr($secu_asto, 0,5);

            $secu_dia = $ini_secu_dia.secuencial(2, '', $secu_dia_tmp, 8);
            $secu_asto = $ini_secu_asto.secuencial(2, '', $secu_asto_tmp, 8);

            // UPDATE SECUENCIA SAESECU
            $sql = "update saesecu set secu_egr_comp  = '$secu_dia', 
										secu_asi_comp = '$secu_asto' where
										secu_cod_empr = $idempresa and
										secu_cod_sucu = $sucursal and
										secu_cod_tidu = '$tidu' and
										secu_cod_modu = $modulo and
										secu_cod_ejer = $idejer and
										secu_num_prdo = $idprdo ";
            $Conexion->QueryT($sql);
            unset($array);
            $array [] = array( $secu_asto, $secu_dia, $tidu, $idejer, $idprdo, $moneda, $tcambio, 
                               $empleado,  $usua_nom_usua );
            return $array;
    }

    

    function saeasto($Conexion,  $secu_asto,  $idempresa,  $sucursal,    $idejer,      $idprdo, $moneda, $user_ifx, $tran, $clpv_nom,
                          $total_vta, $fecha_asto, $detalle_asto, $secu_dia,  $fecha_emis , $tidu,   $usua_nom, $user_web, $modulo      ) {
            // SAEASTO
            $sql = "insert into saeasto (  asto_cod_asto,       asto_cod_empr,      asto_cod_sucu,      asto_cod_ejer,
                                           asto_num_prdo,       asto_cod_mone,      asto_cod_usua,      asto_cod_modu,
                                           asto_cod_tdoc,       asto_ben_asto,      asto_vat_asto,      asto_fec_asto,
                                           asto_det_asto,       asto_est_asto,      asto_num_mayo,      asto_fec_emis,
                                           asto_tipo_mov,       asto_cot_asto,      asto_for_impr,      asto_cod_tidu,
                                           asto_usu_asto,       asto_fec_serv,      asto_user_web,      asto_fec_fina  )
                              values(  '$secu_asto',            $idempresa,         $sucursal,          $idejer,
                                        $idprdo,                $moneda,            $user_ifx,          $modulo,
                                       '$tran',                '$clpv_nom',         $total_vta,         '$fecha_asto',
                                       '$detalle_asto',        'PE',                '$secu_asto',        '$fecha_emis',
                                       'EG',                    1,                   8,                  '$tidu',
                                       '$usua_nom',             CURRENT_DATE,            $user_web ,         '$fecha_emis' )";
            $Conexion->QueryT($sql);
            return 'OK';
    }
    
    function saedasi($Conexion, $idempresa, 	$sucursal, 	 $cuenta, 	$idprdo, 	 $idejer, 		 $ccos, 		$debml, 		$crml, 		
					 $debme, 	$crme, 			$tip_camb,   $det_dasi, $clpv_cod,   $tran,     	 $user_web ,    $secu_asto,     $dasi_cod_ret,  
					 $dasi_dir, $dasi_cta_ret,  $opBand,     $opBacn,   $opFlch,     $num_cheq,		 $act_cod ){
            // SAEDASI
            // NOMBRE CUENTA 
            $sql = "select  cuen_nom_cuen  from saecuen where
                        cuen_cod_empr = $idempresa and
                        cuen_cod_cuen = '$cuenta' ";
            $cuen_prod_nom = consulta_string_func($sql, 'cuen_nom_cuen', $Conexion, '');

			if(!empty($act_cod)){
					$sql = "insert into saedasi (asto_cod_asto,        asto_cod_empr,      asto_cod_sucu,       dasi_num_prdo,
                                          asto_cod_ejer,       dasi_cod_cuen,      ccos_cod_ccos,       dasi_dml_dasi,      
                                          dasi_cml_dasi,       dasi_dme_dasi,      dasi_cme_dasi,       dasi_tip_camb,      
                                          dasi_det_asi,        dasi_nom_ctac,      dasi_cod_clie,       dasi_cod_tran,      
                                          dasi_user_web,       dasi_cod_ret,       dasi_cod_dir ,       dasi_cta_ret,
                                          dasi_cru_dasi,	   dasi_ban_dasi,	   dasi_bca_dasi,		dasi_con_flch,
										  dasi_num_depo,	   dasi_cod_cact )
                                values  ( '$secu_asto',         $idempresa,         $sucursal,          $idprdo,
                                           $idejer,            '$cuenta',          '$ccos',             $debml,      
                                           $crml,               $debme,             $crme,              $tip_camb ,
                                          '$det_dasi' ,        '$cuen_prod_nom',    '$clpv_cod',         '$tran',       
                                           $user_web ,         '$dasi_cod_ret',    '$dasi_dir',        '$dasi_cta_ret',
                                          'AC',					'$opBand',			'$opBacn',			'$opFlch',
										  '$num_cheq',		   '$act_cod' ); ";
			}else{
					$sql = "insert into saedasi (asto_cod_asto,        asto_cod_empr,      asto_cod_sucu,       dasi_num_prdo,
                                          asto_cod_ejer,       dasi_cod_cuen,      ccos_cod_ccos,       dasi_dml_dasi,      
                                          dasi_cml_dasi,       dasi_dme_dasi,      dasi_cme_dasi,       dasi_tip_camb,      
                                          dasi_det_asi,        dasi_nom_ctac,      dasi_cod_clie,       dasi_cod_tran,      
                                          dasi_user_web,       dasi_cod_ret,       dasi_cod_dir ,       dasi_cta_ret,
                                          dasi_cru_dasi,	   dasi_ban_dasi,	   dasi_bca_dasi,		dasi_con_flch,
										  dasi_num_depo )
                                values  ( '$secu_asto',         $idempresa,         $sucursal,          $idprdo,
                                           $idejer,            '$cuenta',          '$ccos',             $debml,      
                                           $crml,               $debme,             $crme,              $tip_camb ,
                                          '$det_dasi' ,        '$cuen_prod_nom',    '$clpv_cod',         '$tran',       
                                           $user_web ,         '$dasi_cod_ret',    '$dasi_dir',        '$dasi_cta_ret',
                                          'AC',					'$opBand',			'$opBacn',			'$opFlch',
										  '$num_cheq' ); ";
			}
            
            $Conexion->QueryT($sql);
            return 'OK';
    }
    
    function saedir($Conexion, $idempresa, $sucursal, $idprdo, $idejer, $asto_cod, $clpv_cod, $modu_cod , $tran_cod ,
                    $fact_num,  $fecha_venc, $detalle, $deb_ml, $cre_ml,  $deb_me, $cre_me, $bandera, $auto_sri,
                    $impr,      $fac_ini,   $fac_fin,   $serie,  $fec_auto, $user_web, $cod_dir , $tcam, $clpv_nom , $ccli_cod ){
            $sql = "insert into saedir( dir_cod_dir,            dire_cod_asto,      dire_cod_empr,      dire_cod_sucu,
                                       asto_cod_ejer,          asto_num_prdo,      dir_cod_cli,        tran_cod_modu,
                                       dir_cod_tran,           dir_num_fact,       dir_fec_venc,       dir_detalle,
                                       dire_tip_camb,          dir_deb_ml,         dir_cre_ml,         dir_deb_mex,
                                       dir_cred_mex,           bandera_cr,         dir_aut_usua,       dir_aut_impr,
                                       dir_fac_inic,           dir_fac_fina,       dir_ser_docu,       dir_fec_vali,
                                       dire_suc_clpv,          dir_user_web,       dire_nom_clpv ,	   dir_cod_ccli  )
                               values( $cod_dir,              '$asto_cod',        $idempresa,         $sucursal,
                                       $idejer,                $idprdo,            $clpv_cod,          '$modu_cod', 
                                       '$tran_cod',            '$fact_num',        '$fecha_venc',      '$detalle',
                                       $tcam,                   $deb_ml  ,          $cre_ml,            $deb_me,
                                       $cre_me,                '$bandera',         '$auto_sri' ,       '$impr',
                                       '$fac_ini',             '$fac_fin',         '$serie',           '$fec_auto',
                                        $sucursal,              $user_web ,        '$clpv_nom',        '$ccli_cod'   );  ";
            $Conexion->QueryT($sql);
            return 'OK';
    }
    
    function saeret($Conexion, $idempresa, $sucursal, $idprdo, $idejer, $asto_cod, $clpv_cod, $clpv_nom, $clpv_dir, $clpv_tel, 
                    $clpv_ruc,  $ret_secu , $ret_cod, $ret_porc , $base_imp, $valor, $ret_num, $detalle, $deb_ml, $cre_ml,  
                    $deb_me, $cre_me, $factura,  $serie, $auto_sri, $fec_ret,  $correo, $elect_sn, $coti   ){
            $sql = "insert into saeret(ret_cod_ret,         rete_cod_asto,      asto_cod_empr,      asto_cod_sucu,
                                       asto_cod_ejer,       asto_num_prdo,      ret_cta_ret,        ret_porc_ret,
                                       ret_bas_imp,         ret_valor ,         ret_num_ret,        ret_detalle,
                                       ret_tip_camb,        ret_deb_ml,         ret_cre_ml  ,       ret_deb_mex,
                                       ret_cre_mex,         rete_nom_benf,      rete_dire_benf,     rete_telf_benf,
                                       rete_ruci_benf,      ret_num_fact,       ret_cod_clpv,       ret_nom_clpv,
                                       ret_ser_ret,         ret_aut_ret,        ret_fec_ret,        ret_email_clpv,
                                       ret_elec_sn )
                              values(  $ret_secu,           '$asto_cod',        $idempresa,         $sucursal,
                                       $idejer ,            $idprdo,            '$ret_cod',         $ret_porc,
                                       $base_imp,           $valor,             '$ret_num',         '$detalle',
                                       $coti,                   $deb_ml,            $cre_ml,            $deb_me,
                                       $cre_me,             '$clpv_nom',        '$clpv_dir',        '$clpv_tel',
                                       '$clpv_ruc',         '$factura',         $clpv_cod,          '$clpv_nom',
                                       '$serie'    ,        '$auto_sri',        '$fec_ret',         '$correo',
                                       '$elect_sn' ); ";
            $Conexion->QueryT($sql);
            return 'OK';
    }
    
}

?>