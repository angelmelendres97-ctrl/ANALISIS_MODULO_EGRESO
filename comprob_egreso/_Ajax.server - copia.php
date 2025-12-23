<?php
require("_Ajax.comun.php"); // No modificar esta linea
include_once './mayorizacion.inc.php';

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// S E R V I D O R   A J A X //
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/**
Herramientas de apoyo 
 */
 
function genera_grid($aData = null, $aLabel = null, $sTitulo = 'Reporte', $iAncho = '400', $aAccion = null,$Totales=null, $aOrden = null){
	
	unset($arrayaDataGridVisible);
	unset($arrayaDataGridTipo);
	if($sTitulo == 'DIRECTORIO'){
		
		$arrayaDataGridVisible[0] = 'S';
		$arrayaDataGridVisible[1] = 'S';
		$arrayaDataGridVisible[2] = 'S';
		$arrayaDataGridVisible[3] = 'S';
		$arrayaDataGridVisible[4] = 'S';
		$arrayaDataGridVisible[5] = 'S';
		$arrayaDataGridVisible[6] = 'S';
		$arrayaDataGridVisible[7] = 'S';
		$arrayaDataGridVisible[8] = 'S';
		$arrayaDataGridVisible[9] = 'N';
		$arrayaDataGridVisible[10] = 'S';

		$arrayaDataGridTipo[0] = 'N';
		$arrayaDataGridTipo[1] = 'T';
		$arrayaDataGridTipo[2] = 'T';
		$arrayaDataGridTipo[3] = 'T';
		$arrayaDataGridTipo[4] = 'T';
		$arrayaDataGridTipo[5] = 'T';
		$arrayaDataGridTipo[6] = 'N';
		$arrayaDataGridTipo[7] = 'N';
		$arrayaDataGridTipo[8] = 'N';
		$arrayaDataGridTipo[9] = 'I';
		$arrayaDataGridTipo[10] = 'I';
		
	}elseif($sTitulo == 'DIARIO'){
		
		$arrayaDataGridVisible[0] = 'S';
		$arrayaDataGridVisible[1] = 'S';
		$arrayaDataGridVisible[2] = 'S';
		$arrayaDataGridVisible[3] = 'S';
		$arrayaDataGridVisible[4] = 'S';
		$arrayaDataGridVisible[5] = 'S';
		$arrayaDataGridVisible[6] = 'S';
		$arrayaDataGridVisible[7] = 'N';
		$arrayaDataGridVisible[8] = 'S';
		$arrayaDataGridVisible[9] = 'S';
		$arrayaDataGridVisible[10] = 'S';
		$arrayaDataGridVisible[11] = 'S';
		$arrayaDataGridVisible[12] = 'S';
		$arrayaDataGridVisible[13] = 'S';
		$arrayaDataGridVisible[14] = 'S';
		$arrayaDataGridVisible[15] = 'S';
		$arrayaDataGridVisible[16] = 'S';
		$arrayaDataGridVisible[17] = 'S';
		
		$arrayaDataGridTipo[0] = 'N';
		$arrayaDataGridTipo[1] = 'T';
		$arrayaDataGridTipo[2] = 'T';
		$arrayaDataGridTipo[3] = 'T';
		$arrayaDataGridTipo[4] = 'N';
		$arrayaDataGridTipo[5] = 'N';
		$arrayaDataGridTipo[6] = 'N';
		$arrayaDataGridTipo[7] = 'I';
		$arrayaDataGridTipo[8] = 'I';
		$arrayaDataGridTipo[9] = 'T';
		$arrayaDataGridTipo[10] = 'T';
		$arrayaDataGridTipo[11] = 'T';
		$arrayaDataGridTipo[12] = 'T';
		$arrayaDataGridTipo[13] = 'T';
		$arrayaDataGridTipo[14] = 'T';
		$arrayaDataGridTipo[15] = 'T';
		$arrayaDataGridTipo[16] = 'T';
		$arrayaDataGridTipo[17] = 'T';
		
		
	}elseif($sTitulo == 'RETENCION'){
		
		$arrayaDataGridVisible[0] = 'S';
		$arrayaDataGridVisible[1] = 'S';
		$arrayaDataGridVisible[2] = 'S';
		$arrayaDataGridVisible[3] = 'S';
		$arrayaDataGridVisible[4] = 'S';
		$arrayaDataGridVisible[5] = 'S';
		$arrayaDataGridVisible[6] = 'S';
		$arrayaDataGridVisible[7] = 'S';
		$arrayaDataGridVisible[8] = 'S';
		$arrayaDataGridVisible[9] = 'S';
		$arrayaDataGridVisible[10] = 'S';
		$arrayaDataGridVisible[11] = 'S';
		$arrayaDataGridVisible[12] = 'S';
		$arrayaDataGridVisible[13] = 'S';
		$arrayaDataGridVisible[14] = 'S';
		
		$arrayaDataGridTipo[0] = 'N';
		$arrayaDataGridTipo[1] = 'T';
		$arrayaDataGridTipo[2] = 'T';
		$arrayaDataGridTipo[3] = 'T';
		$arrayaDataGridTipo[4] = 'T';
		$arrayaDataGridTipo[5] = 'N';
		$arrayaDataGridTipo[6] = 'N';
		$arrayaDataGridTipo[7] = 'N';
		$arrayaDataGridTipo[8] = 'T';
		$arrayaDataGridTipo[9] = 'T';
		$arrayaDataGridTipo[10] = 'T';
		$arrayaDataGridTipo[11] = 'T';
		$arrayaDataGridTipo[12] = 'N';
		$arrayaDataGridTipo[13] = 'N';
		$arrayaDataGridTipo[14] = 'N';
		
	}
	
	
	
	if (is_array($aData) && is_array($aLabel)){
		$iLabel = count($aLabel);
		$iData = count($aData);
		$sHtml = '';
		$sHtml .= '<form id="DataGrid">';
		$sHtml .= '<table class="table table-striped table-condensed table-bordered" style="width: 100%; margin-top: 10px;" align="center">';
		$sHtml .= '<tr>';
		$sHtml .= '<td colspan="'.$iLabel.'">'.$sTitulo.'</td>';
		$sHtml .= '</tr>';
		$sHtml .='<tr class="warning"><td colspan="'.$iLabel.'">Su consulta genero '.$iData.' registros de resultado</td></tr>';
		$sHtml .= '<tr>';
		
		// Genera Columnas de Grid
		for($i=0 ; $i < $iLabel ; $i++){
			$sLabel = explode('|',$aLabel[$i]);
			if($sLabel[1]==''){
				
				$aDataVisible = $arrayaDataGridVisible[$i];
				if($aDataVisible == 'S'){
					$aDataVisible = '';
				}else{
					$aDataVisible = 'none;';
				
				}	
				
				$sHtml .= '<td class="info" align="center" style="display: '.$aDataVisible .'">' . $sLabel[0] . '</th>';
			}else{
				if ($sLabel[1] == $aOrden[0]){
					if ($aOrden[1]=='ASC'){
						$sLabel[1].='|DESC';
						$sImg = '<img src="' . path ( DIR_IMAGENES ) . 'iconos/ico_down.png" align="absmiddle" />';
					}else{
						$sLabel[1].='|ASC';
						$sImg = '<img src="' . path ( DIR_IMAGENES ) . 'iconos/ico_up.png" align="absmiddle" />';
					}
				} else {
					$sImg = '';
					$sLabel[1].='|ASC';
				}

				$sHtml .= '<th onClick="xajax_'.$sLabel[2].'(xajax.getFormValues(\'form1\'),\''.$sLabel[1].'\')"
								style="cursor: hand !important; cursor: pointer !important;" >'.$sLabel[0].' ';
				$sHtml .= $sImg;
				$sHtml .= '</td>';
			}
		}
		$sHtml .= '</tr>';
		
		// Genera Filas de Grid
		for($i = 0; $i < $iData ; $i++){
			$sHtml .= '<tr>';
			for($j = 0 ; $j < $iLabel ; $j++){
			
				$campo = $aData[$i][$aLabel[$j]];
				
				$aDataVisible = $arrayaDataGridVisible[$j];
				if($aDataVisible == 'S'){
					$aDataVisible = '';
				}else{
					$aDataVisible = 'none;';
				}
				
				$aDataTipo = $arrayaDataGridTipo[$j];
				$alignCampo = 'left';
				if($aDataTipo == 'T'){
					$alignCampo = 'left';
				}elseif($aDataTipo == 'N'){
					if (is_numeric($campo)){
						$campo = number_format($campo, 2, '.', '');
					}
					$alignCampo = 'right';
				}elseif($aDataTipo == 'I'){
					$alignCampo = 'center';
				}
				
				$sHtml .= '<td align="'.$alignCampo.'" style="display: '.$aDataVisible .';">' . $campo . '</td>';
				
			}
			$sHtml .= '</tr>';
		}

		//Totales
		$sHtml .= '<tr class="danger">';
		if (is_array($Totales)){
			for($i=0 ; $i < $iLabel ; $i++){
				if($i==0)
					$sHtml .= '<td class="fecha_letra" align="right">TOTALES</td>';
				else {
					if($Totales[$i]=='')
						if($Totales[$i]=='0.00')
							$sHtml .= '<td align="right" class="fecha_letra">'.number_format($Totales[$i],2,',','.').'</td>';
						else
							$sHtml .= '<td align="right"></th>';
					else
						$sHtml .= '<td align="right" class="fecha_letra">'.number_format($Totales[$i],2,',','.').'</td>';
				}
			}
		}
		$sHtml .= '</tr>';
		
		//Saldos
		unset($_SESSION['ARRAY_SALDOS_TMP']);
		unset($arraySaldo);
		if($sTitulo == 'DIARIO'){
			$sHtml .= '<tr class="danger">';
			$saldoDeb = 0;
			$saldoCre = 0;
			if (is_array($Totales)){
				$valDeb = 0;
				$valCre = 0;
				for($i = 0 ; $i < $iLabel ; $i++){
					if($i == 5) {
						$valDeb += $Totales[$i];
					}elseif($i == 6) {
						$valCre += $Totales[$i];
					}
				}//fin for
				
				if($valDeb > $valCre){
					$saldoCre = $valCre - $valDeb;
					$arraySaldo[] = array('CR', $saldoCre);
				}elseif($valDeb < $valCre){
					$saldoDeb = round($valDeb - $valCre, 2);
					$arraySaldo[] = array('DB', $saldoDeb);
				}
				
				$sHtml .= '<td class="fecha_letra" align="right">SALDO</td>';
				$sHtml .= '<td colspan="4"></td>';
				$sHtml .= '<td class="fecha_letra" align="right" >'.$saldoDeb.'</td>';
				$sHtml .= '<td class="fecha_letra" align="right" >'.$saldoCre.'</td>';
				$sHtml .= '<td colspan="10"></td>';
				
			}
			$_SESSION['ARRAY_SALDOS_TMP'] = $arraySaldo;
			$sHtml .= '</tr>';
		}
		$sHtml .= '</table>';
		$sHtml .= '</form>';
	}
	return $sHtml;
}

/****************************************************************/
/* DF01 :: G E N E R A    F O R M U L A R I O    P R O C E S O  */
/****************************************************************/
function genera_formulario($sAccion='nuevo',$aForm=''){
    //  Definiciones
	global $DSN_Ifx, $DSN;	
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}	
	
	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();

    $ifu = new Formulario;
	$ifu->DSN=$DSN_Ifx;
        
    $fu = new Formulario;
	$fu->DSN=$DSN;
	
	$oReturn      = new xajaxResponse();	
        
	$idempresa    = $aForm['empresa'];
    $idsucursal   = $aForm['sucursal'];        
    $diaHoy = date("Y-m-d");

    //  LECTURA SUCIA
    //////////////
        
	switch ($sAccion){
		case 'nuevo':
                        $idempresa  = $_SESSION['U_EMPRESA'];
                        $idsucursal = $_SESSION['U_SUCURSAL'];

                        
                        $ifu->AgregarCampoListaSQL('empresa','Empresa|left',"SELECT EMPR_COD_EMPR, EMPR_NOM_EMPR FROM SAEEMPR 
                                                                                where empr_cod_empr = $idempresa ORDER BY 2",true,170,150);                        
                        $ifu->AgregarComandoAlCambiarValor('empresa', 'cargar_sucu();');
                        $ifu->AgregarCampoListaSQL('sucursal', 'Sucursal|left', "select sucu_cod_sucu, sucu_nom_sucu 
                                                                                    from saesucu where
                                                                                    sucu_cod_empr = $idempresa order by 1 ",
                                                                                    true, 170,150);
                        $ifu->AgregarComandoAlCambiarValor('sucursal', 'cargar_tran();');

                        $ifu->cCampos["empresa"]->xValor = $idempresa;
                        $ifu->cCampos["sucursal"]->xValor = $idsucursal;
                        
                        $ifu->AgregarCampoListaSQL('tipo_doc', 'Tipo Documento|left', "select tidu_cod_tidu, 
                                                                                        tidu_des_tidu
                                                                                        from saetidu where
                                                                                        tidu_cod_empr = $idempresa and
                                                                                        tidu_cod_modu = 5 and
                                                                                        tidu_tip_tidu = 'EG' ", true, 150,150);

                        $sql = "select tidu_cod_tidu, 
                                    tidu_des_tidu
                                    from saetidu where
                                    tidu_cod_empr = $idempresa and
                                    tidu_cod_modu = 5 and
                                    tidu_tip_tidu = 'EG' and
                                    tidu_def_tidu = 'D' ";
                        $tidu = consulta_string_func($sql, 'tidu_cod_tidu', $oIfx, ''); 
                        $ifu->cCampos["tipo_doc"]->xValor = $tidu;

                        $ifu->AgregarCampoFecha('fecha', 'Fecha Registro Contable|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
						
                        $ifu->AgregarCampoTexto('ruc', 'Ruc|left', true, '', 100, 120);
                        $ifu->AgregarCampoTexto('cliente_nombre', 'Beneficiario|left', false, '', 350, 200);
                        $ifu->AgregarComandoAlEscribir('cliente_nombre', 'autocompletar(' . $idempresa . ', event, 0 );form1.cliente_nombre.value=form1.cliente_nombre.value.toUpperCase();');
                        $ifu->AgregarCampoTexto('cliente', 'Cliente|left', true, '', 50, 50);
                        $ifu->AgregarComandoAlPonerEnfoque('cliente', 'this.blur()');
                        $ifu->AgregarCampoListaSQL('empleado', 'Cobrador|left', "select empl_cod_empl, empl_ape_nomb 
                                                                                        from saeempl where
                                                                                        empl_cod_empr = $idempresa and
                                                                                        empl_cod_eemp = 'A' order by 2 ", false, 170,150);
                        $ifu->AgregarCampoNumerico('valor', 'Valor|left', true, 0, 150, 150);
                        $ifu->AgregarCampoListaSQL('formato', 'Formato|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                    from saeftrn where
                                                                                    ftrn_cod_empr = $idempresa and
                                                                                    ftrn_cod_modu = 5 and
                                                                                    ftrn_tip_movi = 'EG' ", true, 150,150);
                         $ifu->AgregarCampoLista('deas', 'Deas|left', false, 170,150);
                        $sql = "select deas_cod_deas,  saedeas.deas_des_deas from saedeas order by 2";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $ifu->AgregarOpcionCampoLista('deas',$oIfx->f('deas_cod_deas').' '.$oIfx->f('deas_des_deas'),$oIfx->f('deas_cod_deas'));
                                }while($oIfx->SiguienteRegistro());
                            }
                        }
						$oIfx->Free();

                        $ifu->AgregarCampoTexto('detalle', 'Detalle|left', true, '', 550, 200);
                        $ifu->AgregarComandoAlEscribir('detalle', 'cargar_detalle();');
                        $ifu->AgregarCampoTexto('asto_cod', 'Asiento|left', false, '', 120, 120);
                        $ifu->AgregarCampoTexto('compr_cod', 'Comprobante N.-|left', false, '', 120, 120);
                        $ifu->AgregarComandoAlPonerEnfoque('asto_cod', 'this.blur()');
                        $ifu->AgregarComandoAlPonerEnfoque('compr_cod', 'this.blur()');                        
                        			
            			unset($_SESSION['aDataGirdDir']);
            			$oReturn->assign("divDir","innerHTML","");
                                    
                        unset($_SESSION['aDataGirdDiar']);
            			$oReturn->assign("divDiario","innerHTML","");
                                    
                        unset($_SESSION['aDataGirdRet']);
            			$oReturn->assign("divRet","innerHTML","");
                        
                        // DIRECTORIO
						$ifu->AgregarCampoTexto('clpv_nom', 'Cliente - Proveedor|left', false, '', 200, 200);
                        $ifu->AgregarComandoAlEscribir('clpv_nom', 'autocompletar(' . $idempresa . ', event, 1 );form1.clpv_nom.value=form1.clpv_nom.value.toUpperCase();');
						
                        $ifu->AgregarCampoOculto('clpv_cod', '');
						
                        $ifu->AgregarCampoLista('tran', 'Tipo|left', false, 170,150);     
                        $sql = "select tran_cod_tran, tran_des_tran, trans_tip_tran from saetran where
                                    tran_cod_empr = $idempresa and
                                    tran_cod_sucu = $idsucursal and
                                    tran_cod_modu = 4 order by 2 ";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $tran_des = $oIfx->f('tran_cod_tran') .' || '.$oIfx->f('tran_des_tran').' || '.$oIfx->f('trans_tip_tran');
                                    $ifu->AgregarOpcionCampoLista('tran',$tran_des,$oIfx->f('tran_cod_tran')); 
                                }while($oIfx->SiguienteRegistro());
                            }
                        }
						$oIfx->Free();
						
                        $ifu->AgregarCampoTexto('factura', 'Factura|left', false, '', 140, 200);
                        $ifu->AgregarComandoAlEscribir('factura', 'facturas(' . $idempresa . ', event );');
						
                        $ifu->AgregarCampoNumerico('fact_valor', 'Valor|left', false, 0, 50, 100);
                        $ifu->AgregarCampoTexto('det_dir', 'Detalle|left', false, '', 200, 100);
                        
                        // RETENCION
                        $ifu->AgregarCampoTexto('cod_ret', 'Cta Ret.|left', false, '', 90, 9);
                        $ifu->AgregarComandoAlEscribir('cod_ret', 'cod_retencion(' . $idempresa . ', event );');
						
                        $ifu->AgregarCampoTexto('fact_ret', 'Factura|left', false, '', 150, 200);
                        $ifu->AgregarComandoAlEscribir('fact_ret', 'fact_retencion(' . $idempresa . ', event );');
                        $ifu->AgregarCampoTexto('ret_clpv', 'Ret. Cliente|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_porc', 'Porc.(%)|left', false, '', 50, 50);
                        $ifu->AgregarCampoNumerico('ret_base', 'Base Imponible|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_val', 'Valor|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_num', 'N.- Retencion|left', false, '', 100, 200);
                        $ifu->AgregarComandoAlCambiarValor('ret_num', 'numero_ret();');
                        $ifu->AgregarCampoTexto('ret_det', 'Detalle|left', false, '', 150, 200);
                        $ifu->AgregarCampoTexto('cta_deb', 'Debito|left', false, '', 50, 200);
                        $ifu->AgregarCampoTexto('cta_cre', 'Credito|left', false, '', 50, 200);
                        $ifu->AgregarCampoTexto('tipo', 'tipo|left', false, '', 50, 200);
                        
						$ifu->AgregarCampoNumerico('cotizacion', 'Cotizacion|left', false, 1, 50, 9);
						
                        $ifu->AgregarCampoNumerico('cotizacion_ret', 'Cotizacion|left', false, 1, 50, 9);


                        // CUENTAS DASI
						$ifu->AgregarCampoOculto('cod_cta', '');
					   
                        $ifu->AgregarCampoTexto('nom_cta', 'Nombre Cta|left', false, '', 150, 200);
                        $ifu->AgregarComandoAlEscribir('nom_cta', 'auto_dasi(' . $idempresa . ', event, 0 );form1.nom_cta.value=form1.nom_cta.value.toUpperCase();');
                        $ifu->AgregarCampoNumerico('val_cta', 'Valor|left', false, '', 100, 200);
                        
                        $ifu->AgregarCampoLista('crdb', 'Tipo|left', false, 'auto');
                        $ifu->AgregarOpcionCampoLista('crdb','CREDITO','CR');
                        $ifu->AgregarOpcionCampoLista('crdb','DEBITO','DB');
                        $ifu->AgregarCampoTexto('documento', 'Documento|left', false, '', 80, 10);

                        //ASIENTO CONTABLE
                        $fu->AgregarCampoTexto('ejer_cod', 'Ejericio|left', false, '', 100, 100);
                        $fu->AgregarCampoTexto('prdo_cod', 'Periodo|left', false, '', 100, 100);

                        // CHEQUE
                        $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');
                        $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, '', 200, 150);
                        $fu->AgregarCampoTexto('cta_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
                        $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, 
                                                date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, '150');

                        // MONEDA
                        $ifu->AgregarCampoListaSQL('moneda', 'Moneda|left', "select mone_cod_mone, mone_des_mone  from saemone where mone_cod_empr = $idempresa ", true, 150,150);
                        $ifu->AgregarComandoAlCambiarValor('moneda', 'cargar_coti();');

                        $sql      = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
                        $mone_cod = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
                        $ifu->cCampos["moneda"]->xValor = $mone_cod;
						
						$ifu->AgregarCampoTexto('detalla_diario', 'Detalle|left', false, '', 170, 200);
						
						
						// CENTRO COSTOS 
						$ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", false, 150,150);

						// CENTRO DE ACTIVIDAD
						$ifu->AgregarCampoListaSQL('actividad', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 150,150);
																								
						//campo por defecto formato
						$sql = "select ftrn_cod_ftrn 
								from saeftrn where
								ftrn_cod_empr = $idempresa and
								ftrn_cod_modu = 5 and
								ftrn_tip_movi = 'EG'";
						$tipoForDef = consulta_string($sql, 'ftrn_cod_ftrn', $oIfx, 0);																		
						$ifu->cCampos["formato"]->xValor = $tipoForDef;
						
						$ifu->AgregarCampoLista('ccli', 'SubCliente|left', false, 170,150);

	break;
    case 'sucursal':
                        
                        $ifu->AgregarCampoListaSQL('empresa','Empresa|left',"SELECT EMPR_COD_EMPR, EMPR_NOM_EMPR FROM SAEEMPR ORDER BY 2",true,170,150);                        
                        $ifu->AgregarComandoAlCambiarValor('empresa', 'cargar_sucu();');
                        $ifu->AgregarCampoListaSQL('sucursal', 'Sucursal|left', "select sucu_cod_sucu, sucu_nom_sucu 
                                                                                        from saesucu where
                                                                                        sucu_cod_empr = $idempresa order by 1 ", true, 170,150); 
                        $ifu->AgregarComandoAlCambiarValor('sucursal', 'cargar_tran();');
                        $ifu->AgregarCampoListaSQL('tipo_doc', 'Tipo Documento|left', "select tidu_cod_tidu, 
                                                                                            tidu_des_tidu
                                                                                            from saetidu where
                                                                                            tidu_cod_empr = $idempresa and
                                                                                            tidu_cod_modu = 5 and
                                                                                            tidu_tip_tidu = 'IN' ", true, 150,150);
                        $ifu->AgregarCampoFecha('fecha', 'Fecha Registro Contable|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoTexto('ruc', 'Ruc|left', true, '', 100, 120);
                        $ifu->AgregarCampoTexto('cliente_nombre', 'Beneficiario|left', true, '', 350, 200);
                        $ifu->AgregarComandoAlEscribir('cliente_nombre', 'autocompletar(' . $idempresa . ', event, 0 );form1.cliente_nombre.value=form1.cliente_nombre.value.toUpperCase();');
                        $ifu->AgregarCampoTexto('cliente', 'Cliente|left', true, '', 50, 50);
                        $ifu->AgregarComandoAlPonerEnfoque('cliente', 'this.blur()');
                        $ifu->AgregarComandoAlCambiarValor('cliente', 'cargar_datos()');
                        
                        $ifu->AgregarCampoListaSQL('empleado', 'Cobrador|left', "select empl_cod_empl, empl_ape_nomb from saeempl where
                                                                                        empl_cod_empr = $idempresa and
                                                                                        empl_cod_eemp = 'A' order by 2 ", true, 170,150);
                        $ifu->AgregarCampoNumerico('valor', 'Valor|left', true, 0, 150, 150);
                        $ifu->AgregarCampoListaSQL('formato', 'Formato|left', "select ftrn_cod_ftrn, ftrn_des_ftrn from saeftrn where
                                                                                                ftrn_cod_empr = $idempresa and
                                                                                                ftrn_cod_modu = 5 and
                                                                                                ftrn_tip_movi = 'IN' ", true, 150,150);
                        $ifu->AgregarCampoLista('deas', 'Deas|left', false, 170,150);
                        $sql = "select deas_cod_deas,  saedeas.deas_des_deas from saedeas order by 2";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $ifu->AgregarOpcionCampoLista('deas',$oIfx->f('deas_cod_deas').' '.$oIfx->f('deas_des_deas'),$oIfx->f('deas_cod_deas'));
                                }while($oIfx->SiguienteRegistro());
                            }
                        }
						$oIfx->Free();
                        
                        $ifu->AgregarCampoTexto('detalle', 'Detalle|left', true, '', 550, 200);
                        //                        $ifu->AgregarComandoAlEscribir('detalle', 'form1.det_dir.value = form1.detalle.value');
                        $ifu->AgregarComandoAlEscribir('detalle', 'cargar_detalle();');
                        $ifu->AgregarCampoTexto('asto_cod', 'Asiento|left', false, '', 120, 120);
                        $ifu->AgregarCampoTexto('compr_cod', 'Comprobante N.-|left', false, '', 120, 120);
                        $ifu->AgregarComandoAlPonerEnfoque('asto_cod', 'this.blur()');
                        $ifu->AgregarComandoAlPonerEnfoque('compr_cod', 'this.blur()');
                        
                        // DIRECTORIO
                        $ifu->AgregarCampoTexto('clpv_nom', 'Cliente - Proveedor|left', false, '', 200, 200);
                        $ifu->AgregarComandoAlEscribir('clpv_nom', 'autocompletar(' . $idempresa . ', event, 1 );form1.clpv_nom.value=form1.clpv_nom.value.toUpperCase();');
						
                        $ifu->AgregarCampoOculto('clpv_cod', '');
						
                        $ifu->AgregarCampoLista('tran', 'Tipo|left', false, 170,150);   
						
                        $ifu->AgregarCampoTexto('factura', 'Factura|left', false, '', 140, 200);
                        $ifu->AgregarComandoAlEscribir('factura', 'facturas(' . $idempresa . ', event );');
						
                        $ifu->AgregarCampoNumerico('fact_valor', 'Valor|left', false, 0, 50, 100);
                        $ifu->AgregarCampoTexto('det_dir', 'Detalle|left', false, '', 200, 100);
                        
                        // RETENCION
                        $ifu->AgregarCampoTexto('cod_ret', 'Cta Ret.|left', false, '', 90, 9);
                        $ifu->AgregarComandoAlEscribir('cod_ret', 'cod_retencion(' . $idempresa . ', event );');
						
                        $ifu->AgregarCampoTexto('fact_ret', 'Factura|left', false, '', 150, 200);
                        $ifu->AgregarComandoAlEscribir('fact_ret', 'fact_retencion(' . $idempresa . ', event );');
                        $ifu->AgregarCampoTexto('ret_clpv', 'Ret. Cliente|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_porc', 'Porc.(%)|left', false, '', 50, 50);
                        $ifu->AgregarCampoNumerico('ret_base', 'Base Imponible|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_val', 'Valor|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_num', 'N.- Retencion|left', false, '', 100, 200);
                        $ifu->AgregarComandoAlCambiarValor('ret_num', 'numero_ret();');
                        $ifu->AgregarCampoTexto('ret_det', 'Detalle|left', false, '', 150, 200);
                        $ifu->AgregarCampoTexto('cta_deb', 'Debito|left', false, '', 50, 200);
                        $ifu->AgregarCampoTexto('cta_cre', 'Credito|left', false, '', 50, 200);
                        $ifu->AgregarCampoTexto('tipo', 'tipo|left', false, '', 50, 200);
                        
                        // CUENTAS DASI
						$ifu->AgregarCampoOculto('cod_cta', '');
						
                        $ifu->AgregarCampoTexto('nom_cta', 'Nombre Cta|left', false, '', 150, 200);
                        $ifu->AgregarComandoAlEscribir('nom_cta', 'auto_dasi(' . $idempresa . ', event, 1 );form1.nom_cta.value=form1.nom_cta.value.toUpperCase();');
                        $ifu->AgregarCampoNumerico('val_cta', 'Valor|left', false, '', 100, 200);
                        $ifu->AgregarCampoTexto('documento', 'Documento|left', false, '', 150, 10);

                        $ifu->cCampos["empresa"]->xValor = $idempresa;

                        $ifu->AgregarCampoLista('crdb', 'Tipo|left', false, 'auto');
                        $ifu->AgregarOpcionCampoLista('crdb','CREDITO','CR');
                        $ifu->AgregarOpcionCampoLista('crdb','DEBITO','DB');                        

                        //ASIENTO CONTABLE
                        $fu->AgregarCampoTexto('ejer_cod', 'Ejericio|left', false, '', 100, 100);
                        $fu->AgregarCampoTexto('prdo_cod', 'Periodo|left', false, '', 100, 100);

                        // CHEQUE
                        $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');
                        $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, '', 200, 150);
                        $fu->AgregarCampoTexto('cta_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
                        $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, 
                                                date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, '150');


                        // MONEDA
                        $ifu->AgregarCampoListaSQL('moneda', 'Moneda|left', "select mone_cod_mone, mone_des_mone  from saemone where mone_cod_empr = $idempresa ", true, 150,150);
                        $ifu->AgregarComandoAlCambiarValor('moneda', 'cargar_coti();');

                        $sql      = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
                        $mone_cod = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
                        $ifu->cCampos["moneda"]->xValor = $mone_cod;

                        $ifu->AgregarCampoNumerico('cotizacion', 'Cotizacion|left', false, 1, 50, 9);
						
                        $ifu->AgregarCampoNumerico('cotizacion_ret', 'Cotizacion|left', false, 1, 50, 9);
						
						$ifu->AgregarCampoTexto('detalla_diario', 'Detalle|left', false, '', 170, 200);
						
						$ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", true, 150,150);
																						
						// CENTRO COSTOS 
						$ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", false, 150,150);

						// CENTRO DE ACTIVIDAD
						$ifu->AgregarCampoListaSQL('actividad', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 150,150);
																								
						
	
						$ifu->AgregarCampoLista('ccli', 'SubCliente|left', false, 170,150);
		break;                
        case 'tran':
                        
                        $ifu->AgregarCampoListaSQL('empresa','Empresa|left',"SELECT EMPR_COD_EMPR, EMPR_NOM_EMPR FROM SAEEMPR ORDER BY 2",true,170,150);                        
                        $ifu->AgregarComandoAlCambiarValor('empresa', 'cargar_sucu();');
                        $ifu->AgregarCampoListaSQL('sucursal', 'Sucursal|left', "select sucu_cod_sucu, sucu_nom_sucu from saesucu where
                                                                                        sucu_cod_empr = $idempresa order by 1 ", true, 170,150); 
                        $ifu->AgregarComandoAlCambiarValor('sucursal', 'cargar_tran();');
                        $ifu->AgregarCampoListaSQL('tipo_doc', 'Tipo Documento|left', "select tidu_cod_tidu, 
                                                                                            tidu_des_tidu
                                                                                            from saetidu where
                                                                                            tidu_cod_empr = $idempresa and
                                                                                            tidu_cod_modu = 5 and
                                                                                            tidu_tip_tidu = 'IN' ", true, 150,150);
                        $ifu->AgregarCampoFecha('fecha', 'Fecha Registro Contable|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoTexto('ruc', 'Ruc|left', true, '', 100, 120);
                        $ifu->AgregarCampoTexto('cliente_nombre', 'Beneficiario|left', true, '', 350, 200);
                        $ifu->AgregarComandoAlEscribir('cliente_nombre', 'autocompletar(' . $idempresa . ', event, 0 );form1.cliente_nombre.value=form1.cliente_nombre.value.toUpperCase();');
                        $ifu->AgregarCampoTexto('cliente', 'Cliente|left', true, '', 50, 50);
                        $ifu->AgregarComandoAlPonerEnfoque('cliente', 'this.blur()');
                        $ifu->AgregarComandoAlCambiarValor('cliente', 'cargar_datos()');
                        
                        $ifu->AgregarCampoListaSQL('empleado', 'Cobrador|left', "select empl_cod_empl, empl_ape_nomb from saeempl where
                                                                                        empl_cod_empr = $idempresa and
                                                                                        empl_cod_eemp = 'A' order by 2 ", true, 170,150);
                        $ifu->AgregarCampoNumerico('valor', 'Valor|left', true, 0, 150, 150);
                        $ifu->AgregarCampoListaSQL('formato', 'Formato|left', "select ftrn_cod_ftrn, ftrn_des_ftrn from saeftrn where
                                                                                                ftrn_cod_empr = $idempresa and
                                                                                                ftrn_cod_modu = 3 and
                                                                                                ftrn_tip_movi = 'IN' ", true, 150,150);
                        $ifu->AgregarCampoLista('deas', 'Deas|left', false, 170,150);
                        $sql = "select deas_cod_deas,  saedeas.deas_des_deas from saedeas order by 2";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $ifu->AgregarOpcionCampoLista('deas',$oIfx->f('deas_cod_deas').' '.$oIfx->f('deas_des_deas'),$oIfx->f('deas_cod_deas'));
                                }while($oIfx->SiguienteRegistro());
                            }
                        }
						$oIfx->Free();
                        
                        $ifu->AgregarCampoTexto('detalle', 'Detalle|left', true, '', 550, 200);
                        $ifu->AgregarComandoAlEscribir('detalle', 'cargar_detalle();');
                        $ifu->AgregarCampoTexto('asto_cod', 'Asiento|left', false, '', 120, 120);
                        $ifu->AgregarCampoTexto('compr_cod', 'Comprobante N.-|left', false, '', 120, 120);
                        $ifu->AgregarComandoAlPonerEnfoque('asto_cod', 'this.blur()');
                        $ifu->AgregarComandoAlPonerEnfoque('compr_cod', 'this.blur()');
                        
                        // DIRECTORIO
                        $ifu->AgregarCampoTexto('clpv_nom', 'Cliente - Proveedor|left', false, '', 200, 200);
                        $ifu->AgregarComandoAlEscribir('clpv_nom', 'autocompletar(' . $idempresa . ', event, 1 );form1.clpv_nom.value=form1.clpv_nom.value.toUpperCase();');
						
                        $ifu->AgregarCampoOculto('clpv_cod', '');
						
                        $ifu->AgregarComandoAlPonerEnfoque('clpv_cod', 'this.blur()');
                        $ifu->AgregarCampoLista('tran', 'Tipo|left', false, 170,150);     
                        $sql = "select tran_cod_tran, tran_des_tran, trans_tip_tran from saetran where
                                    tran_cod_empr = $idempresa and
                                    tran_cod_sucu = $idsucursal and
                                    tran_cod_modu = 4 order by 2 ";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $tran_des = $oIfx->f('tran_cod_tran') .' || '.$oIfx->f('tran_des_tran').' || '.$oIfx->f('trans_tip_tran');
                                    $ifu->AgregarOpcionCampoLista('tran',$tran_des,$oIfx->f('tran_cod_tran')); 
                                }while($oIfx->SiguienteRegistro());
                            }
                        }
						$oIfx->Free();
						
                        $ifu->AgregarCampoTexto('factura', 'Factura|left', false, '', 140, 200);
                        $ifu->AgregarComandoAlEscribir('factura', 'facturas(' . $idempresa . ', event );');
						
                        $ifu->AgregarCampoNumerico('fact_valor', 'Valor|left', false, 0, 50, 100);
                        $ifu->AgregarCampoTexto('det_dir', 'Detalle|left', false, '', 200, 100);                        
                        
                        // RETENCION
                        $ifu->AgregarCampoTexto('cod_ret', 'Cta Ret.|left', false, '', 90, 9);
                        $ifu->AgregarComandoAlEscribir('cod_ret', 'cod_retencion(' . $idempresa . ', event );');
						
                        $ifu->AgregarCampoTexto('fact_ret', 'Factura|left', false, '', 150, 200);
                        $ifu->AgregarComandoAlEscribir('fact_ret', 'fact_retencion(' . $idempresa . ', event );');
                        $ifu->AgregarCampoTexto('ret_clpv', 'Ret. Cliente|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_porc', 'Porc.(%)|left', false, '', 50, 50);
                        $ifu->AgregarCampoNumerico('ret_base', 'Base Imponible|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_val', 'Valor|left', false, '', 50, 200);
                        $ifu->AgregarCampoNumerico('ret_num', 'N.- Retencion|left', false, '', 100, 200);
                        $ifu->AgregarComandoAlCambiarValor('ret_num', 'numero_ret();');
                        $ifu->AgregarCampoTexto('ret_det', 'Detalle|left', false, '', 150, 200);
                        $ifu->AgregarCampoTexto('cta_deb', 'Debito|left', false, '', 50, 200);
                        $ifu->AgregarCampoTexto('cta_cre', 'Credito|left', false, '', 50, 200);
                        $ifu->AgregarCampoTexto('tipo', 'tipo|left', false, '', 50, 200);
                        
                        // CUENTAS DASI
						$ifu->AgregarCampoOculto('cod_cta', '');
						
                        $ifu->AgregarCampoTexto('nom_cta', 'Nombre Cta|left', false, '', 150, 200);
                        $ifu->AgregarComandoAlEscribir('nom_cta', 'auto_dasi(' . $idempresa . ', event, 1 );form1.nom_cta.value=form1.nom_cta.value.toUpperCase();');
                        $ifu->AgregarCampoNumerico('val_cta', 'Valor|left', false, '', 100, 200);
                        $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');


                        $ifu->cCampos["empresa"]->xValor = $idempresa;
                        $ifu->cCampos["sucursal"]->xValor = $idsucursal;

                        $ifu->AgregarCampoLista('crdb', 'Tipo|left', false, 'auto');
                        $ifu->AgregarOpcionCampoLista('crdb','CREDITO','CR');
                        $ifu->AgregarOpcionCampoLista('crdb','DEBITO','DB');
                        $ifu->AgregarCampoTexto('documento', 'Documento|left', false, '', 150, 10);


                        //ASIENTO CONTABLE
                        $fu->AgregarCampoTexto('ejer_cod', 'Ejericio|left', false, '', 100, 100);
                        $fu->AgregarCampoTexto('prdo_cod', 'Periodo|left', false, '', 100, 100);

                        // CHEQUE
                        $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');
                        $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, '', 200, 150);
                        $fu->AgregarCampoTexto('cta_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
                        $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, 
                                                date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, '150');

                        // MONEDA
                        $ifu->AgregarCampoListaSQL('moneda', 'Moneda|left', "select mone_cod_mone, mone_des_mone  from saemone where mone_cod_empr = $idempresa ", true, 150,150);
                        $ifu->AgregarComandoAlCambiarValor('moneda', 'cargar_coti();');

                        $sql      = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
                        $mone_cod = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
                        $ifu->cCampos["moneda"]->xValor = $mone_cod;

                        $ifu->AgregarCampoNumerico('cotizacion', 'Cotizacion|left', false, 1, 50, 9);
						
                        $ifu->AgregarCampoNumerico('cotizacion_ret', 'Cotizacion|left', false, 1, 50, 9);
						
						$ifu->AgregarCampoTexto('detalla_diario', 'Detalle|left', false, '', 170, 200);
						
						$ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", true, 150,150);
																						
						// CENTRO COSTOS 
						$ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", false, 150,150);

						// CENTRO DE ACTIVIDAD
						$ifu->AgregarCampoListaSQL('actividad', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2", false, 150,150);

						$ifu->AgregarCampoLista('ccli', 'SubCliente|left', false, 170,150);
						
		break;                
	}
						
        $sHtml .='<table class="table table-striped table-condensed" style="width: 100%; margin-bottom: 0px;" align="center">
                        <tr>
							<td colspan="7">
								<div class="btn-group">
									<div class="btn btn-primary btn-sm" onclick="genera_formulario();">
										<span class="glyphicon glyphicon-file"></span>
										Nuevo
									</div>
									<div class="btn btn-primary btn-sm" onclick="guardar();" id = "guardar">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										Guardar
									</div>
									<div class="btn btn-primary btn-sm" onclick="vista_previa();">
										<span class="glyphicon glyphicon-print"></span>
										Imprimir
									</div>
									<div class="btn btn-primary btn-sm" onclick="parametrosPrestamo();">
										<span class="glyphicon glyphicon-th-large"></span>
										Parametros
									</div>
									<div class="btn btn-primary btn-sm" onclick="prestamosClientes();">
										<span class="glyphicon glyphicon-usd"></span>
										Genera Prestamo
									</div>
									<div class="btn btn-primary btn-sm" onclick="prestamoAprobado();">
										<span class="glyphicon glyphicon-usd"></span>
										Prestamo Aprobado
									</div>
									<div class="btn btn-primary btn-sm" onclick="prestamo();">
										<span class="glyphicon glyphicon-usd"></span>
										Prestamo Empleado
									</div>
								</div>
                                </td>
                                <td align="right">
									<div class="btn btn-danger btn-sm" onclick="cancelar_pedido();">
										<span class="glyphicon glyphicon-remove"></span>
										Cancelar
									</div>
                                </td>
                        </tr>';
        $sHtml .= '<tr>
                       <td colspan="8" class="bg-primary" align="center">COMPROBANTE DE EGRESO</td>
                   </tr>';
		$sHtml .= '<tr>
                        <td colspan="7" align="center">
							Asiento Contable '.$ifu->ObjetoHtml('asto_cod').'
							Comprobante '.$ifu->ObjetoHtml('compr_cod').'
					    </td>
					    <td>
							Fecha Registro Contable 
							<input type="date" name="fecha" step="1" value="'.$diaHoy.'" onchange="controlPeriodoIfx()">
						</td>
                   </tr>';		   
				   
        $sHtml .= '<tr>
						<td>'.$ifu->ObjetoHtmlLBL('empresa').'</td> 
						<td>'.$ifu->ObjetoHtml('empresa').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('sucursal').'</td>
						<td>'.$ifu->ObjetoHtml('sucursal').'</td>     
						<td>'.$ifu->ObjetoHtmlLBL('tipo_doc').'</td>
						<td>'.$ifu->ObjetoHtml('tipo_doc').'</td>   
						<td>'.$ifu->ObjetoHtmlLBL('moneda').'</td>
						<td>'.$ifu->ObjetoHtml('moneda').'</td>  
                   </tr>';
		$sHtml .= '<tr>
						<td>'.$ifu->ObjetoHtmlLBL('cliente_nombre').'</td> 
						<td colspan="3">'.$ifu->ObjetoHtml('cliente_nombre').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('empleado').'</td>
						<td>'.$ifu->ObjetoHtml('empleado').'</td> 
						<td>'.$ifu->ObjetoHtmlLBL('deas').'</td>
						<td>'.$ifu->ObjetoHtml('deas').'</td>             
                   </tr>';
		$sHtml .= '<tr>
						<td>'.$ifu->ObjetoHtmlLBL('detalle').'</td> 
						<td colspan="3">'.$ifu->ObjetoHtml('detalle').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('valor').'</td>
						<td>'.$ifu->ObjetoHtml('valor').'</td> 
						<td>'.$ifu->ObjetoHtmlLBL('formato').'</td>
						<td>'.$ifu->ObjetoHtml('formato').'</td>             
                   </tr>';
		$sHtml .= '<tr>
						<td colspan="8" style="display:none;">'.$ifu->ObjetoHtml('cliente').'' . $fu->ObjetoHtml('ejer_cod') . '' . $fu->ObjetoHtml('prdo_cod') . '</td>           
                   </tr>';
        $sHtml .= '</table>';
        
        
        // DIRECTORIO
        $sHtml_dir .= '<table  class="table table-striped table-condensed" style="margin-bottom: 0px;  align="center">';        
        $sHtml_dir .= '<tr>
						<td>'.$ifu->ObjetoHtmlLBL('clpv_nom').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('ccli').'</td>
						<td >'.$ifu->ObjetoHtmlLBL('tran').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('det_dir').'</td>	
						<td>'.$ifu->ObjetoHtmlLBL('factura').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('cotizacion').'</td>
						<td>'.$ifu->ObjetoHtmlLBL('fact_valor').'</td> 
						<td align="center"></td>
					</tr>';
	
		$sHtml_dir .= '<tr>
						<td>'.$ifu->ObjetoHtml('clpv_nom').''.$ifu->ObjetoHtml('clpv_cod').'</td>
						<td>'.$ifu->ObjetoHtml('ccli').'</td>
						<td >'.$ifu->ObjetoHtml('tran').'</td>
						<td>'.$ifu->ObjetoHtml('det_dir').'</td>  	
						<td>'.$ifu->ObjetoHtml('factura').'</td>
						<td>'.$ifu->ObjetoHtml('cotizacion').'</td>
						<td>'.$ifu->ObjetoHtml('fact_valor').'</td>  
						<td align="center">
							<div class="btn btn-success btn-sm" onclick="anadir_dir();">
								<span class="glyphicon glyphicon-plus"></span>
								Agregar
							</div>
						
						</td>
					</tr>';
					
					
		$sHtml_dir .= '</table>';
                
        // RETENCION
        $sHtml_ret .= '<table class="table table-striped table-condensed" style="width: 100%; margin-bottom: 0px;" align="center">';
        $sHtml_ret .= '<tr>
							<td>'.$ifu->ObjetoHtmlLBL('cod_ret').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('cotizacion_ret').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('fact_ret').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('ret_clpv').'</td>  
							<td>'.$ifu->ObjetoHtmlLBL('ret_porc').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('ret_base').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('ret_num').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('ret_det').'</td>
							<td style="display:none">'.$ifu->ObjetoHtml('cta_deb').'</td>
							<td style="display:none">'.$ifu->ObjetoHtml('cta_cre').'</td>
							<td style="display:none">'.$ifu->ObjetoHtml('tipo').'</td>
							<td align="center"></td>
                   </tr>';
				   
		$sHtml_ret .= '<tr>
							<td>'.$ifu->ObjetoHtml('cod_ret').'</td> 
							<td>'.$ifu->ObjetoHtml('cotizacion_ret').'</td>
							<td>'.$ifu->ObjetoHtml('fact_ret').'</td>
							<td>'.$ifu->ObjetoHtml('ret_clpv').'</td>    
							<td>'.$ifu->ObjetoHtml('ret_porc').'</td>
							<td>'.$ifu->ObjetoHtml('ret_base').'</td>
							<td>'.$ifu->ObjetoHtml('ret_num').'</td>
							<td>'.$ifu->ObjetoHtml('ret_det').'</td>
							<td style="display:none">'.$ifu->ObjetoHtml('cta_deb').'</td>
							<td style="display:none">'.$ifu->ObjetoHtml('cta_cre').'</td>
							<td style="display:none">'.$ifu->ObjetoHtml('tipo').'</td>
							<td align="center">
								<div class="btn btn-success btn-sm" onclick="anadir_ret();">
									<span class="glyphicon glyphicon-plus"></span>
									Agregar
							</div>
							</td>
                   </tr>';
				   
				   
				   
				   
		$sHtml_ret .='</table>';
        
        // CUENTA DASI
        $sHtml_dasi .= '<table class="table table-striped table-condensed" style="width: 100%; margin-bottom: 0px;" align="center">';
        $sHtml_dasi .= '<tr>
							<td align="center"></td> 
							<td>'.$ifu->ObjetoHtmlLBL('nom_cta').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('val_cta').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('documento').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('crdb').'</td>
							<td>'.$ifu->ObjetoHtmlLBL('detalla_diario').'</td>
							
							<td>'.$ifu->ObjetoHtmlLBL('ccosn').'</td>
							
							<td>'.$ifu->ObjetoHtmlLBL('actividad').'</td>
							
							<td align="center"></td>
						</tr>';    
						
		$sHtml_dasi .= '<tr>
							<td align="center">
								<div class="btn btn-success btn-sm" onclick="cheque();">
									<span class="glyphicon glyphicon-pencil"></span>
									Cheque
								</div>
							</td> 
							<td>'.$ifu->ObjetoHtml('nom_cta').''.$ifu->ObjetoHtml('cod_cta').'</td>
							<td>'.$ifu->ObjetoHtml('val_cta').'</td> 
							<td>'.$ifu->ObjetoHtml('documento').'</td> 
							<td>'.$ifu->ObjetoHtml('crdb').'</td> 
							<td>'.$ifu->ObjetoHtml('detalla_diario').'</td>
							<td>'.$ifu->ObjetoHtml('ccosn').'</td>
							<td>'.$ifu->ObjetoHtml('actividad').'</td>
							
							<td align="center">
								<div class="btn btn-success btn-sm" onclick="anadir_dasi();">
									<span class="glyphicon glyphicon-plus"></span>
									Agregar
								</div>
							</td>
						</tr>';   
						
						
		$sHtml_dasi .='</table>';
        
        
    $oReturn->assign("divFormularioCabecera","innerHTML",$sHtml);
    $oReturn->assign("divFormDir","innerHTML",$sHtml_dir);
    $oReturn->assign("divFormRet","innerHTML",$sHtml_ret);
    $oReturn->assign("divFormDiario","innerHTML",$sHtml_dasi);
    $oReturn->assign("factura","placeholder","F4 o Enter");
	$oReturn->assign("factura","placeholder","F4 o Enter");
    $oReturn->assign("cliente_nombre", "placeholder", "DIGITE CLIENTE Y PRESIONE ENTER PARA BUSCAR");
        
	return $oReturn;
}

// FACTURAS
function reporte_facturas( $idempresa, $idsucursal, $clpv_cod, $factura, $tran_clpv, $det ){
	//Definiciones
	global $DSN_Ifx;

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
    $oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
        
    $ifu = new Formulario;
	$ifu->DSN=$DSN;
        
    $oReturn = new xajaxResponse();
    unset($_SESSION['U_FACTURA']);   
            
        //  LECTURA SUCIA
        //////////////
        
        // CUENTAS DE CLPV
        $sql = "select clpv_cod_cuen, grpv_cod_grpv from saeclpv where clpv_cod_empr = $idempresa and clpv_cod_clpv = $clpv_cod ";
        $clpv_cuen = consulta_string_func($sql, 'clpv_cod_cuen', $oIfx, '');
        if(empty($clpv_cuen)){
            $clpv_gr = consulta_string_func($sql, 'grpv_cod_grpv', $oIfx, '');
            $sql = "select  grpv_cta_grpv  from saegrpv where
                        grpv_cod_empr = $idempresa and
                        grpv_cod_grpv = '$clpv_gr' ";
            $clpv_cuen = consulta_string_func($sql, 'grpv_cta_grpv', $oIfx, '');
        }
        
        // NOMBRE CUENtA
        $sql = "select cuen_nom_cuen from saecuen where 
                    cuen_cod_empr = $idempresa and
                    cuen_cod_cuen = '$clpv_cuen' ";
        $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
        
        $ifu->AgregarCampoCheck('check', '', true, 'N');
        $ifu->AgregarComandoAlCambiarValor('check', "cargar_tot();");

		// TRANSACCIONAL
		$sql = "select trim(para_fac_cxp) as tran  from saepara where para_cod_empr = $idempresa and para_cod_sucu = $idsucursal ";	
		$tran_cod = consulta_string_func($sql, 'tran', $oIfx, '');		
		

        $sql = "select sucu_cod_sucu, sucu_nom_sucu from saesucu where sucu_cod_empr = $idempresa ";
        unset($array_sucu);
		$array_sucu = array_dato($oIfx, $sql, 'sucu_cod_sucu', 'sucu_nom_sucu');

        $table_op .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">';
        $table_op .='<legend class="Titulo">FACTURAS</legend>';
        $table_op .='<table align="center" border="0" cellpadding="2" cellspacing="1" width="99%" class="footable">'; 
        $table_op .='<tr>
                            <th class="diagrama" colspan="5"></th>
                            <th class="diagrama" colspan="4" align="right">
                                <input type="button" value="ACEPTAR"
                                    onClick="javascript: cargar();"
                                    id="BuscaBtn" class="myButton_BT"
                                    style="width:80px; height:25px;" />
                            </th>
                     </tr>';
        $table_op .='<tr>
                            <th class="diagrama">N.-</th>
                            <th class="diagrama">Sucursal</th>
                            <th class="diagrama">Tran</th>
                            <th class="diagrama">Factura</th>
                            <th class="diagrama">F. Emision</th>
                            <th class="diagrama">F. Vence</th>                            
                            <th class="diagrama" style="display:none">Valor Rete.</th>
                            <th class="diagrama">Saldo</th>
                            <th class="diagrama"><input type="checkbox" name="check" value="S" onchange="cargar_tot();"></th>
                            <th class="diagrama"></th> 
                     </tr>';
        
        //$sql_sp = "execute  procedure sp_consulta_factprove_web( $idempresa, $idsucursal , $clpv_cod, '$factura' )";
		$sql_sp = "select dmcp_cod_sucu, dmcp_num_fac,  min(dcmp_fec_emis) as dcmp_fec_emis, max(dmcp_fec_ven) as dmcp_fec_ven, 
					   MAX((select sum(COALESCE(dcmp_deb_ml,0) - COALESCE(dcmp_cre_ml,0))
								from saedmcp y	where 
								y.dmcp_cod_empr = saedmcp.dmcp_cod_empr and 
								y.clpv_cod_clpv = saedmcp.clpv_cod_clpv and
								y.dmcp_num_fac  = saedmcp.dmcp_num_fac)) saldo
						from saedmcp WHERE 
						dmcp_cod_empr = $idempresa 	AND 
						clpv_cod_clpv = $clpv_cod	AND 
						-- dmcp_cod_sucu = $idsucursal and
						dmcp_est_dcmp <>'AN'  AND
						saedmcp.dmcp_num_fac in ( select trim(dmcp_num_fac) from saedmcp  WHERE 
													dmcp_cod_empr   = $idempresa AND 
													clpv_cod_clpv   = $clpv_cod and
													dcmp_fec_emis  <= today group by dmcp_num_fac
													having sum(dcmp_deb_ml) - sum(dcmp_cre_ml) <> 0 
												)
						group by dmcp_cod_sucu, dmcp_num_fac							
						having  sum(dcmp_deb_ml) - sum(dcmp_cre_ml) <> 0     
						ORDER BY dmcp_num_fac ";
						
						//$oReturn->alert($sql_sp);
        unset($array); 
        $total   = 0;
        $i       = 1;
        $tot_ret = 0;
		//$oReturn->alert($sql_sp);
        if($oIfx->Query( $sql_sp )){
             if($oIfx->NumFilas()>0){
                do{
                        $tran     = $tran_cod;
			            $fact_num = $oIfx->f('dmcp_num_fac');
                        $fec_emis = fecha_mysql_funcYmd($oIfx->f('dcmp_fec_emis'));
                        $fec_venc = fecha_mysql_funcYmd($oIfx->f('dmcp_fec_ven')); 
                        $saldo    = abs($oIfx->f('saldo')); 
                        $saldo_condicion    = $oIfx->f('saldo'); 
						//echo $saldo;exit;
                        $ret      = $oIfx->f('ret'); 
                        $sucu_nom = $array_sucu[$oIfx->f('dmcp_cod_sucu')]; 
						$bgcolor='';
                        if($saldo_condicion>0){
							$tran='';
							
						}
                        
                        $ifu->AgregarCampoNumerico($i, '', false, 0, 80, 50);
                        $ifu->AgregarComandoAlCambiarValor($i, "xajax_calculo( xajax.getFormValues('form1')) ");
                        
                        $array [$i] = array($i,         $fact_num,      $fec_emis,      $fec_venc, 
                                            $saldo,     $idempresa,     $idsucursal,    $clpv_cod,     
                                            $tran_clpv, $det,           $clpv_cuen,     $cuen_nom );
                        
                        if ($sClass=='off') $sClass='on'; else $sClass='off';
						if($saldo_condicion>0){
							$table_op.='<tr bgcolor="yellow">';
						}
						else{
							$table_op .='<tr  height="20" class="'.$sClass.'"
                                            onMouseOver="javascript:this.className=\'link\';"
                                            onMouseOut="javascript:this.className=\''.$sClass.'\';">';
						}
                        
                        $table_op .='<td align="right">'.$i.'</td>';
                        $table_op .='<td align="left">'.$sucu_nom.'</td>';
                        $table_op .='<td align="right">'.$tran.'</td>';
                        $table_op .='<td align="right">'.$fact_num.'</td>';
                        $table_op .='<td align="right">'.$fec_emis.'</td>';
                        $table_op .='<td align="right">'.$fec_venc.'</td>';                        
                        $table_op .='<td align="right" style="display:none">'.$ret.'</td>';
                        $table_op .='<td align="right">'.$saldo.'</td>';
						if($saldo_condicion<0){
							$table_op .='<td align="right">'.$ifu->ObjetoHtml($i).'</td>';
							$table_op .='<td align="right">
                                            <input type="button" value=".."
                                                    onClick="javascript:valor_fact(  \''.$i.'\' , \''.$saldo.'\'   )"
                                                    id="BuscaBtn" class="myButton_BT"
                                                    style="width:25px; height:18px;" />
                                     </td>';
						}
						else{
							$table_op.='<td colspan="2">VALOR A CRUZAR CON FACTURAS</td>';
							
						}
                        
                        $table_op .='</tr>';
                        $i++;                      
                        $total   += $saldo;
                        $tot_ret += $ret;
                }while($oIfx->SiguienteRegistro());     
                        $table_op .='<tr height="20" class="'.$sClass.'"
                                            onMouseOver="javascript:this.className=\'link\';"
                                            onMouseOut="javascript:this.className=\''.$sClass.'\';">';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right" class="fecha_letra">TOTAL:</td>';
                        $table_op .='<td align="right" class="fecha_letra" style="display:none">'.$tot_ret.'</td>';
                        $table_op .='<td align="right" class="fecha_letra">'.$total.'</td>';                        
                        $table_op .='<td align="right" class="letra_rojo" id="tot_cobro">0.00</td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='</tr>';
             }else{
                 $table_op = '<span class="fecha_letra">Sin Datos...</span>';
             }
        }
        $oIfx->Free();
        $table_op .= '</table></fieldset>';
                        
        $_SESSION['U_FACTURA'] = $array;
        
	$oReturn->assign("divFormularioDetalle","innerHTML",$table_op);

	return $oReturn;
}

// CALCULO
function calculo( $aForm ){
	//Definiciones
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
    $oReturn = new xajaxResponse();
    $array = $_SESSION['U_FACTURA']; 
    
    if(count($array)>0){
        $total = 0;
        foreach ($array as $val){
            $id     = $val[0];
            $txt    = abs($aForm[$id]);
            $total += $txt;
        }
    }
	$oReturn->assign("tot_cobro","innerHTML",$total);

	return $oReturn;
}

function cargar_tot( $aForm ){
    //Definiciones
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
    $oReturn = new xajaxResponse();
    $array = $_SESSION['U_FACTURA']; 
    $check = $aForm['check']; 

    if(count($array)>0){
        $total = 0;

        if(!empty($check)){
            foreach ($array as $val){
                $id    = $val[0];
                $valor = $val[4];

                $oReturn->assign($id,"value",$valor);
                $total += $valor;
            }
        }else{
            foreach ($array as $val){
                $id    = $val[0];
                $oReturn->assign($id,"value",0);
            }
        }
    }
    $oReturn->assign("tot_cobro","innerHTML",$total);

    return $oReturn;
}

// FACTURAS
function reporte_facturas_ret( $idempresa, $idsucursal, $clpv_cod, $factura ){
	//Definiciones
	global $DSN_Ifx;

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
        $oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
        
        $oIfxA = new Dbo;
	$oIfxA -> DSN = $DSN_Ifx;
	$oIfxA -> Conectar();
        
        $ifu = new Formulario;
	$ifu->DSN=$DSN;
        
        $oReturn = new xajaxResponse();   
                
        //  LECTURA SUCIA
        //////////////
        
        $table_op .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">';
        $table_op .='<legend class="Titulo">FACTURAS</legend>';
        $table_op .='<table align="center" border="0" cellpadding="2" cellspacing="1" width="99%" class="footable">'; 
        $table_op .='<tr>
                            <th class="diagrama">N.-</th>
                            <th class="diagrama">Tran</th>
                            <th class="diagrama">Factura</th>
                            <th class="diagrama">F. Emision</th>
                            <th class="diagrama">F. Vence</th>
                            <th class="diagrama">Saldo</th>
                            <th class="diagrama" style="display:none">Valor Rete.</th>
                     </tr>';
        
        $sql_sp = "execute  procedure sp_consulta_factprove_web( $idempresa, $idsucursal , $clpv_cod, '$factura' )";
        unset($array); 
        $total   = 0;
        $i       = 1;
        $tot_ret = 0;
        if($oIfx->Query( $sql_sp )){
             if($oIfx->NumFilas()>0){
                do{
                        $tran     = $oIfx->f('tran');
			            $fact_num = $oIfx->f('factura');
                        $fec_emis = fecha_mysql_funcYmd($oIfx->f('fec_emis'));
                        $fec_venc = fecha_mysql_funcYmd($oIfx->f('fec_ven')); 
                        $saldo    = $oIfx->f('saldo_local'); 
                        $ret      = $oIfx->f('ret');                        
                        
                        // BASE IMPONIBLE
                        list($a,$b,$c) = explode('-', $fact_num);
                        $sql = "select  ( fact_con_miva + fact_sin_miva + fact_fle_fact  +  fact_otr_fact + fact_fin_fact ) as total  
                                    from saefact where
                                    fact_cod_clpv   = $clpv_cod and
                                    fact_num_preimp = '$b' and
                                    fact_cod_empr   = $idempresa and 
                                    fact_cod_sucu = $idsucursal ";
                        $base = consulta_string_func($sql, 'total', $oIfxA, 0);
                        
                        if ($sClass=='off') $sClass='on'; else $sClass='off';
                        $table_op .='<tr height="20" class="'.$sClass.'"
                                            onMouseOver = "javascript:this.className=\'link\';"
                                            onMouseOut  = "javascript:this.className=\''.$sClass.'\';" 
                                            onclick     = "cargar_fact(\''.$fact_num.'\', \''.$base.'\');">';
                        $table_op .='<td align="right">'.$i.'</td>';
                        $table_op .='<td align="right">'.$tran.'</td>';
                        $table_op .='<td align="right">'.$fact_num.'</td>';
                        $table_op .='<td align="right">'.$fec_emis.'</td>';
                        $table_op .='<td align="right">'.$fec_venc.'</td>';
                        $table_op .='<td align="right">'.$saldo.'</td>';
                        $table_op .='<td align="right" style="display:none">'.$ret.'</td>';
                        $table_op .='</tr>';
                        $i++;                      
                        $total   += $saldo;
                        $tot_ret += $ret;
                }while($oIfx->SiguienteRegistro());     
                        $table_op .='<tr height="20" class="'.$sClass.'"
                                            onMouseOver="javascript:this.className=\'link\';"
                                            onMouseOut="javascript:this.className=\''.$sClass.'\';"
                                            onclick = "cargar_fact(\''.$fact_num.'\');" >';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right"></td>';
                        $table_op .='<td align="right" class="fecha_letra">TOTAL:</td>';
                        $table_op .='<td align="right" class="fecha_letra">'.$total.'</td>';
                        $table_op .='<td align="right" class="fecha_letra" style="display:none">'.$tot_ret.'</td>';
                        $table_op .='</tr>';
             }else{
                 $table_op = '<span class="fecha_letra">Sin Datos...</span>';
             }
        }
        $oIfx->Free();
        $table_op .= '</table></fieldset>';
        
	$oReturn->assign("divFormularioDetalle","innerHTML",$table_op);

	return $oReturn;
}



// DIRECTORIO
function agrega_modifica_grid_dir($nTipo=0, $aForm = '', $id='' ){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN_Ifx;

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
        
	$aDataGrid = $_SESSION['aDataGirdDir'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];
    $array     = $_SESSION['U_FACTURA'];       
    
    $aLabelGrid = array('Fila', 'Cliente', 'Tipo', 'Factura', 'Fec. Vence', 'Detalle', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar' );
	
    $aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad' );   
        
        
	$oReturn = new xajaxResponse();

        // VARIABLES
        $tran_cod = $aForm["tran"];
        $detalle  = $aForm["det_dir"];
        
        //  LECTURA SUCIA
        //////////////
        
        if($nTipo == 0){
                if(count($array) >0){
                    $cont = 0;
                    $contd= 0;
                    foreach ( $array as $val){
                        $ix        = $val[0];
                        $fact_num  = $val[1];
                        $fec_emis  = $val[2];
                        $fec_venc  = $val[3];
                        $saldo     = abs($val[4]);
                        $idempresa = $val[5];
                        $idsucursal= $val[6];
                        $clpv_cod  = $val[7];
                        $tran_cod  = $val[8];
                        $det_dir   = $val[9];
                        $clpv_cuen = $val[10];
                        $cuen_nom  = $val[11];
                        
                        $txt      = $aForm[$ix];
                        if($txt > 0){
                            // DIRECTORIO
                            $cont = count($aDataGrid);
                            $aDataGrid[$cont][$aLabelGrid[0]]=floatval($cont);
                            $aDataGrid[$cont][$aLabelGrid[1]]=$clpv_cod;
                            $aDataGrid[$cont][$aLabelGrid[2]]=$tran_cod;
                            $aDataGrid[$cont][$aLabelGrid[3]]=$fact_num;
                            $aDataGrid[$cont][$aLabelGrid[4]]=$fec_venc;
                            $aDataGrid[$cont][$aLabelGrid[5]]=$det_dir;
                            $aDataGrid[$cont][$aLabelGrid[6]]=1;
                            $aDataGrid[$cont][$aLabelGrid[7]]=$txt;
                            $aDataGrid[$cont][$aLabelGrid[8]]=0;
                            $aDataGrid[$cont][$aLabelGrid[9]]='';
                            $aDataGrid[$cont][$aLabelGrid[10]]='';
                            
                            // DIARIO
                            $contd = count($aDataDiar);
                            $aDataDiar[$contd][$aLabelDiar[0]]=floatval($contd);
                            $aDataDiar[$contd][$aLabelDiar[1]]=$clpv_cuen;
                            $aDataDiar[$contd][$aLabelDiar[2]]=$cuen_nom;
                            $aDataDiar[$contd][$aLabelDiar[3]]=$doc;
                            $aDataDiar[$contd][$aLabelDiar[4]]=1;
                            $aDataDiar[$contd][$aLabelDiar[5]]=$txt;
                            $aDataDiar[$contd][$aLabelDiar[6]]=0;
                            $aDataDiar[$contd][$aLabelDiar[7]]='';
                            $aDataDiar[$contd][$aLabelDiar[8]]='';
							$aDataDiar[$contd][$aLabelDiar[9]]='';
							$aDataDiar[$contd][$aLabelDiar[10]]='';
							$aDataDiar[$contd][$aLabelDiar[11]]='';
							$aDataDiar[$contd][$aLabelDiar[12]]='';
							$aDataDiar[$contd][$aLabelDiar[13]]='';
							$aDataDiar[$contd][$aLabelDiar[14]]='';
							$aDataDiar[$contd][$aLabelDiar[15]]=$det_dir;
							$aDataDiar[$contd][$aLabelDiar[16]]='';
							$aDataDiar[$contd][$aLabelDiar[17]]='';
                            
                        }
                    }// fin foreach
                }// fin if
                
        }

        $_SESSION['aDataGirdDir'] = $aDataGrid;
        $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
        $oReturn->assign("divDir","innerHTML",$sHtml);
        
        // DIARIO
        $sHtml = '';
        $_SESSION['aDataGirdDiar'] = $aDataDiar;
        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario","innerHTML",$sHtml);
        
        // TOTAL DIARIO
        $oReturn->script("total_diario();");
        
        $oReturn->script("cerrar_ventana();");
	return $oReturn;
}

// DIRECTRIO SIN FACTURA
function agrega_modifica_grid_dir_ori($nTipo=0, $aForm = '', $id='' ){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN_Ifx;

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
        
	$aDataGrid = $_SESSION['aDataGirdDir'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];     
	
	
	$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad'	);   
	
        
    $aLabelGrid = array('Id', 'Cliente', 'Tipo', 'Factura', 'Fec. Vence', 'Detalle', 'Cotizacion', 'Debito Moneda Local', 'Credito Moneda Local', 
    					'Debito Moneda Ext', 'Credito Moneda Ext', 'Modificar', 'Eliminar');
    //$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar' );
    /*$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito Moneda Local', 'Credito Moneda Local', 
    					'Debito Moneda Ext', 'Credito Moneda Ext', 'Modificar', 'Eliminar' );
    */
	
	$oReturn = new xajaxResponse();

	// VARIABLES
	$tran_cod   = $aForm["tran"];
	$detalle    = $aForm["det_dir"];	
	$doc        = $aForm["documento"];
	$idsucursal = $aForm["sucursal"];
	$ccosn_cod  = $aForm["ccosn"];
	$act_cod    = $aForm["actividad"];
	
	
	if(empty($idempresa)){
		$idempresa = $aForm["empresa"];
	}
	
	if(empty($mone_cod)){
		$mone_cod = $aForm["moneda"];
	}

	$sql      = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
	$mone_base= consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
	
	if($mone_cod==$mone_base){
		$sql      = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
		$mone_extr= consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

		$sql = "select tcam_val_tcam from saetcam where
				mone_cod_empr = $idempresa and
				tcam_cod_mone = $mone_extr and
				tcam_fec_tcam in (
									select max(tcam_fec_tcam)  from saetcam where
											mone_cod_empr = $idempresa and
											tcam_cod_mone = $mone_extr
								)  ";

		$coti = consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);

	}

	//$oReturn->alert($coti);


	//  LECTURA SUCIA
	//////////////
	
	if($nTipo==0){
				$cont = 0;
				$contd= 0;
					$ix        = $val[0];
					$fact_num  = $aForm['factura'];
					$fec_emis  = $aForm['fecha'];
					$fec_venc  = $aForm['fecha'];
					//$saldo     = $val[4];
					//$idempresa = $val[5];
					//$idsucursal= $val[6];
					$clpv_cod  = $aForm['clpv_cod'];
					$tran_cod  = $aForm['tran'];
					$det_dir   = $aForm['det_dir'];
					//$clpv_cuen = $val[10];
					//$cuen_nom  = $val[11];

					$sql = "select tran_cod_cuen from saetran where 
								  tran_cod_tran = '$tran_cod' and 
								  tran_cod_modu = 4 and
								  tran_cod_sucu = $idsucursal and
								  tran_cod_empr = $idempresa and
								( tran_ant_tran = 1 or 
								  tran_cie_tran = 1   
								) ";
					$clpv_cuen = consulta_string_func($sql, 'tran_cod_cuen', $oIfx, '');
					//$oReturn->alert($clpv_cuen);
					
					// CUENTAS DE CLPV
			        $sql       = "select clpv_cod_cuen, grpv_cod_grpv, clpv_clopv_clpv from saeclpv where clpv_cod_empr = $idempresa and clpv_cod_clpv = $clpv_cod ";			        
			        $tipo      = consulta_string_func($sql, 'clpv_clopv_clpv', $oIfx, '');
					
					if(empty($clpv_cuen)){						
						$clpv_cuen = consulta_string_func($sql, 'clpv_cod_cuen', $oIfx, '');		
						if(empty($clpv_cuen)){
							$clpv_gr = consulta_string_func($sql, 'grpv_cod_grpv', $oIfx, '');
							$sql = "select  grpv_cta_grpv  from saegrpv where
										grpv_cod_empr = $idempresa and
										grpv_cod_grpv = '$clpv_gr' ";
							$clpv_cuen = consulta_string_func($sql, 'grpv_cta_grpv', $oIfx, '');
						}
			        }
					
			        // NOMBRE CUENtA
			        $sql = "select cuen_nom_cuen from saecuen where 
			                    cuen_cod_empr = $idempresa and
			                    cuen_cod_cuen = '$clpv_cuen' ";
			        $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');


					//$tipo  	   = $val[12];
					$ccli  	   = $aForm['ccli'];
					
					$txt  = abs($aForm['fact_valor']);
				
						
						$valDirCre = 0;
						$valDiaCre = 0;
						$valDirDeb = 0;
						$valDiaDeb= 0;
						
						if($tipo == 'CL'){
							$modulo = 3;
						}elseif($tipo == 'PV'){
							$modulo = 4;
						}
						
						//tipo de transaccion
						$sql = "select trans_tip_tran from saetran where tran_cod_tran = '$tran_cod' and tran_cod_modu = $modulo and tran_cod_empr = $idempresa ";
						$trans_tip_tran = consulta_string($sql, 'trans_tip_tran', $oIfx, '');
						
						//$oReturn->alert($sql);
						
						if($trans_tip_tran == 'DB'){
							$valDirDeb = $txt;
							$valDiaDeb= $txt;
						}elseif($trans_tip_tran == 'CR'){
							$valDirCre = $txt;
							$valDiaCre = $txt;
						}
						
						// DIRECTORIO
						$cont = count($aDataGrid);
						$aDataGrid[$cont][$aLabelGrid[0]] = floatval($cont);
						$aDataGrid[$cont][$aLabelGrid[1]] = $clpv_cod;
						$aDataGrid[$cont][$aLabelGrid[2]] = $tran_cod;
						$aDataGrid[$cont][$aLabelGrid[3]] = $fact_num;
						$aDataGrid[$cont][$aLabelGrid[4]] = $fec_venc;
						$aDataGrid[$cont][$aLabelGrid[5]] = $det_dir;
						$aDataGrid[$cont][$aLabelGrid[6]] = $coti;
						


						if($mone_cod==$mone_base){
							// moneda local
							$cre_tmp = 0;
							$deb_tmp =0;
							if($coti>0){
								$cre_tmp = round(($valDirCre/$coti),2);
							}

							if($coti>0){
								$deb_tmp = round(($valDirDeb/$coti),2);
							}

							$aDataGrid[$cont][$aLabelGrid[7]] = $valDirDeb;
							$aDataGrid[$cont][$aLabelGrid[8]] = $valDirCre;
							$aDataGrid[$cont][$aLabelGrid[9]] = $deb_tmp;
							$aDataGrid[$cont][$aLabelGrid[10]] = $cre_tmp;
						}else{
							// moneda extra

							$aDataGrid[$cont][$aLabelGrid[7]] = $valDirDeb*$coti;
							$aDataGrid[$cont][$aLabelGrid[8]] = $valDirCre*$coti;

							$aDataGrid[$cont][$aLabelGrid[9]] = $valDirDeb;
							$aDataGrid[$cont][$aLabelGrid[10]] = $valDirCre;
						}

						

						$aDataGrid[$cont][$aLabelGrid[11]] = '';
						$aDataGrid[$cont][$aLabelGrid[12]] = '';
						
						// DIARIO
						$contd = count($aDataDiar);
						$aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
						$aDataDiar[$contd][$aLabelDiar[1]] = $clpv_cuen;
						$aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom;
						$aDataDiar[$contd][$aLabelDiar[3]] = $doc;
						$aDataDiar[$contd][$aLabelDiar[4]] = $coti;
						

						if($mone_cod==$mone_base){
							// moneda local
							$cre_tmp = 0;
							$deb_tmp =0;
							if($coti>0){
								$cre_tmp = round(($valDirCre/$coti),2);
							}

							if($coti>0){
								$deb_tmp = round(($valDirDeb/$coti),2);
							}

							$aDataDiar[$contd][$aLabelDiar[5]] = $valDiaDeb;
							$aDataDiar[$contd][$aLabelDiar[6]] = $valDiaCre;
							//$aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
							//$aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
						}else{
							// moneda extra
							$aDataDiar[$contd][$aLabelDiar[5]] = $valDiaDeb*$coti;
							$aDataDiar[$contd][$aLabelDiar[6]] = $valDiaCre*$coti;
							//$aDataDiar[$contd][$aLabelDiar[7]] = $valDirDeb;
							//$aDataDiar[$contd][$aLabelDiar[8]] = $valDirCre;
						}

						
						$aDataDiar[$contd][$aLabelDiar[7]] = '';
						$aDataDiar[$contd][$aLabelDiar[8]] = '';
						
						$aDataDiar[$contd][$aLabelDiar[9]] = '';
						$aDataDiar[$contd][$aLabelDiar[10]] = '';
						$aDataDiar[$contd][$aLabelDiar[11]] = '';
						$aDataDiar[$contd][$aLabelDiar[12]] = '';
						$aDataDiar[$contd][$aLabelDiar[13]] = '';
						$aDataDiar[$contd][$aLabelDiar[14]] = '';
						$aDataDiar[$contd][$aLabelDiar[15]] = $det_dir;
						$aDataDiar[$contd][$aLabelDiar[16]] = $ccosn_cod;
						$aDataDiar[$contd][$aLabelDiar[17]] = $act_cod;
						
						
						/*$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle' );   
						*/
			
	}
	
	$_SESSION['aDataGirdDir'] = $aDataGrid;
	$sHtml = mostrar_grid_dir($idempresa, $idsucursal);
	$oReturn->assign("divDir","innerHTML",$sHtml);
	
	// DIARIO
	$sHtml = '';
	$_SESSION['aDataGirdDiar'] = $aDataDiar;
	$sHtml = mostrar_grid_dia($idempresa, $idsucursal);
	$oReturn->assign("divDiario","innerHTML",$sHtml);
	
	// TOTAL DIARIO
	$oReturn->script("total_diario();");
	$oReturn->script("cerrar_ventana();");
	$oReturn->assign('tran', 'value',0);
	$oReturn->assign('ccli', 'value',0);
	return $oReturn;
}

function mostrar_grid_dir($idempresa, $idsucursal){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN_Ifx;

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();

    $aDataGrid  = $_SESSION['aDataGirdDir'];
	$aLabelGrid = array('Id', 'Cliente', 'Tipo', 'Factura', 'Fec. Vence', 'Detalle', 'Cotizacion', 
                        'Debito', 'Credito', 'Modificar', 'Eliminar' );

	$cont    = 0;        
        $tot_cre = 0;
        $tot_deb = 0;
	foreach ($aDataGrid as $aValues){
		$aux     = 0;
		foreach ($aValues as $aVal){
			if ($aux == 0){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.($cont+1).'</div>';
                        }elseif ($aux==1){
                                $sql = "select  clpv_nom_clpv from saeclpv where clpv_cod_clpv = $aVal and clpv_cod_empr = $idempresa ";
                                $clpv_nom = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                                $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$clpv_nom.'</div>';
                        }elseif($aux==2){
                                $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';
                        }elseif($aux==3){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';
                        }elseif($aux==4){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';
                        }elseif($aux==5){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';
                        }elseif($aux==6){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.$aVal.'</div>';
                        }elseif($aux==7){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                                $tot_deb += $aVal;
                        }elseif($aux==8){
				$aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                                $tot_cre += $aVal;
                        }elseif($aux==9){
				$aDatos[$cont][$aLabelGrid[$aux]]= '<div align="center">
                                                                        <img src="'.$_COOKIE['JIREH_IMAGENES'].'iconos/pencil.png"
                                                                        title = "Presione aqui para Eliminar"
                                                                        style="cursor: hand !important; cursor: pointer !important;"
                                                                        onclick="javascript:xajax_elimina_detalle_dir('.$cont.');"
                                                                        alt="Eliminar"
                                                                        align="bottom" />
                                                                    </div>';
                        }elseif($aux==10){
				$aDatos[$cont][$aLabelGrid[$aux]]= '<div align="center">
                                                                        <img src="'.$_COOKIE['JIREH_IMAGENES'].'iconos/delete_1.png"
                                                                        title = "Presione aqui para Eliminar"
                                                                        style="cursor: hand !important; cursor: pointer !important;"
                                                                        onclick="javascript:xajax_elimina_detalle_dir('.$cont.', '.$idempresa.', '.$idsucursal.');"
                                                                        alt="Eliminar"
                                                                        align="bottom" />
                                                                    </div>';
                        }else
				$aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
			$aux ++;
		}
		$cont ++;
	}
        $array = array('','','','','','','',$tot_deb,$tot_cre,'','');
	return genera_grid($aDatos,$aLabelGrid,'DIRECTORIO',99, '', $array);
//        $aData = null, $aLabel = null, $sTitulo = 'Reporte', $iAncho = '400', $aAccion = null,$Totales=null, $aOrden = null
}

function elimina_detalle_dir($id=null, $idempresa, $idsucursal){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

	$oReturn = new xajaxResponse();
	
	$aLabelGrid = array('Id', 'Cliente', 'Tipo', 'Factura', 'Fec. Vence', 'Detalle', 'Cotizacion', 'Debito Moneda Local', 'Credito Moneda Local', 
    					'Debito Moneda Ext', 'Credito Moneda Ext', 'Modificar', 'Eliminar');
						
	$aDataGrid = $_SESSION['aDataGirdDir'];
	$contador = count($aDataGrid);
	if($contador>1){
        unset($aDataGrid[$id]);
        $_SESSION['aDataGirdDir']=$aDataGrid;
        $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
        $oReturn->assign("divDir","innerHTML",$sHtml);
	}else{
		unset($aDataGrid[0]);
		$_SESSION['aDataGirdDir']=$aDatos;
		$sHtml = "";
        $oReturn->assign("divDir","innerHTML",$sHtml);
	}        
        
	// DIARIO
	$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle' );   
	$aDataGrid  = $_SESSION['aDataGirdDiar'];
	$contador   = count($aDataGrid);
	if($contador>1){
			unset($aDataGrid[$id]);
			$_SESSION['aDataGirdDiar']=$aDataGrid;
			$sHtml = mostrar_grid_dia($idempresa, $idsucursal);
			$oReturn->assign("divDiario","innerHTML",$sHtml);
	}else{
			unset($aDataGrid[0]);
			$_SESSION['aDataGirdDiar']=$aDatos;
			$sHtml = "";
			$oReturn->assign("divDiario","innerHTML",$sHtml);
	}
	return $oReturn;
}




// DIARIO
function agrega_modifica_grid_dia($nTipo=0, $aForm = '', $id='' ){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN_Ifx;

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
        
    $aDataDiar = $_SESSION['aDataGirdDiar'];       
              
	$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad'		);					
	$oReturn = new xajaxResponse();

    // VARIABLES
    $cod_cta    = $aForm["cod_cta"];
    $nom_cta    = $aForm["nom_cta"];
    $val_cta    = $aForm["val_cta"];
    $idsucursal = $aForm["sucursal"];
	$detalle    = $aForm["detalla_diario"];
    $ccosn_cod  = $aForm["ccosn"];
	$act_cod    = $aForm["actividad"];
	
	
        //  LECTURA SUCIA
    //////////////

    $tipo     = $aForm['crdb'];  

    if($tipo=='CR'){
        $cred = $val_cta;
        $deb  = 0;
    }elseif($tipo=='DB'){
        $cred = 0;
        $deb  = $val_cta;
    }
    
    if($nTipo==0){
            // DIARIO
            $contd = count($aDataDiar);
            $aDataDiar[$contd][$aLabelDiar[0]]=floatval($contd);
            $aDataDiar[$contd][$aLabelDiar[1]]=$cod_cta;
            $aDataDiar[$contd][$aLabelDiar[2]]=$nom_cta;
            $aDataDiar[$contd][$aLabelDiar[3]]='';
            $aDataDiar[$contd][$aLabelDiar[4]]=1;
            $aDataDiar[$contd][$aLabelDiar[5]]=$deb;
            $aDataDiar[$contd][$aLabelDiar[6]]=$cred;
            $aDataDiar[$contd][$aLabelDiar[7]]='';
            $aDataDiar[$contd][$aLabelDiar[8]]=''; 
			$aDataDiar[$contd][$aLabelDiar[9]]=''; 
			$aDataDiar[$contd][$aLabelDiar[10]]=''; 
			$aDataDiar[$contd][$aLabelDiar[11]]=''; 
			$aDataDiar[$contd][$aLabelDiar[12]]=''; 
			$aDataDiar[$contd][$aLabelDiar[13]]=''; 
			$aDataDiar[$contd][$aLabelDiar[14]]=''; 
			$aDataDiar[$contd][$aLabelDiar[15]]=$detalle; 
			$aDataDiar[$contd][$aLabelDiar[16]]=$ccosn_cod; 
			$aDataDiar[$contd][$aLabelDiar[17]]=$act_cod; 
			//$oReturn->alert('asas');
    }
    
    // DIARIO
    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataDiar;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario", "innerHTML", $sHtml);

    $oReturn->assign("cod_cta","value",'');
    $oReturn->assign("nom_cta","value",'');
    $oReturn->assign("val_cta","value",'');
    
    // TOTAL DIARIO
    $oReturn->script("total_diario();");
        
    $oReturn->script("cerrar_ventana();");
	return $oReturn;
}

function mostrar_grid_dia($idempresa, $idsucursal){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN, $DSN_Ifx;

	$oCnx = new Dbo ( );
	$oCnx->DSN = $DSN;
	$oCnx->Conectar ();

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();

	$idempresa  = $_SESSION['U_EMPRESA'];
	$aDataGrid  = $_SESSION['aDataGirdDiar'];
	$aLabelGrid = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad');   

	$cont    = 0;
    $tot_cre = 0;
    $tot_deb = 0;
	foreach ($aDataGrid as $aValues){
		$aux =0;
		foreach ($aValues as $aVal){
			if ($aux == 0){
                        $aDatos[$cont][$aLabelGrid[$aux]]= ($cont+1);
                }elseif ($aux==1){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==2){
				        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==4){
				        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==5){
				        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                        $tot_deb += $aVal;
                }elseif($aux==6){
				        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                        $tot_cre += $aVal;
                }elseif($aux==7){
				        $aDatos[$cont][$aLabelGrid[$aux]]= '<img src="'.$_COOKIE['JIREH_IMAGENES'].'iconos/pencil.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:xajax_elimina_detalle_dia('.$cont.', '.$idempresa.', '.$idsucursal.');"
															alt="Eliminar"
															align="bottom" />';
                }elseif($aux==8){
				        $aDatos[$cont][$aLabelGrid[$aux]]= '<img src="'.$_COOKIE['JIREH_IMAGENES'].'iconos/delete_1.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:xajax_elimina_detalle_dia('.$cont.', '.$idempresa.', '.$idsucursal.');"
															alt="Eliminar"
															align="bottom" />';
                }elseif($aux==9){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==10){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==11){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==12){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==13){
                        // FORMATO
                        $sql = "select  ftrn_des_ftrn  from saeftrn where
                                    ftrn_cod_empr = $idempresa and
                                    ftrn_cod_ftrn = '$aVal'  ";
                        $ftrn_nom = consulta_string_func($sql, 'ftrn_des_ftrn', $oIfx, 0);
                        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$ftrn_nom.'</div>';
                }elseif($aux==14){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==15){
                        $aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
                }elseif($aux==16){
						// CENTRO COSTO 
						$sql = "select ccosn_cod_ccosn, ( ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn ) as  ccosn_nom_ccosn from saeccosn where
									ccosn_cod_empr  = $idempresa and
									ccosn_mov_ccosn = 1 and
									ccosn_cod_ccosn = '$aVal' ";
						$ccosn_nom = consulta_string_func($sql, 'ccosn_nom_ccosn', $oIfx, '');
                        $aDatos[$cont][$aLabelGrid[$aux]]=$ccosn_nom;
                }elseif($aux==17){
						// CENTRO ACTIVIDAD
						$sql = "select cact_cod_cact , ( cact_nom_cact ||  ' - ' || cact_cod_cact ) as cact_nom_cact from saecact where
										cact_cod_empr = $idempresa and
										cact_cod_cact = '$aVal'  ";
						$act_nom = consulta_string_func($sql, 'cact_nom_cact', $oIfx, '');
                        $aDatos[$cont][$aLabelGrid[$aux]]=$act_nom;
                }else
				$aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
			$aux ++;
		}
		$cont ++;
	}
        $array = array('','','','','',$tot_deb,$tot_cre,'','');
	return genera_grid($aDatos,$aLabelGrid,'DIARIO',99, '', $array);
}

function elimina_detalle_dia($id=null, $idempresa, $idsucursal){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

	$oReturn = new xajaxResponse();

	/*$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab' );   
	*/
	
	$aLabelDiar = array('Fila', 		   'Cuenta', 			 'Nombre',	   'Documento',   'Cotizacion', 	'Debito', 	   'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad'		);	
						
	$aDataGrid = $_SESSION['aDataGirdDiar'];
	$contador = count($aDataGrid);
	if($contador>1){
        unset($aDataGrid[$id]);
        $_SESSION['aDataGirdDiar']=$aDataGrid;

        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario","innerHTML",$sHtml);

        /*$aDataGridDir = $_SESSION['aDataGirdDir'];
        $contadorDir = count($aDataGridDir);        
        if($contadorDir>1){
            unset($aDataGridDir[$id]);
            $_SESSION['aDataGirdDir'] = $aDataGridDir;
            $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
            $oReturn->assign("divDir","innerHTML",$sHtml);
        }else{
            unset($aDataGridDir[0]);
            $_SESSION['aDataGirdDir']=$aDatos;
            $sHtml = "";
            $oReturn->assign("divDir","innerHTML",$sHtml);
        }*/
        

	}else{
		unset($aDataGrid[0]);
		$_SESSION['aDataGirdDiar']=$aDatos;
		$sHtml = "";
        $oReturn->assign("divDiario","innerHTML",$sHtml);

        $aDataGridDir = $_SESSION['aDataGirdDir'];
        $contadorDir = count($aDataGridDir);        
        if($contadorDir>1){
            unset($aDataGridDir[$id]);
            $_SESSION['aDataGirdDir'] = $aDataGridDir;
            $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
            $oReturn->assign("divDir","innerHTML",$sHtml);
        }else{
            unset($aDataGridDir[0]);
            $_SESSION['aDataGirdDir']=$aDatos;
            $sHtml = "";
            $oReturn->assign("divDir","innerHTML",$sHtml);
        }

	}

        
	return $oReturn;
}




// RETENCION
function agrega_modifica_grid_ret($nTipo=0, $aForm = '', $id='' ){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN_Ifx;

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();
        
	$aDataGrid = $_SESSION['aDataGirdRet'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];   
    
    $aLabelGrid = array('Fila', 'Cta Ret', 'Cliente', 'Factura', 'Ret Cliente', 'Porc(%)', 'Base Impo', 
                        'Valor', 'N.- Retencion', 'Detalle',  'Cotizacion', 'Debito' , 'Credito', 'Modificar', 'Eliminar' );
    $aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad'	);           
        
	$oReturn = new xajaxResponse();

        // VARIABLES
        $idempresa = $aForm["empresa"];
        $idsucursal= $aForm["sucursal"];
        $cod_ret   = $aForm["cod_ret"];
        $fact_ret  = $aForm["fact_ret"];
        $clpv_ret  = $aForm["ret_clpv"];
        $porc_ret  = $aForm["ret_porc"];
        $base_ret  = $aForm["ret_base"];
        $val_ret   = round(($base_ret * $porc_ret / 100),2);
        $num_ret   = $aForm["ret_num"];
        $det_ret   = $aForm["ret_det"];
        $cta_deb   = $aForm["cta_deb"];
        $cta_cre   = $aForm["cta_cre"];
        $tipo      = $aForm["tipo"];
        $clpv_nom  = $aForm["clpv_nom"];
        $clpv_cod  = $aForm["clpv_cod"];
        
        $val_deb   = 0;
        $val_cre   = 0;
        if($tipo=='CR'){
            // CREDITO
            $sql = "select cuen_nom_cuen from saecuen where 
                    cuen_cod_empr = $idempresa and
                    cuen_cod_cuen = '$cta_cre' ";      
            $val_cre = $val_ret;
        }else{
            // DEBITO
            $sql = "select cuen_nom_cuen from saecuen where 
                    cuen_cod_empr = $idempresa and
                    cuen_cod_cuen = '$cta_deb' ";
            $val_deb = $val_ret;
        }
        $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
        
        
        //  LECTURA SUCIA
        //////////////
        
        if($nTipo==0){
                // RETENCION
                $cont = count($aDataGrid);
                $aDataGrid[$cont][$aLabelGrid[0]]=floatval($cont);
                $aDataGrid[$cont][$aLabelGrid[1]]=$cod_ret;
                $aDataGrid[$cont][$aLabelGrid[2]]=$clpv_cod;
                $aDataGrid[$cont][$aLabelGrid[3]]=$fact_ret;
                $aDataGrid[$cont][$aLabelGrid[4]]=$clpv_ret;
                $aDataGrid[$cont][$aLabelGrid[5]]=$porc_ret;
                $aDataGrid[$cont][$aLabelGrid[6]]=$base_ret;
                $aDataGrid[$cont][$aLabelGrid[7]]=$val_ret;
                $aDataGrid[$cont][$aLabelGrid[8]]=$num_ret;
                $aDataGrid[$cont][$aLabelGrid[9]]=$det_ret;
                $aDataGrid[$cont][$aLabelGrid[10]]=1;
                $aDataGrid[$cont][$aLabelGrid[11]]=$val_deb;
                $aDataGrid[$cont][$aLabelGrid[12]]=$val_cre;
                $aDataGrid[$cont][$aLabelGrid[13]]='';
                $aDataGrid[$cont][$aLabelGrid[14]]='';

                // DIARIO
                $contd = count($aDataDiar);
                $aDataDiar[$contd][$aLabelDiar[0]]=floatval($contd);
                $aDataDiar[$contd][$aLabelDiar[1]]=$cta_cre . $cta_deb;
                $aDataDiar[$contd][$aLabelDiar[2]]=$cuen_nom;
                $aDataDiar[$contd][$aLabelDiar[3]]=$doc;
                $aDataDiar[$contd][$aLabelDiar[4]]=1;
                $aDataDiar[$contd][$aLabelDiar[5]]=$val_deb;
                $aDataDiar[$contd][$aLabelDiar[6]]=$val_cre;
                $aDataDiar[$contd][$aLabelDiar[7]]='';
                $aDataDiar[$contd][$aLabelDiar[8]]='';  
				$aDataDiar[$contd][$aLabelDiar[9]]='';
				$aDataDiar[$contd][$aLabelDiar[10]]='';
				$aDataDiar[$contd][$aLabelDiar[11]]='';
				$aDataDiar[$contd][$aLabelDiar[12]]='';
				$aDataDiar[$contd][$aLabelDiar[13]]='';
				$aDataDiar[$contd][$aLabelDiar[14]]='';
				$aDataDiar[$contd][$aLabelDiar[15]]=$det_dir;	
				$aDataDiar[$contd][$aLabelDiar[16]]='';
				$aDataDiar[$contd][$aLabelDiar[17]]='';				
        }
        
        // RETENCION
        $_SESSION['aDataGirdRet'] = $aDataGrid;
        $sHtml = mostrar_grid_ret($idempresa, $idsucursal);
        $oReturn->assign("divRet","innerHTML",$sHtml);
        
        // DIARIO
        $sHtml = '';
        $_SESSION['aDataGirdDiar'] = $aDataDiar;
        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario","innerHTML",$sHtml);
        
        // TOTAL DIARIO
        $oReturn->script("total_diario();");
        
        $oReturn->script("cerrar_ventana();");
	return $oReturn;
}

function mostrar_grid_ret($idempresa, $idsucursal){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	global $DSN_Ifx;

	$oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();

    $aDataGrid  = $_SESSION['aDataGirdRet'];
	$aLabelGrid = array('Fila', 'Cta Ret', 'Cliente', 'Factura', 'Ret Cliente', 'Porc(%)', 'Base Impo', 
                            'Valor', 'N.- Retencion', 'Detalle',  'Cotizacion', 'Debito' , 'Credito', 'Modificar', 'Eliminar' );

	$cont    = 0;        
        $tot_cre = 0;
        $tot_deb = 0;
	foreach ($aDataGrid as $aValues){
		$aux     = 0;
		foreach ($aValues as $aVal){
			if ($aux == 0){
                        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.($cont+1).'</div>';
                }elseif ($aux==2){
                        $sql = "select  clpv_nom_clpv from saeclpv where clpv_cod_clpv = $aVal and clpv_cod_empr = $idempresa ";
                        $clpv_nom = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$clpv_nom.'</div>';
                }elseif($aux==3){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';
                }elseif($aux==4){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';
                }elseif($aux==5){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.$aVal.'</div>';
                }elseif($aux==6){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.$aVal.'</div>';
                }elseif($aux==7){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                }elseif($aux==8){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                }elseif($aux==9){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="left">'.$aVal.'</div>';                                
                }elseif($aux==10){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                }elseif($aux==11){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                        $tot_deb += $aVal;
                }elseif($aux==12){
				        $aDatos[$cont][$aLabelGrid[$aux]]='<div align="right">'.round($aVal,2).'</div>';
                        $tot_cre += $aVal;
                }elseif($aux==13){
				        $aDatos[$cont][$aLabelGrid[$aux]]= '<div align="center">
                                                                <img src="'.$_COOKIE['JIREH_IMAGENES'].'iconos/pencil.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_ret('.$cont.', '.$idempresa.', '.$idsucursal.');"
                                                                alt="Eliminar"
                                                                align="bottom" />
                                                            </div>';
                }elseif($aux==14){
				        $aDatos[$cont][$aLabelGrid[$aux]]= '<div align="center">
                                                                <img src="'.$_COOKIE['JIREH_IMAGENES'].'iconos/delete_1.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_ret('.$cont.', '.$idempresa.', '.$idsucursal.');"
                                                                alt="Eliminar"
                                                                align="bottom" />
                                                            </div>';
                }else
				$aDatos[$cont][$aLabelGrid[$aux]]=$aVal;
			$aux ++;
		}
		$cont ++;
	}
	$array = array('','','','','','','','','','','',$tot_deb,$tot_cre,'','');
	return genera_grid($aDatos,$aLabelGrid,'RETENCION',99, '', $array);
}

function elimina_detalle_ret($id=null, $idempresa, $idsucursal){
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $oReturn = new xajaxResponse();

    $aLabelGrid = array('Fila', 'Cta Ret', 'Cliente', 'Factura', 'Ret Cliente', 'Porc(%)', 'Base Impo', 
                        'Valor', 'N.- Retencion', 'Detalle',  'Cotizacion', 'Debito' , 'Credito', 'Modificar', 'Eliminar' );
    
    $aDataGrid = $_SESSION['aDataGirdRet'];    

    $contador = count($aDataGrid);
    if($contador>1){
        unset($aDataGrid[$id]);
        $_SESSION['aDataGirdRet']=$aDataGrid;
        $sHtml = mostrar_grid_ret($idempresa, $idsucursal);
        $oReturn->assign("divRet","innerHTML",$sHtml);
    }else{
        unset($aDataGrid[0]);
        $_SESSION['aDataGirdRet']=$aDatos;
        $sHtml = "";
        $oReturn->assign("divRet","innerHTML",$sHtml);
    }

        
    return $oReturn;
}

function guardar( $aForm='' ){
    //Definiciones
	global $DSN_Ifx, $DSN;

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

	$oCon = new Dbo;
	$oCon -> DSN = $DSN;
	$oCon -> Conectar();

        $oIfx = new Dbo;
	$oIfx -> DSN = $DSN_Ifx;
	$oIfx -> Conectar();

        $oIfxA = new Dbo;
	$oIfxA -> DSN = $DSN_Ifx;
	$oIfxA -> Conectar();

        $oReturn = new xajaxResponse();

        //      VARIABLES
        $user_web     = $_SESSION['U_ID'];
        $user_ifx     = $_SESSION['U_USER_INFORMIX'];        
        $aDataGrid    = $_SESSION['aDataGirdDir'];
        $aDataDiar    = $_SESSION['aDataGirdDiar'];
        $aDataGridRet = $_SESSION['aDataGirdRet'];
        
	    $idempresa    = $aForm['empresa'];
        $idsucursal   = $aForm['sucursal'];
        $tidu_cod     = $aForm['tipo_doc'];
        $fecha_mov    = fecha_informix_func($aForm['fecha']);
        $clpv_ruc     = $aForm['ruc']; 
        $clpv_nom     = $aForm['cliente_nombre']; 
        $clpv_cod     = $aForm['cliente'];
        $empl_cod     = $aForm['empleado'];
        $asto_val     = $aForm['valor'];
        $form_cod     = $aForm['formato'];
        $deas         = $aForm['deas'];
        $deta_asto    = $aForm['detalle'];
        $asto_cod     = $aForm['asto_cod'];
        $comp_cod     = $aForm['compr_cod'];        
        $time         = date("Y-m-d H:i:s");

        //  LECTURA SUCIA
        //////////////

        if(count($aDataDiar)>0){
        //      TRANSACCIONALIDAD IFX
                try{
                    // commit
                    $oIfx->QueryT('BEGIN WORK;');
                    
                    //MAYORIZACION
                    $class = new mayorizacion_class();                
                    unset($array);
                    $array = $class->secu_asto($oIfx, $idempresa, $idsucursal, 5, $fecha_mov, $user_ifx, $tidu_cod);
                    foreach($array as $val){
                        $secu_asto  = $val[0];
                        $secu_dia   = $val[1];
                        $tidu       = $val[2];
                        $idejer     = $val[3];
                        $idprdo     = $val[4];
                        $moneda     = $val[5];
                        $tcambio    = $val[6];
                        $empleado   = $val[7];  
                        $usua_nom   = $val[8];
                    }// fin foreach                    
                    
                    // SAEASTO
                    $class->saeasto($oIfx,        $secu_asto, $idempresa, $idsucursal, $idejer,   $idprdo,    $moneda, $user_ifx, '', 
                                    $clpv_nom,     0,         $fecha_mov, $deta_asto,  $secu_dia, $fecha_mov, $tidu,   $usua_nom, 
                                    $user_web,     5 ); 
                    
                    // SAEDIR
                    $x = 1;
                    $j = 1;   
                    if(count($aDataGrid)>0){      
                        foreach ($aDataGrid as $aValues){                                    
                                $aux=0;
                                $total=0;
                                foreach ($aValues as $aVal){
                                        if($aux==0){
                                            // CONT
                                            $cod_dir = $aVal+1;
                                        }elseif($aux==1){
                                            // CLPV COD
                                            $clpv_cod  = $aVal;
                                            $sql = "select  clpv_nom_clpv from saeclpv where clpv_cod_clpv = $clpv_cod and clpv_cod_empr = $idempresa ";
                                            $clpv_nom = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                                        }elseif ($aux==2){
                                            // TIPO
                                            $tipo = $aVal;
                                        }elseif ($aux==3){
                                            // FACTURA
                                            $factura  = $aVal;
                                        }elseif ($aux==4){
                                            // FECHA VENCE
                                            $fec_vence = fecha_informix_func($aVal);
                                        }elseif ($aux==5){
                                            // DETALLE
                                            $detalle = $aVal;
                                        }elseif ($aux==6){
                                            // COTIZACION
                                            $cotiza = $aVal;
                                        }elseif ($aux==7){
                                            // DEBITO
                                            $debito = $aVal;
                                        }elseif ($aux==8){
                                            // CREDITO
                                            $credito = $aVal;
                                            $class->saedir($oIfx,     $idempresa, $idsucursal,   $idprdo,  $idejer,    $secu_asto, $clpv_cod,   4, 
                                                           $tipo,     $factura,   $fec_vence,    $detalle, $debito,    $credito,  $debito,     $credito, 
                                                           'DB',      '',         '',            '',       '',         '',        '', 
                                                           $user_web, $cod_dir,   $cotiza,       $clpv_nom );
                                        }
                                        $aux ++;
                                }                                    
                                $x++;
                                $j++;
                        }// fin foreach
                    
                    }

                    // RET
                    if(count($aDataGridRet)>0){
                        $x = 1;
                        $j = 1;
                        foreach ($aDataGridRet as $aValues){                                    
                            $aux=0;
                            $total=0;
                            foreach ($aValues as $aVal){
                                    if($aux==0){
                                            $ret_secu = $aVal+1;
                                    }elseif($aux==1){
                                            $cta_ret = $aVal;
                                    }elseif ($aux==2){
                                            $clpv_cod = $aVal;
                                            $sql = "select  clpv_nom_clpv, clpv_ruc_clpv from saeclpv where clpv_cod_clpv = $clpv_cod and clpv_cod_empr = $idempresa ";
                                            if($oIfx->Query($sql)){
                                                $clpv_nom = $oIfx->f('clpv_nom_clpv');
                                                $clpv_ruc = $oIfx->f('clpv_ruc_clpv');
                                            }
                                            
                                            $sql = "select dire_dir_dire from saedire where 
                                                        dire_cod_empr = $idempresa and
                                                        dire_cod_clpv = $clpv_cod ";
                                            $clpv_dir = consulta_string_func($sql, 'dire_dir_dire', $oIfx, '');
                                            $sql = "select emai_ema_emai from saeemai where
                                                        emai_cod_empr = $idempresa  and
                                                        emai_cod_clpv = $clpv_cod ";
                                            $clpv_correo = consulta_string_func($sql, 'emai_ema_emai', $oIfx, '');
                                    }elseif ($aux==3){
                                            $factura = $aVal;
                                    }elseif ($aux==4){
                                            $ret_clpv = $aVal;
                                    }elseif ($aux==5){
                                            $ret_porc = $aVal;
                                    }elseif ($aux==6){
                                            $ret_base = $aVal;
                                    }elseif ($aux==7){
                                            $ret_val = $aVal;
                                    }elseif ($aux==8){
                                            $ret_num = $aVal;
                                    }elseif ($aux==9){
                                            $ret_det = $aVal;
                                    }elseif ($aux==10){
                                            $cotiza  = $aVal;
                                    }elseif ($aux==11){
                                            $debito  = $aVal;
                                    }elseif ($aux==12){
                                            $credito = $aVal;
                                            $class->saeret($oIfx,     $idempresa, $idsucursal,  $idprdo,     $idejer,    $secu_asto, $clpv_cod, $clpv_nom, 
                                                           $clpv_dir, '',         $clpv_ruc,    $ret_secu,   $cta_ret,   $ret_porc, $ret_base, $ret_val, 
                                                           $ret_num,  $ret_det,   $debito,      $credito,    $debito,    $credito,  $factura,  '', 
                                                           '',        '',         $clpv_correo, 'N');
                                    }
                                    $aux ++;
                            }                                    
                            $x++;
                            $j++;
                        }// fin foreach
                    }
                    
                    //$oReturn->alert(count($aDataDiar));
                    // DIARIO
                    if(count($aDataDiar)>0){
                        $x = 1;
                        $j = 1;
                        $total = 0;
                        foreach ($aDataDiar as $aValues){                                    
                            $aux = 0;   
                            foreach ($aValues as $aVal){
                                    if($aux==0){
                                            $dasi_cod = $aVal+1;
                                    }elseif($aux==1){
                                            $cta_cod = $aVal;
                                    }elseif ($aux==2){
                                            $cta_nom = $aVal;
                                    }elseif ($aux==3){
                                            $documento = $aVal;
                                    }elseif ($aux==4){
                                            $cotiza = $aVal;
                                    }elseif ($aux==5){
                                            $debito = $aVal;
                                    }elseif ($aux==6){
                                            $credito = $aVal;                                    
                                            $total += $debito;
                                    }elseif ($aux==9){
                                            // BENEFICIARIO
                                            $ben_cheq = $aVal;
                                    }elseif ($aux==10){
                                            // CTA BANCARIA
                                            $cta_cheq = $aVal;
                                    }elseif ($aux==11){
                                            // CHEQUE
                                            $num_cheq = $aVal;			   
                                    }elseif ($aux==12){
                                            // FECHA VENC
                                            $fec_cheq = fecha_informix_func($aVal);
                                    }elseif ($aux==13){
                                            // FORMATO CHEQUE
                                            $form_cheq = $aVal;
                                    }elseif ($aux==14){
                                            // CTA COD
                                            $cod_cheq = $aVal;
									}elseif ($aux==15){		
											$detalle_dasi = $aVal;
									}elseif ($aux==16){		
											$ccosn_cod = $aVal;									
									}elseif ($aux==17){		
											$act_cod   = $aVal;
											
											$opBand = 'S';
											$opBacn = 'N';
											$opFlch = '';
											if(!empty($cta_cheq)){
												$opBacn = 'S';
												$opFlch = 1;
											}
											
											if(empty($num_cheq)){
												$num_cheq = $documento;
											}
											
											//$oReturn->alert('debito '.$detalle_dasi);
											//$oReturn->alert('credi '.$credito);
											
											 // DASI
                                            $class->saedasi($oIfx,      $idempresa, $idsucursal, $cta_cod,   $idprdo,    $idejer, $ccosn_cod, 
                                                            $debito,    $credito,   $debito,     $credito,   $cotiza,   $detalle_dasi, 
                                                            '' ,        '',         $user_web,   $secu_asto, $dasi_cod_ret, $dasi_dir, 
                                                           $dasi_cta_ret, $opBand, $opBacn, $opFlch, $num_cheq,  $act_cod );

                                            if($cod_cheq>0){
                                                // INGRESO DE CHEQUE
                                                $sql = "insert into saedchc ( dchc_cod_ctab,   dchc_cod_asto ,
                                                                              asto_cod_empr,   asto_cod_sucu ,
                                                                              asto_cod_ejer,   asto_num_prdo ,
                                                                              dchc_num_dchc,   dchc_val_dchc ,
                                                                              dchc_cta_dchc,   dchc_fec_dchc ,
                                                                              dchc_benf_dchc,  dchc_cod_cuen ,
                                                                              dchc_nom_banc ,  dchc_con_fila )
                                                                    values ( $cod_cheq,        '$secu_asto',
                                                                             $idempresa,       $idsucursal,
                                                                             $idejer,          $idprdo,
                                                                             '$num_cheq',      $credito,
                                                                             '$cta_cheq',      '$fec_cheq',
                                                                             '$ben_cheq',      '$cta_cod',
                                                                             '$cta_nom',        $dasi_cod    ) ";
                                                $oIfx->QueryT($sql);

                                                // UPDATE CHEQUE
                                                $sql = "update saectab set ctab_num_cheq = '$num_cheq' where
                                                            ctab_cod_empr = $idempresa and
                                                            ctab_cod_sucu = $idsucursal and
                                                            ctab_cod_ctab = $cod_cheq ";
                                                $oIfx->QueryT($sql);
                                            }
                                    }
                                    $aux ++;
                            }                                    
                            $x++;
                            $j++;
                        }// fin foreach
                    }// fin
                    
                    // ACTUALIZACION SAEASTO
                    $sql = "update saeasto set asto_est_asto = 'MY', 
								asto_vat_asto = $total  where
								asto_cod_empr = $idempresa  and
								asto_cod_sucu = $idsucursal and
                                asto_cod_asto = '$secu_asto' and
                                asto_cod_ejer = $idejer and
                                asto_num_prdo = $idprdo and
                                asto_cod_modu = 5 and
								asto_cod_empr = $idempresa and     
								asto_cod_sucu = $idsucursal and
                                asto_user_web = $user_web ";
                    $oIfx->QueryT($sql);
                    
                    $oReturn->assign("asto_cod", "value", $secu_asto );
                    $oReturn->assign("compr_cod", "value", $secu_asto );
                    
                    // ASIENTOS 
                    $oReturn->assign("asto_cod", "value", $secu_asto);
                    $oReturn->assign("ejer_cod", "value", $idejer);
                    $oReturn->assign("prdo_cod", "value", $idprdo);


                    $oIfx->QueryT('COMMIT WORK;');
                    $oReturn->alert('Ingresado Correctamente...');
                    
                }catch (Exception $e) {
                    // rollback
                    $oIfx->QueryT('ROLLBACK WORK;');
                    $oReturn->alert($e->getMessage());
                    $oReturn->assign("ctrl", "value", 1 );
					
					$oReturn->script('habilitar_boton();');
					
                }
        }else{
            $oReturn->alert('Por favor ingrese un Ingreso....');
			$oReturn->script('habilitar_boton();');
        }

	return $oReturn;
}

function numero_ret($aForm=''){
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $oReturn = new xajaxResponse();
    
    $rete  = $aForm['ret_num'];
    $len   = strlen(($rete));
    $ceros = cero_mas_func('0', (9-$len));
    $rete  = $ceros.$rete;
    
    $oReturn->assign("ret_num", "value", $rete);
    
    return $oReturn;    
}

function total_diario($aForm = ''){
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
    $oReturn = new xajaxResponse();
        
	$aDataGrid  = $_SESSION['aDataGirdDiar'];


	$cont    = 0;
	$tot_cre = 0;
	$tot_deb = 0;
	foreach ($aDataGrid as $aValues){
		$aux =0;
		foreach ($aValues as $aVal){
			if($aux==5){
                    $tot_deb += $aVal;
            }elseif($aux==6){
                    $tot_cre += $aVal;
            }
			$aux ++;
		}
		$cont ++;
	}
        
        $tipo = '';
        if($tot_cre>$tot_deb){
            $tipo = 'DB';
        }elseif($tot_deb > $tot_cre){
            $tipo = 'CR';
        }
		
		$totalCampo = abs(round($tot_cre - $tot_deb,2));
		
		//$oReturn->alert($totalCampo);

        $oReturn->assign("val_cta", "value", $totalCampo);
        $oReturn->assign("valor", "value", $totalCampo);
        $oReturn->assign("crdb", "value",  $tipo);
	return $oReturn;
}



// CHEQUE
function reporte_cheque($sAccion='nuevo',$aForm='', $idempresa, $idsucursal, $clpv_nom, $val_cheq ){
    //  Definiciones
    global $DSN_Ifx, $DSN;  
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}    
    
    $oIfx = new Dbo;
    $oIfx -> DSN = $DSN_Ifx;
    $oIfx -> Conectar();

    $ifu = new Formulario;
    $ifu->DSN=$DSN_Ifx;
        
    $fu = new Formulario;
    $fu->DSN=$DSN;
    
    $oReturn      = new xajaxResponse();       

    //  LECTURA SUCIA
    //////////////
        
    $cta = $aForm['cta_cheq'];
	
	$aDataGrid    = $_SESSION['aDataGirdDir'];
	if(count($aDataGrid)>0){      
		foreach ($aDataGrid as $aValues){                                    
			$aux = 0;
			foreach ($aValues as $aVal){
					if($aux==1){
						// CLPV COD
						$clpv_cod  = $aVal;
						$sql 	   = "select  clpv_cod_cact, clpv_nom_clpv from saeclpv where clpv_cod_clpv = $clpv_cod and clpv_cod_empr = $idempresa ";
						$act_cod   = consulta_string_func($sql, 'clpv_cod_cact', $oIfx, '');
					}
					$aux ++;
			}     
		}// fin foreach
	
	}
	
    switch ($sAccion){
        case 'nuevo':
                        // CHEQUE
                        $fu->AgregarCampoLista('cta_cheq', 'Cuenta|left', true, 'auto');
                        $fu->AgregarComandoAlCambiarValor('cta_cheq','cargar_cuenta();');
                        $sql = "select 
                                    ctab_cod_ctab, ctab_cod_cuen, banc_nom_banc, ctab_num_ctab
                                    from saectab , saebanc where
                                    banc_cod_banc = ctab_cod_banc and
                                    banc_cod_empr = $idempresa and
                               --    banc_cod_sucu = $idsucursal and
                                    ctab_cod_empr = $idempresa and
                                --    ctab_cod_sucu = $idsucursal and
                                    ctab_tip_ctab = 'C' ";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $nom = $oIfx->f('ctab_cod_cuen').' - '.$oIfx->f('banc_nom_banc').' - '.$oIfx->f('ctab_num_ctab');
                                    $fu->AgregarOpcionCampoLista('cta_cheq',$nom,$oIfx->f('ctab_cod_ctab')); 
                                }while($oIfx->SiguienteRegistro());
                            }
                        }           

                        $fu->AgregarCampoTexto('cheque', 'N.- Cheque|left', true, '', 200, 10);
                        $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, $clpv_nom , 230, 150);
                        $fu->AgregarCampoTexto('ctab_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
                        $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, 'auto');
                        $fu->AgregarCampoNumerico('val_cheq', 'Valor|left', true, $val_cheq, 80, 150);
						
						// CENTRO DE ACTIVIDAD
						$ifu->AgregarCampoListaSQL('actividad_cheq', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 300,150);
						$ifu->cCampos["actividad_cheq"]->xValor = $act_cod;

    break;
    case 'cuenta':                          
                        // CHEQUE
                        $fu->AgregarCampoLista('cta_cheq', 'Cuenta|left', true, 'auto');
						$fu->AgregarComandoAlCambiarValor('cta_cheq','cargar_cuenta();');
						
                        $sql = "select 
                                    ctab_cod_ctab, ctab_cod_cuen, banc_nom_banc, ctab_num_ctab
                                    from saectab , saebanc where
                                    banc_cod_banc = ctab_cod_banc and
                                    banc_cod_empr = $idempresa and
                                --    banc_cod_sucu = $idsucursal and
                                    ctab_cod_empr = $idempresa 
                                --   ctab_cod_sucu = $idsucursal ";
                        if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $nom = $oIfx->f('ctab_cod_cuen').' - '.$oIfx->f('banc_nom_banc').' - '.$oIfx->f('ctab_num_ctab');
                                    $fu->AgregarOpcionCampoLista('cta_cheq',$nom,$oIfx->f('ctab_cod_ctab')); 
                                }while($oIfx->SiguienteRegistro());
                            }
                        }           


                        // DATSO
                        $sql = "select ctab_num_ctab, ctab_num_cheq, ctab_for_cheq from saectab where 
                                        ctab_cod_ctab = $cta and 
                                        ctab_cod_empr = $idempresa and
                                        ctab_cod_sucu = $idsucursal";
                       if($oIfx->Query($sql)){
                            if($oIfx->NumFilas()>0){
                                do{
                                    $ctab_num = $oIfx->f('ctab_num_ctab');
                                    $cheq_num = $oIfx->f('ctab_num_cheq')*1;
                                    $cheq_ftrn= $oIfx->f('ctab_for_cheq');
                                }while($oIfx->SiguienteRegistro());
                            }
                        } 

                        $cheq_num = secuencial(2, '', $cheq_num, 10);

                        $fu->AgregarCampoTexto('cheque', 'N.- Cheque|left', true, $cheq_num, 200, 10);
                        $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, $clpv_nom, 230, 150);
                        $fu->AgregarCampoTexto('ctab_cheq', 'Cuenta Bancaria|left', false, $ctab_num, 150, 150);
                        $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, 
                                                date('Y') . '/' . date('m') . '/' . date('d'));
                        $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, 'auto');
                        $fu->AgregarCampoNumerico('val_cheq', 'Valor|left', true, $val_cheq, 80, 150);

                        $fu->cCampos["cta_cheq"]->xValor = $cta;
                        $ifu->cCampos["form_cheq"]->xValor = $cheq_ftrn;
						
						// CENTRO DE ACTIVIDAD
						$ifu->AgregarCampoListaSQL('actividad_cheq', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 300,150);
						$ifu->cCampos["actividad_cheq"]->xValor = $act_cod;


        break;                  
    }
                        
    $sHtml .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">';
    $sHtml .= '<table align="center" cellpadding="0" cellspacing="2" width="100%" border="0">';        
    $sHtml .= '<tr>
                   <td colspan="4" class="tituloCab" height="20px" align="center">CHEQUE</td>
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">'.$fu->ObjetoHtmlLBL('cta_cheq').'</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>'.$fu->ObjetoHtml('cta_cheq').'</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">'.$fu->ObjetoHtmlLBL('ben_cheq').'</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>'.$fu->ObjetoHtml('ben_cheq').'</td>
                                    <td class="labelFrm">'.$ifu->ObjetoHtmlLBL('form_cheq').'</td>
                                    <td>'.$ifu->ObjetoHtml('form_cheq').'</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">'.$fu->ObjetoHtmlLBL('cheque').'</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>'.$fu->ObjetoHtml('cheque').'</td>
                                    <td class="labelFrm">'.$fu->ObjetoHtmlLBL('ctab_cheq').'</td>
                                    <td>'.$fu->ObjetoHtml('ctab_cheq').'</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>'; 
    $sHtml .= '<tr>
                        <td class="labelFrm">'.$fu->ObjetoHtmlLBL('fec_cheq').'</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>'.$fu->ObjetoHtml('fec_cheq').'</td>
                                    <td class="labelFrm">'.$fu->ObjetoHtmlLBL('val_cheq').'</td>
                                    <td>'.$fu->ObjetoHtml('val_cheq').'</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';   	
	$sHtml .= '<tr>
                        <td class="labelFrm">'.$ifu->ObjetoHtmlLBL('actividad_cheq').'</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>'.$ifu->ObjetoHtml('actividad_cheq').'</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';   
    $sHtml .= '<tr>
                        <td class="labelFrm" colspan="4" align="center">
                            <input type="button" value="AGREGAR"
                                    onClick="javascript:cargar( )"
                                    id="BuscaBtn" class="myButton_BT"
                                    style="width:80px; height:25px;" />
                        </td>                           
               </tr>';   
    $sHtml .='</table></fieldset>';
        
        
    $oReturn->assign("divFormularioDetalle","innerHTML",$sHtml);
        
    return $oReturn;
}

// DIARIO  CHEQUE
function agrega_modifica_grid_dia_cheque($nTipo=0, $aForm = '', $idempresa='', $idsucursal, $detalle  ){
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx -> DSN = $DSN_Ifx;
    $oIfx -> Conectar();
        
    $aDataDiar = $_SESSION['aDataGirdDiar'];
    
    $aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
                        'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle',
						'Centro Costo',   'Centro Actividad' );        
        
    $oReturn = new xajaxResponse();

    // VARIABLES
    $cta_cheq   = $aForm["cta_cheq"];
    $sql = "select ctab_num_ctab, ctab_num_cheq, ctab_cod_cuen from saectab where 
                    ctab_cod_ctab = $cta_cheq and 
                    ctab_cod_empr = $idempresa and
                    ctab_cod_sucu = $idsucursal ";
    $cod_cta    = consulta_string_func($sql, 'ctab_cod_cuen', $oIfx, '');  

    $sql = "select  cuen_nom_cuen  from saecuen where
                cuen_cod_empr  = $idempresa and
                cuen_cod_cuen  = '$cod_cta' ";
    $nom_cta    = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');  
    $val_cta    = $aForm["val_cheq"];
    $ben_cheq   = $aForm["ben_cheq"];
    $form_cheq  = $aForm["form_cheq"];
    $cheque     = $aForm["cheque"];
    $cta_banc   = $aForm["ctab_cheq"];
    $fec_cheq   = $aForm["fec_cheq"];
	$act_cod    = $aForm["actividad_cheq"];

        
        //  LECTURA SUCIA
    //////////////
    
    if($nTipo==0){
            // DIARIO
            $contd = count($aDataDiar);
            $aDataDiar[$contd][$aLabelDiar[0]]=floatval($contd);
            $aDataDiar[$contd][$aLabelDiar[1]]=$cod_cta;
            $aDataDiar[$contd][$aLabelDiar[2]]=$nom_cta;
            $aDataDiar[$contd][$aLabelDiar[3]]='';
            $aDataDiar[$contd][$aLabelDiar[4]]=1;
            $aDataDiar[$contd][$aLabelDiar[5]]=0;
            $aDataDiar[$contd][$aLabelDiar[6]]=$val_cta;
            $aDataDiar[$contd][$aLabelDiar[7]]='';
            $aDataDiar[$contd][$aLabelDiar[8]]='';                
            $aDataDiar[$contd][$aLabelDiar[9]]=$ben_cheq;   
            $aDataDiar[$contd][$aLabelDiar[10]]=$cta_banc;   
            $aDataDiar[$contd][$aLabelDiar[11]]=$cheque;   
            $aDataDiar[$contd][$aLabelDiar[12]]=$fec_cheq;   
            $aDataDiar[$contd][$aLabelDiar[13]]=$form_cheq;   
            $aDataDiar[$contd][$aLabelDiar[14]]=$cta_cheq;  
			$aDataDiar[$contd][$aLabelDiar[15]]=$detalle;  
			$aDataDiar[$contd][$aLabelDiar[16]]='';  
			$aDataDiar[$contd][$aLabelDiar[17]]=$act_cod;  
    }
    
    // DIARIO
    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataDiar;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario","innerHTML",$sHtml);

    $oReturn->assign("cod_cta","value",'');
    $oReturn->assign("nom_cta","value",'');
    $oReturn->assign("val_cta","value",'');
    
    // TOTAL DIARIO
    $oReturn->script("total_diario();");
        
    $oReturn->script("cerrar_ventana();");
    return $oReturn;
}

function cargar_coti($aForm = ''){
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
        
    $oReturn = new xajaxResponse();
        
    //variables del formulario
    $idempresa = $aForm['empresa'];
    $mone_cod  = $aForm['moneda'];

    $sql = "select tcam_val_tcam from saetcam where
                mone_cod_empr = $idempresa and
                tcam_cod_mone = $mone_cod and
                tcam_fec_tcam in (
                                    select max(tcam_fec_tcam)  from saetcam where
                                            mone_cod_empr = $idempresa and
                                            tcam_cod_mone = $mone_cod
                                )  ";

    $coti = consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);
                                
    
    $oReturn->assign("cotizacion", "value", $coti);
    $oReturn->assign("cotizacion_ret", "value", $coti);
    return $oReturn;
}

function reporte_credito($aForm = ''){
	//Definiciones
	global $DSN, $DSN_Ifx;

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
	$oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
	
	$oReturn = new xajaxResponse();
	
	try {
		
		$sHtml .= '<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content" id="modalMateriales">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">CREDITOS CLIENTES</h4>
							</div>
						<div class="modal-body">';
		$sHtml .= '<table class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom: 0px; width: 98%" align="center">';
		$sHtml .= '<tr>';
		$sHtml .= '<th>IDENTIFICACION</th>';
		$sHtml .= '<th>CLIENTE</th>';
		$sHtml .= '<th>MONTO</th>';
		$sHtml .= '<th>SELECCIONAR</th>';
		$sHtml .= '</tr>';
		
		$sql = "select id, id_clpv, id_tipo, nombre, ruc, ingresos,
				egresos, capacidad, monto, plazo, interes_p,
				interes_v, total, cuota, fecha, user_web
				from credito_clpv
				where 
				estado = 'AP'";
		if($oCon->Query($sql)){
			if($oCon->NumFilas() > 0){
				do{
					$id = $oCon->f('id');
					$id_clpv = $oCon->f('id_clpv');
					$id_tipo = $oCon->f('id_tipo');
					$nombre = $oCon->f('nombre');
					$ruc = $oCon->f('ruc');
					$ingresos = $oCon->f('ingresos');
					$egresos = $oCon->f('egresos');
					$capacidad = $oCon->f('capacidad');
					$cuota = $oCon->f('cuota');
					$plazo = $oCon->f('plazo');
					$monto = $oCon->f('monto');
					$interes_p = $oCon->f('interes_p');
					$interes_v = $oCon->f('interes_v');
					$total = $oCon->f('total');
					$fecha = $oCon->f('fecha');
					$user_web = $oCon->f('user_web');
					
					$sHtml .='<tr>';
					$sHtml .= '<td>'.$ruc.'</td>';
					$sHtml .= '<td>'.$nombre.'</td>';
					$sHtml .= '<td align="right">'.$total.'</td>';
					$sHtml .= '<td align="center">
									<div class="btn btn-success btn-sm" onclick="seleccionaPrestamo('.$id.', '.$id_clpv.');">
										<span class="glyphicon glyphicon-ok-sign"></span>
									</div>
								</td>';
					$sHtml .= '</tr>';

				}while($oCon->SiguienteRegistro());
			}
		}
		$oCon->Free();
         
		$sHtml .= '</table>';
		$sHtml .= '</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>';
		
		$oReturn->assign("miModal", "innerHTML", $sHtml);
	} catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }
    

	return $oReturn;
}

function checkPrestamo($id, $clpv){
	//Definiciones
	global $DSN, $DSN_Ifx;

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
	$oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
	
	$oReturn = new xajaxResponse();
	
	try {
		
		$idempresa = $_SESSION['U_EMPRESA'];
        $idsucursal = $_SESSION['U_SUCURSAL'];
		unset($_SESSION['aDataGirdDir']);
		unset($_SESSION['aDataGirdDiar']);
    
		$aLabelGrid = array('Fila', 'Cliente', 'Tipo', 'Factura', 'Fec. Vence', 'Detalle', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar' );
		
		$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar', 
							'Beneficiario', 'Cuenta Bancaria', 'Cheque', 'Fecha Venc', 'Formato Cheque', 'Codigo Ctab', 'Detalle');
						
		$tran_cod = 'FAC';
		
		//query clpv
		$sqlClpv = "select clpv_nom_clpv, clpv_cod_cuen 
				from saeclpv 
				where clpv_cod_clpv = $clpv";
		$clpv_nom_clpv = consulta_string($sqlClpv, 'clpv_nom_clpv', $oIfx, '');
		$clpv_cuen = consulta_string($sqlClpv, 'clpv_cod_cuen', $oIfx, '');
		
		//query cuenta
		$sqlCuenta = "select cuen_nom_cuen from saecuen where cuen_cod_cuen = '$clpv_cuen'";
		$cuen_nom = consulta_string($sqlCuenta, 'cuen_nom_cuen', $oIfx, '');
		
		$sql = "select id, fecha, cuota, interes, amortizacion, saldo
				from credito_deta
				where id_credito = $id";
		if($oCon->Query($sql)){
			if($oCon->NumFilas() > 0){
				$i = 1;
				do{
					$id = $oCon->f('id');
					$fecha = $oCon->f('fecha');
					$cuota = $oCon->f('cuota');
					$interes = $oCon->f('nombre');
					$amortizacion = $oCon->f('ruc');
					$saldo = $oCon->f('ingresos');
					
					$fact_num = '000'.$i;
					$fec_venc = $fecha;
					
					//directorio
					$cont = count($aDataGrid);
					$aDataGrid[$cont][$aLabelGrid[0]]=floatval($cont);
					$aDataGrid[$cont][$aLabelGrid[1]]=$clpv;
					$aDataGrid[$cont][$aLabelGrid[2]]=$tran_cod;
					$aDataGrid[$cont][$aLabelGrid[3]]=$fact_num;
					$aDataGrid[$cont][$aLabelGrid[4]]=$fec_venc;
					$aDataGrid[$cont][$aLabelGrid[5]]=$det_dir;
					$aDataGrid[$cont][$aLabelGrid[6]]=1;
					$aDataGrid[$cont][$aLabelGrid[7]]=$cuota;
					$aDataGrid[$cont][$aLabelGrid[8]]=0;
					$aDataGrid[$cont][$aLabelGrid[9]]='';
					$aDataGrid[$cont][$aLabelGrid[10]]='';
					
					
					// diario
					$contd = count($aDataDiar);
					$aDataDiar[$contd][$aLabelDiar[0]]=floatval($contd);
					$aDataDiar[$contd][$aLabelDiar[1]]=$clpv_cuen;
					$aDataDiar[$contd][$aLabelDiar[2]]=$cuen_nom;
					$aDataDiar[$contd][$aLabelDiar[3]]=$doc;
					$aDataDiar[$contd][$aLabelDiar[4]]=1;
					$aDataDiar[$contd][$aLabelDiar[5]]=$cuota;
					$aDataDiar[$contd][$aLabelDiar[6]]=0;
					$aDataDiar[$contd][$aLabelDiar[7]]='';
					$aDataDiar[$contd][$aLabelDiar[8]]='';
					$aDataDiar[$contd][$aLabelDiar[9]]='';
					$aDataDiar[$contd][$aLabelDiar[10]]='';
					$aDataDiar[$contd][$aLabelDiar[11]]='';
					$aDataDiar[$contd][$aLabelDiar[12]]='';
					$aDataDiar[$contd][$aLabelDiar[13]]='';
					$aDataDiar[$contd][$aLabelDiar[14]]='';
					$aDataDiar[$contd][$aLabelDiar[15]]=$det_dir;
							
					$i++;
				}while($oCon->SiguienteRegistro());
				
				// directorio
				$_SESSION['aDataGirdDir'] = $aDataGrid;
				$sHtml = mostrar_grid_dir($idempresa, $idsucursal);
				$oReturn->assign("divDir","innerHTML",$sHtml);
				
				// diario
				$sHtml = '';
				$_SESSION['aDataGirdDiar'] = $aDataDiar;
				$sHtml = mostrar_grid_dia($idempresa, $idsucursal);
				$oReturn->assign("divDiario","innerHTML",$sHtml);
				
				$oReturn->assign("cliente_nombre","value",$clpv_nom_clpv);
				
				// total diario
				$oReturn->script("total_diario();");
			}
		}
		$oCon->Free();
         
	} catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }
    

	return $oReturn;
}

function parametrosPrestamo($aForm = ''){
	//Definiciones
	global $DSN, $DSN_Ifx;

	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        
	$oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
	
	$ifu = new Formulario;
	$ifu->DSN=$DSN_Ifx;
	
	$oReturn = new xajaxResponse();
	
	$empresa    = $aForm['empresa'];
	
	try {
		
		$sHtml .= '<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content" id="modalMateriales">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">CREDITOS CLIENTES</h4>
							</div>
						<div class="modal-body">';
		$sHtml .= '<table class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom: 0px; width: 98%" align="center">';
		$sHtml .= '<tr>';
		$sHtml .= '<th>No.</th>';
		$sHtml .= '<th>DETALLE</th>';
		$sHtml .= '<th>CUENTA CONTABLE</th>';
		$sHtml .= '</tr>';
		
		$sql = "select id, nombre, cuenta_contable
				from ctas_prestamo
				where id_empresa = $empresa";
		if($oCon->Query($sql)){
			if($oCon->NumFilas() > 0){
				$i = 1;
				do{
					$id = $oCon->f('id');
					$nombre = $oCon->f('nombre');
					$cuenta_contable = $oCon->f('cuenta_contable');
					
					$ifu->AgregarCampoTexto('cuenta_'.$id, 'Cuenta|left', false, '', 150, 100);
					$ifu->AgregarComandoAlEscribir('cuenta_'.$id, 'ventanaCuentasContables(event, '.$id.');');
				
					$sHtml .='<tr>';
					$sHtml .= '<td>'.$i++.'</td>';
					$sHtml .= '<td>'.$nombre.'</td>';
					$sHtml .= '<td>'.$ifu->ObjetoHtml('cuenta_'.$id).'</td>';
					$sHtml .= '</tr>';

				}while($oCon->SiguienteRegistro());
			}
		}
		$oCon->Free();
         
		$sHtml .= '</table>';
		$sHtml .= '</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>';
		
		$oReturn->assign("miModal", "innerHTML", $sHtml);
	} catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }
    

	return $oReturn;
}


// TRANSACCIONES
function cargar_lista_tran($aForm = '', $op) {
//Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

	//variables del formulario
    $empresa  = $aForm['empresa'];
	$sucursal = $aForm['sucursal'];
	$modulo   = null;
	
	//  LECTURA SUCIA
	//////////////
	
	if($op == 'CL'){
		$modulo = 3;
	}elseif($op == 'PV'){
		$modulo = 4;
	}	
	
    $sql = "select tran_cod_tran, tran_des_tran, trans_tip_tran 
			from saetran where
			tran_cod_empr = $empresa and
			tran_cod_sucu = $sucursal and
			tran_cod_modu = $modulo 
			order by 2";
    $i = 1;
    if ($oIfx->Query($sql)) {
        $oReturn->script('eliminar_lista_tran();');
        if ($oIfx->NumFilas() > 0) {
            do {
				$detalle =  $oIfx->f('tran_cod_tran').' || '. $oIfx->f('tran_des_tran').' || '. $oIfx->f('trans_tip_tran');
                $oReturn->script(('anadir_elemento_tran(' . $i++ . ',\'' . $oIfx->f('tran_cod_tran') . '\',  \'' . $detalle . '\' )'));
            } while ($oIfx->SiguienteRegistro());
        }
    }
	$oIfx->Free();

    return $oReturn;
}


// SUBCLIENTE
function cargar_lista_subcliente($aForm = '') {
//Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
	
    $oReturn = new xajaxResponse();

    //variables de session
	$idempresa = $_SESSION['U_EMPRESA'];
	
	//variables del formulario
	$empresa = $aForm['empresa'];
	$cliente = $aForm['clpv_cod'];
	
	//LECTURA SUCIA
	//////////////
	
    $sql = "select ccli_cod_ccli, ccli_nom_conta  
			from saeccli where
			ccli_cod_empr = $empresa and 
			ccli_cod_clpv = $cliente";
	//$oReturn->alert($sql);
    $i = 1;
    if ($oIfx->Query($sql)) {
        $oReturn->script('eliminar_lista_subcliente();');
        if ($oIfx->NumFilas() > 0) {
            do {
                $oReturn->script(('anadir_elemento_subcliente(' . $i++ . ',\'' . $oIfx->f('ccli_cod_ccli') . '\', \'' . $oIfx->f('ccli_nom_conta') . '\' )'));
            } while ($oIfx->SiguienteRegistro());
        }
    }
	$oIfx->Free();

    return $oReturn;
}


// CONTROL DE EJERCICIO
function controlPeriodoIfx($aForm = '') {
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();
	
    //variables del formulario
    $empresa = $aForm['empresa'];
	
	try{
		
		//control periodo
		$mesForm  = substr($aForm['fecha'], 5, 2);
		$anioForm = substr($aForm['fecha'], 0, 4);
		
		$controlEjercicio = controlEjercicio($empresa, $anioForm);
		
		if($controlEjercicio > 0){
		
			$controlPeriodo = controlPeriodo($empresa, $anioForm, $mesForm);
		
			if($controlPeriodo == 'C'){
				$oReturn->assign('fecha', 'value', '');
				$oReturn->alert('Mes Cerrado Consulte con el Administrador...');
			}
			
		}else{
			$oReturn->alert('No existe Ejercicio, Consulte con el Administrador...');
			$oReturn->assign('fecha', 'value', '');
		}
		
	} catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}



// 
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/* PROCESO DE REQUEST DE LAS FUNCIONES MEDIANTE AJAX NO MODIFICAR */
$xajax->processRequest();
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
?>