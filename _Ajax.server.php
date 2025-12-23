<?php
require("_Ajax.comun.php"); // No modificar esta linea
include_once './mayorizacion.inc.php';

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// S E R V I D O R   A J A X //
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/**
Herramientas de apoyo 
 */

function genera_grid($aData = null, $aLabel = null, $sTitulo = 'Reporte', $iAncho = '400', $aAccion = null, $Totales = null, $aOrden = null)
{

    unset($arrayaDataGridVisible);
    unset($arrayaDataGridTipo);
    if ($sTitulo == 'DIRECTORIO') {

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
        $arrayaDataGridVisible[12] = 'N';
        $arrayaDataGridVisible[13] = 'S';
        $arrayaDataGridVisible[14] = 'S';


        $arrayaDataGridTipo[0] = 'N';    // ID
        $arrayaDataGridTipo[1] = 'T';    // CLIENTE
        $arrayaDataGridTipo[2] = 'T';    // SUBCLIENTE
        $arrayaDataGridTipo[3] = 'T';    // TIPO
        $arrayaDataGridTipo[4] = 'T';    // FACTURA
        $arrayaDataGridTipo[5] = 'T';    // FEC VENCE
        $arrayaDataGridTipo[6] = 'N';    // DETALLE
        $arrayaDataGridTipo[7] = 'N';    // COTI
        $arrayaDataGridTipo[8] = 'N';    // DEB LOCAL
        $arrayaDataGridTipo[9] = 'N';    // CRE LOCAL
        $arrayaDataGridTipo[10] = 'N';  // DEB EXTR
        $arrayaDataGridTipo[11] = 'N';  // CRE EXTR
        $arrayaDataGridTipo[12] = 'I';  // MODIFICAR
        $arrayaDataGridTipo[13] = 'I';  // ELIMINAR
        $arrayaDataGridTipo[14] = 'N';
    } elseif ($sTitulo == 'DIARIO') {

        $arrayaDataGridVisible[0] = 'S';    //'Fila',
        $arrayaDataGridVisible[1] = 'S';    //'Cuenta',
        $arrayaDataGridVisible[2] = 'S';    //'Nombre',
        $arrayaDataGridVisible[3] = 'S';    //'Documento',
        $arrayaDataGridVisible[4] = 'S';    //'Cotizacion',
        $arrayaDataGridVisible[5] = 'S';    //'Debito Moneda Local',
        $arrayaDataGridVisible[6] = 'S';    //'Credito Moneda Local',
        $arrayaDataGridVisible[7] = 'S';    // DEBITO EXT
        $arrayaDataGridVisible[8] = 'S';    // CREDITO EXT
        $arrayaDataGridVisible[9] = 'S';    // 'Modificar',
        $arrayaDataGridVisible[10] = 'S';   // 'Eliminar',
        $arrayaDataGridVisible[11] = 'S';   // 'Beneficiario',
        $arrayaDataGridVisible[12] = 'S';   // 'Cuenta Bancaria',
        $arrayaDataGridVisible[13] = 'S';    // 'Cheque',
        $arrayaDataGridVisible[14] = 'S';    // 'Fecha Venc',
        $arrayaDataGridVisible[15] = 'S';    // 'Formato Cheque',
        $arrayaDataGridVisible[16] = 'S';    // 'Codigo Ctab',
        $arrayaDataGridVisible[17] = 'S';    // 'Detalle',
        $arrayaDataGridVisible[18] = 'S';    // 'Centro Costo',
        $arrayaDataGridVisible[19] = 'S';    // 'Centro Actividad'
        $arrayaDataGridVisible[20] = 'S';
        $arrayaDataGridVisible[21] = 'S';

        $arrayaDataGridTipo[0] = 'N';
        $arrayaDataGridTipo[1] = 'T';
        $arrayaDataGridTipo[2] = 'T';
        $arrayaDataGridTipo[3] = 'T';
        $arrayaDataGridTipo[4] = 'N';
        $arrayaDataGridTipo[5] = 'N';
        $arrayaDataGridTipo[6] = 'N';
        $arrayaDataGridTipo[7] = 'N';
        $arrayaDataGridTipo[8] = 'N';
        $arrayaDataGridTipo[9] = 'I';
        $arrayaDataGridTipo[10] = 'I';
        $arrayaDataGridTipo[11] = 'T';
        $arrayaDataGridTipo[12] = 'T';
        $arrayaDataGridTipo[13] = 'T';
        $arrayaDataGridTipo[14] = 'T';
        $arrayaDataGridTipo[15] = 'T';
        $arrayaDataGridTipo[16] = 'T';
        $arrayaDataGridTipo[17] = 'T';
        $arrayaDataGridTipo[18] = 'T';
        $arrayaDataGridTipo[19] = 'T';
        $arrayaDataGridTipo[20] = 'N';
        $arrayaDataGridTipo[21] = 'N';
    } elseif ($sTitulo == 'RETENCION') {

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
        $arrayaDataGridVisible[15] = 'N';
        $arrayaDataGridVisible[16] = 'S';
        $arrayaDataGridVisible[17] = 'S';

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
        $arrayaDataGridTipo[10] = 'N';
        $arrayaDataGridTipo[11] = 'N';
        $arrayaDataGridTipo[12] = 'N';
        $arrayaDataGridTipo[13] = 'N';
        $arrayaDataGridTipo[14] = 'N';
        $arrayaDataGridTipo[15] = 'I';
        $arrayaDataGridTipo[16] = 'I';
        $arrayaDataGridTipo[17] = 'N';
    }



    if (is_array($aData) && is_array($aLabel)) {
        $iLabel = count($aLabel);
        $iData = count($aData);
        $sHtml = '';
        $sHtml .= '<form id="DataGrid">';
        $sHtml .= '<table class="table table-striped table-condensed table-bordered" style="width: 100%; margin-top: 10px;" align="center">';
        $sHtml .= '<tr>';
        $sHtml .= '<td colspan="' . $iLabel . '">' . $sTitulo . '</td>';
        $sHtml .= '</tr>';
        $sHtml .= '<tr class="warning"><td colspan="' . $iLabel . '">Su consulta genero ' . $iData . ' registros de resultado</td></tr>';
        $sHtml .= '<tr>';

        // Genera Columnas de Grid
        for ($i = 0; $i < $iLabel; $i++) {
            $sLabel = explode('|', $aLabel[$i]);
            if ($sLabel[1] == '') {

                $aDataVisible = $arrayaDataGridVisible[$i];
                if ($aDataVisible == 'S') {
                    $aDataVisible = '';
                } else {
                    $aDataVisible = 'none;';
                }

                $sHtml .= '<td class="info" align="center" style="display: ' . $aDataVisible . '">' . $sLabel[0] . '</th>';
            } else {
                if ($sLabel[1] == $aOrden[0]) {
                    if ($aOrden[1] == 'ASC') {
                        $sLabel[1] .= '|DESC';
                        $sImg = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/ico_down.png" align="absmiddle" />';
                    } else {
                        $sLabel[1] .= '|ASC';
                        $sImg = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/ico_up.png" align="absmiddle" />';
                    }
                } else {
                    $sImg = '';
                    $sLabel[1] .= '|ASC';
                }

                $sHtml .= '<th onClick="xajax_' . $sLabel[2] . '(xajax.getFormValues(\'form1\'),\'' . $sLabel[1] . '\')"
								style="cursor: hand !important; cursor: pointer !important;" >' . $sLabel[0] . ' ';
                $sHtml .= $sImg;
                $sHtml .= '</td>';
            }
        }
        $sHtml .= '</tr>';

        // Genera Filas de Grid
        for ($i = 0; $i < $iData; $i++) {
            $sHtml .= '<tr>';
            for ($j = 0; $j < $iLabel; $j++) {

                $campo = $aData[$i][$aLabel[$j]];

                $aDataVisible = $arrayaDataGridVisible[$j];
                if ($aDataVisible == 'S') {
                    $aDataVisible = '';
                } else {
                    $aDataVisible = 'none;';
                }

                $aDataTipo = $arrayaDataGridTipo[$j];
                $alignCampo = 'left';
                if ($aDataTipo == 'T') {
                    $alignCampo = 'left';
                } elseif ($aDataTipo == 'N') {
                    if (is_numeric($campo)) {
                        $campo = number_format($campo, 2, '.', '');
                    }
                    $alignCampo = 'right';
                } elseif ($aDataTipo == 'I') {
                    $alignCampo = 'center';
                }

                $sHtml .= '<td align="' . $alignCampo . '" style="display: ' . $aDataVisible . ';">' . $campo . '</td>';
            }
            $sHtml .= '</tr>';
        }

        //Totales
        $sHtml .= '<tr class="danger">';
        if (is_array($Totales)) {
            for ($i = 0; $i < $iLabel; $i++) {
                if ($i == 0)
                    $sHtml .= '<td class="fecha_letra" align="right">TOTALES</td>';
                else {
                    if ($Totales[$i] == '')
                        if ($Totales[$i] == '0.00')
                            $sHtml .= '<td align="right" class="fecha_letra">' . number_format($Totales[$i], 2, '.', ',') . '</td>';
                        else
                            $sHtml .= '<td align="right"></th>';
                    else
                        $sHtml .= '<td align="right" class="fecha_letra">' . number_format($Totales[$i], 2, '.', ',') . '</td>';
                }
            }
        }
        $sHtml .= '</tr>';

        //Saldos
        unset($_SESSION['ARRAY_SALDOS_TMP']);
        unset($arraySaldo);
        if ($sTitulo == 'DIARIO') {
            $sHtml .= '<tr class="danger">';
            $saldoDeb = 0;
            $saldoDeb_Ext = 0;
            $saldoCre = 0;
            $saldoCre_Ext = 0;
            if (is_array($Totales)) {
                $valDeb = 0;
                $valDeb_Ext = 0;
                $valCre = 0;
                $valCre_Ext = 0;
                for ($i = 0; $i < $iLabel; $i++) {
                    if ($i == 5) {
                        $valDeb += $Totales[$i];
                    } elseif ($i == 6) {
                        $valCre += $Totales[$i];
                    } elseif ($i == 7) {
                        $valDeb_Ext += $Totales[$i];
                    } elseif ($i == 8) {
                        $valCre_Ext += $Totales[$i];
                    }
                } //fin for

                if ($valDeb > $valCre) {
                    $saldoCre = $valCre - $valDeb;
                    $arraySaldo[] = array('CR', $saldoCre);
                } elseif ($valDeb < $valCre) {
                    $saldoDeb = round($valDeb - $valCre, 2);
                    $arraySaldo[] = array('DB', $saldoDeb);
                }


                // MONDA Ext
                if ($valDeb_Ext > $valCre_Ext) {
                    $saldoCre_Ext = round($valCre_Ext - $valDeb_Ext, 2);
                } elseif ($valDeb_Ext < $valCre_Ext) {
                    $saldoDeb_Ext = round($valDeb_Ext - $valCre_Ext, 2);
                }

                $sHtml .= '<td class="fecha_letra" align="right">SALDO</td>';
                $sHtml .= '<td colspan="4"></td>';
                $sHtml .= '<td class="fecha_letra" align="right" >' . $saldoDeb . '</td>';
                $sHtml .= '<td class="fecha_letra" align="right" >' . $saldoCre . '</td>';
                $sHtml .= '<td class="fecha_letra" align="right" >' . $saldoDeb_Ext . '</td>';
                $sHtml .= '<td class="fecha_letra" align="right" >' . $saldoCre_Ext . '</td>';
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
function genera_formulario($sAccion = 'nuevo', $aForm = '')
{
    //  Definiciones
    global $DSN_Ifx, $DSN;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;

    $fu = new Formulario;
    $fu->DSN = $DSN;

    $oReturn = new xajaxResponse();

    $idempresa = $aForm['empresa'];
    $idsucursal = $aForm['sucursal'];
    $_SESSION['CuentaUtilidad'] = 'N';

    $diaHoy = date("Y-m-d");
    unset($_SESSION['RRHH_EMPL_CAB_PRES']);
    unset($_SESSION['RRHH_EMPL_CAB_PRES_SERIAL']);

    switch ($sAccion) {
        case 'nuevo':
            $idempresa = $_SESSION['U_EMPRESA'];
            $idsucursal = $_SESSION['U_SUCURSAL'];

            $ifu->AgregarCampoListaSQL('empresa', 'Empresa|left', "SELECT EMPR_COD_EMPR, EMPR_NOM_EMPR FROM SAEEMPR 
                                                                                where empr_cod_empr = $idempresa ORDER BY 2", true, 170, 150);
            $ifu->AgregarComandoAlCambiarValor('empresa', 'cargar_sucu();');
            $ifu->AgregarCampoListaSQL(
                'sucursal',
                'Sucursal|left',
                "select sucu_cod_sucu, sucu_nom_sucu 
                                                                                    from saesucu where
                                                                                    sucu_cod_empr = $idempresa order by 1 ",
                true,
                170,
                150
            );
            $ifu->AgregarComandoAlCambiarValor('sucursal', 'cargar_tran();');

            $ifu->cCampos["empresa"]->xValor = $idempresa;
            $ifu->cCampos["sucursal"]->xValor = $idsucursal;

            $ifu->AgregarCampoListaSQL('tipo_doc', 'Tipo Documento|left', "select tidu_cod_tidu, 
                                                                                        tidu_des_tidu
                                                                                        from saetidu where
                                                                                        tidu_cod_empr = $idempresa and
                                                                                        tidu_cod_modu = 5 and
                                                                                        tidu_tip_tidu = 'EG'
                                                                                        order by tidu_cod_tidu desc ", true, 150, 150);

            $sql = "select tidu_cod_tidu, 
                                    tidu_des_tidu
                                    from saetidu where
                                    tidu_cod_empr = $idempresa and
                                    tidu_cod_modu = 5 and
                                    tidu_tip_tidu = 'EG' and
                                    tidu_def_tidu = 'D' 
                                    order by tidu_cod_tidu desc
                                ";
            $tidu = consulta_string_func($sql, 'tidu_cod_tidu', $oIfx, '');
            $ifu->cCampos["tipo_doc"]->xValor = $tidu;

            $ifu->AgregarCampoFecha('fecha', 'Fecha Registro Contable|left', true, date('Y') . '/' . date('m') . '/' . date('d'));

            $ifu->AgregarCampoTexto('ruc', 'Ruc|left', true, '', 100, 120);
            $ifu->AgregarCampoTexto('cliente_nombre', 'Beneficiario|left', false, '', 300, 200);
            $ifu->AgregarComandoAlEscribir('cliente_nombre', 'autocompletar(' . $idempresa . ', event, 0 );form1.cliente_nombre.value=form1.cliente_nombre.value.toUpperCase();');
            $ifu->AgregarCampoTexto('cliente', 'Cliente|left', true, '', 50, 50);
            $ifu->AgregarComandoAlPonerEnfoque('cliente', 'this.blur()');
            $ifu->AgregarCampoListaSQL('empleado', 'Cobrador|left', "select empl_cod_empl, empl_ape_nomb 
                                                                                        from saeempl where
                                                                                        empl_cod_empr = $idempresa and
                                                                                        empl_cod_eemp = 'A' order by 2 ", false, 170, 150);
            $ifu->AgregarCampoTexto('valor', 'Valor|left', true, 0, 180, 150);
            $ifu->AgregarCampoListaSQL('formato', 'Formato|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                    from saeftrn where
                                                                                    ftrn_cod_empr = $idempresa and
                                                                                    ftrn_cod_modu = 5 and
                                                                                    ftrn_tip_movi = 'EG' ", true, 150, 150);
            $ifu->AgregarComandoAlCambiarValor('formato', 'ftrn_tip_movi22();');
            $ifu->AgregarCampoTexto('ftrn_tip_movi', 'ftrn_tip_movi|left', false, 'EGRESO', 180, 150);

            $ifu->AgregarCampoLista('deas', 'Deas|left', false, 170, 150);
            $sql = "select deas_cod_deas,  saedeas.deas_des_deas from saedeas order by 2";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $ifu->AgregarOpcionCampoLista('deas', $oIfx->f('deas_cod_deas') . ' ' . $oIfx->f('deas_des_deas'), $oIfx->f('deas_cod_deas'));
                    } while ($oIfx->SiguienteRegistro());
                }
            }
            $oIfx->Free();

            $ifu->AgregarCampoTexto('detalle', 'Detalle|left', true, '', 300, 200);
            $ifu->AgregarComandoAlEscribir('detalle', 'cargar_detalle();');
            $ifu->AgregarCampoTexto('asto_cod', 'Asiento|left', false, '', 120, 120);
            $ifu->AgregarCampoTexto('compr_cod', 'Comprobante N.-|left', false, '', 120, 120);
            $ifu->AgregarComandoAlPonerEnfoque('asto_cod', 'this.blur()');
            $ifu->AgregarComandoAlPonerEnfoque('compr_cod', 'this.blur()');

            unset($_SESSION['aDataGirdDir']);
            $oReturn->assign("divDir", "innerHTML", "");

            unset($_SESSION['aDataGirdDiar']);
            $oReturn->assign("divDiario", "innerHTML", "");

            unset($_SESSION['aDataGirdRet']);
            $oReturn->assign("divRet", "innerHTML", "");

            // DIRECTORIO
            $ifu->AgregarCampoTexto('clpv_nom', 'Cliente - Proveedor|left', false, '', 200, 200);
            $ifu->AgregarComandoAlEscribir('clpv_nom', 'autocompletar(' . $idempresa . ', event, 1 );form1.clpv_nom.value=form1.clpv_nom.value.toUpperCase();');

            $ifu->AgregarCampoOculto('clpv_cod', '');

            $ifu->AgregarCampoLista('tran', 'Tipo|left', false, 170, 150);
            $sql = "select tran_cod_tran, tran_des_tran, trans_tip_tran from saetran where
                                    tran_cod_empr = $idempresa and
                                    tran_cod_sucu = $idsucursal and
                                    tran_cod_modu = 4 order by 2 ";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $tran_des = $oIfx->f('tran_cod_tran') . ' || ' . $oIfx->f('tran_des_tran') . ' || ' . $oIfx->f('trans_tip_tran');
                        $ifu->AgregarOpcionCampoLista('tran', $tran_des, $oIfx->f('tran_cod_tran'));
                    } while ($oIfx->SiguienteRegistro());
                }
            }
            $oIfx->Free();

            $sql = "select pccp_aut_pago from saepccp where pccp_cod_empr = $idempresa ";
            $tran_cod_tran = consulta_string_func($sql, 'pccp_aut_pago', $oIfx, 0);
            // $ifu->cCampos["tran"]->xValor = $tran_cod_tran;
            $ifu->cCampos["tran"]->xValor = 'CAN';

            $ifu->AgregarCampoTexto('factura', 'Factura|left', false, '', 140, 200);
            $ifu->AgregarComandoAlEscribir('factura', 'facturas(' . $idempresa . ', event );');

            $ifu->AgregarCampoTexto('fact_valor', 'Valor|left', false, 0, 100, 100);
            $ifu->AgregarComandoAlCambiarValor('fact_valor', 'mascara(this,cpf)');
            $ifu->AgregarComandoAlEscribir('fact_valor', 'enter_dir(event);');

            $ifu->AgregarCampoTexto('det_dir', 'Detalle|left', false, '', 200, 100);

            // RETENCION
            $ifu->AgregarCampoTexto('cod_ret', 'Cta Ret.|left', false, '', 90, 9);
            $ifu->AgregarComandoAlEscribir('cod_ret', 'cod_retencion(' . $idempresa . ', event );');

            $ifu->AgregarCampoTexto('fact_ret', 'Factura|left', false, '', 150, 200);
            $ifu->AgregarComandoAlEscribir('fact_ret', 'fact_retencion(' . $idempresa . ', event );');
            $ifu->AgregarCampoTexto('ret_clpv', 'Ret. Cliente|left', false, '', 50, 200);
            $ifu->AgregarCampoNumerico('ret_porc', 'Porc.(%)|left', false, '', 50, 50);
            $ifu->AgregarComandoAlEscribir('ret_porc', 'calculaValorRetenido();');

            $ifu->AgregarCampoTexto('ret_base', 'Base Imponible|left', false, '', 100, 200);
            $ifu->AgregarComandoAlEscribir('ret_base', 'calculaValorRetenido();');
            $ifu->AgregarComandoAlCambiarValor('ret_base', 'mascara(this,cpf)');

            $ifu->AgregarCampoTexto('ret_val', 'Valor|left', false, '', 100, 200);
            $ifu->AgregarComandoAlEscribir('ret_val', 'mascara(this,cpf)');

            $ifu->AgregarCampoNumerico('ret_num', 'N.- Retencion|left', false, '', 100, 200);
            $ifu->AgregarComandoAlCambiarValor('ret_num', 'numero_ret();');
            $ifu->AgregarCampoTexto('ret_det', 'Detalle|left', false, '', 150, 200);
            $ifu->AgregarCampoTexto('cta_deb', 'Debito|left', false, '', 50, 200);
            $ifu->AgregarCampoTexto('cta_cre', 'Credito|left', false, '', 50, 200);
            $ifu->AgregarCampoTexto('tipo', 'tipo|left', false, '', 50, 200);

            $ifu->AgregarCampoNumerico('cotizacion', 'Cotizacion|left', false, 1, 70, 9);
            $ifu->AgregarCampoNumerico('cotizacion_ext', 'Cotizacion Ext.|left', false, 1, 70, 9);

            $ifu->AgregarCampoNumerico('cotizacion_ret', 'Cotizacion|left', false, 1, 50, 9);


            // CUENTAS DASI
            $ifu->AgregarCampoOculto('cod_cta', '');

            $ifu->AgregarCampoTexto('nom_cta', 'Nombre Cta|left', false, '', 150, 200);
            $ifu->AgregarComandoAlEscribir('nom_cta', 'auto_dasi(' . $idempresa . ', event, 0 );form1.nom_cta.value=form1.nom_cta.value.toUpperCase();');
            $ifu->AgregarCampoTexto('val_cta', 'Valor|left', false, '', 100, 200);
            $ifu->AgregarComandoAlCambiarValor('val_cta', 'mascara(this,cpf)');
            $ifu->AgregarComandoAlEscribir('val_cta', 'enter_dasi(event);');

            $ifu->AgregarCampoLista('crdb', 'Tipo|left', false, '80');
            $ifu->AgregarOpcionCampoLista('crdb', 'CREDITO', 'CR');
            $ifu->AgregarOpcionCampoLista('crdb', 'DEBITO', 'DB');
            $ifu->AgregarCampoTexto('documento', 'Documento|left', false, '', 80, 10);
            $ifu->AgregarComandoAlCambiarValor('documento', 'documento_digito( )');

            //ASIENTO CONTABLE
            $fu->AgregarCampoTexto('ejer_cod', 'Ejericio|left', false, '', 100, 100);
            $fu->AgregarCampoTexto('prdo_cod', 'Periodo|left', false, '', 100, 100);

            // CHEQUE
            $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');
            $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, '', 200, 150);
            $fu->AgregarCampoTexto('cta_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
            $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
            $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, '150');

            // MONEDA
            $ifu->AgregarCampoListaSQL('moneda', 'Moneda|left', "select mone_cod_mone, mone_des_mone  from saemone where mone_cod_empr = $idempresa ", true, 150, 150);
            $ifu->AgregarComandoAlCambiarValor('moneda', 'cargar_coti();');

            $sql = "select pcon_mon_base, pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
            $mone_cod = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
            $ifu->cCampos["moneda"]->xValor = $mone_cod;

            // COTIZACION MONEDA EXTRANJERA
            $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');
            $sql = "select tcam_val_tcam from saetcam where
									mone_cod_empr = $idempresa and
									tcam_cod_mone = $mone_extr and
									tcam_fec_tcam in (
														select max(tcam_fec_tcam)  from saetcam where
																mone_cod_empr = $idempresa and
																tcam_cod_mone = $mone_extr
													)  ";

            $coti = consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);
            $ifu->cCampos["cotizacion_ext"]->xValor = $coti;


            $ifu->AgregarCampoTexto('detalla_diario', 'Detalle|left', false, '', 170, 200);


            // CENTRO COSTOS
            $ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", false, 150, 150);

            // CENTRO DE ACTIVIDAD
            $ifu->AgregarCampoListaSQL('actividad', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 150, 150);

            //campo por defecto formato
            $sql = "select ftrn_cod_ftrn 
								from saeftrn where
								ftrn_cod_empr = $idempresa and
								ftrn_cod_modu = 5 and
								ftrn_tip_movi = 'EG'";
            $tipoForDef = consulta_string($sql, 'ftrn_cod_ftrn', $oIfx, 0);
            $ifu->cCampos["formato"]->xValor = $tipoForDef;

            $ifu->AgregarCampoLista('ccli', 'SubCliente|left', false, 170, 150);

            $ifu->AgregarCampoCheck('clpv_empl', 'Empleado S/N', false, 'N');

            break;
        case 'sucursal':

            $ifu->AgregarCampoListaSQL('empresa', 'Empresa|left', "SELECT EMPR_COD_EMPR, EMPR_NOM_EMPR FROM SAEEMPR ORDER BY 2", true, 170, 150);
            $ifu->AgregarComandoAlCambiarValor('empresa', 'cargar_sucu();');
            $ifu->AgregarCampoListaSQL('sucursal', 'Sucursal|left', "select sucu_cod_sucu, sucu_nom_sucu 
                                                                                        from saesucu where
                                                                                        sucu_cod_empr = $idempresa order by 1 ", true, 170, 150);
            $ifu->AgregarComandoAlCambiarValor('sucursal', 'cargar_tran();');
            $ifu->AgregarCampoListaSQL('tipo_doc', 'Tipo Documento|left', "select tidu_cod_tidu, 
                                                                                            tidu_des_tidu
                                                                                            from saetidu where
                                                                                            tidu_cod_empr = $idempresa and
                                                                                            tidu_cod_modu = 5 and
                                                                                            tidu_tip_tidu = 'EG' 
                                                                                            order by tidu_cod_tidu desc", true, 150, 150);
            $ifu->AgregarCampoFecha('fecha', 'Fecha Registro Contable|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
            $ifu->AgregarCampoTexto('ruc', 'Ruc|left', true, '', 100, 120);
            $ifu->AgregarCampoTexto('cliente_nombre', 'Beneficiario|left', true, '', 350, 200);
            $ifu->AgregarComandoAlEscribir('cliente_nombre', 'autocompletar(' . $idempresa . ', event, 0 );form1.cliente_nombre.value=form1.cliente_nombre.value.toUpperCase();');
            $ifu->AgregarCampoTexto('cliente', 'Cliente|left', true, '', 50, 50);
            $ifu->AgregarComandoAlPonerEnfoque('cliente', 'this.blur()');
            $ifu->AgregarComandoAlCambiarValor('cliente', 'cargar_datos()');

            $ifu->AgregarCampoListaSQL('empleado', 'Cobrador|left', "select empl_cod_empl, empl_ape_nomb from saeempl where
                                                                                        empl_cod_empr = $idempresa and
                                                                                        empl_cod_eemp = 'A' order by 2 ", true, 170, 150);
            $ifu->AgregarCampoNumerico('valor', 'Valor|left', true, 0, 150, 150);
            $ifu->AgregarCampoListaSQL('formato', 'Formato|left', "select ftrn_cod_ftrn, ftrn_des_ftrn from saeftrn where
                                                                                                ftrn_cod_empr = $idempresa and
                                                                                                ftrn_cod_modu = 5 and
                                                                                                ftrn_tip_movi = 'EG' ", true, 150, 150);
            $ifu->AgregarCampoLista('deas', 'Deas|left', false, 170, 150);
            $sql = "select deas_cod_deas,  saedeas.deas_des_deas from saedeas order by 2";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $ifu->AgregarOpcionCampoLista('deas', $oIfx->f('deas_cod_deas') . ' ' . $oIfx->f('deas_des_deas'), $oIfx->f('deas_cod_deas'));
                    } while ($oIfx->SiguienteRegistro());
                }
            }
            $oIfx->Free();

            $ifu->AgregarCampoTexto('detalle', 'Detalle|left', true, '', 350, 200);
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

            $ifu->AgregarCampoLista('tran', 'Tipo|left', false, 170, 150);

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
            $ifu->AgregarComandoAlEscribir('ret_porc', 'calculaValorRetenido();');

            $ifu->AgregarCampoNumerico('ret_base', 'Base Imponible|left', false, '', 50, 200);
            $ifu->AgregarComandoAlEscribir('ret_base', 'calculaValorRetenido();');

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
            $ifu->AgregarOpcionCampoLista('crdb', 'CREDITO', 'CR');
            $ifu->AgregarOpcionCampoLista('crdb', 'DEBITO', 'DB');

            //ASIENTO CONTABLE
            $fu->AgregarCampoTexto('ejer_cod', 'Ejericio|left', false, '', 100, 100);
            $fu->AgregarCampoTexto('prdo_cod', 'Periodo|left', false, '', 100, 100);

            // CHEQUE
            $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');
            $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, '', 200, 150);
            $fu->AgregarCampoTexto('cta_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
            $fu->AgregarCampoFecha(
                'fec_cheq',
                'Fecha Vencimiento|left',
                true,
                date('Y') . '/' . date('m') . '/' . date('d')
            );
            $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, '150');


            // MONEDA
            $ifu->AgregarCampoListaSQL('moneda', 'Moneda|left', "select mone_cod_mone, mone_des_mone  from saemone where mone_cod_empr = $idempresa ", true, 150, 150);
            $ifu->AgregarComandoAlCambiarValor('moneda', 'cargar_coti();');

            $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
            $mone_cod = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
            $ifu->cCampos["moneda"]->xValor = $mone_cod;

            $ifu->AgregarCampoNumerico('cotizacion', 'Cotizacion|left', false, 1, 50, 9);
            $ifu->AgregarCampoNumerico('cotizacion_ext', 'Cotizacion Ext.|left', false, 1, 50, 9);

            $ifu->AgregarCampoNumerico('cotizacion_ret', 'Cotizacion|left', false, 1, 50, 9);

            $ifu->AgregarCampoTexto('detalla_diario', 'Detalle|left', false, '', 170, 200);

            $ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", true, 150, 150);

            // CENTRO COSTOS
            $ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", false, 150, 150);

            // CENTRO DE ACTIVIDAD
            $ifu->AgregarCampoListaSQL('actividad', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 150, 150);



            $ifu->AgregarCampoLista('ccli', 'SubCliente|left', false, 170, 150);

            $ifu->AgregarCampoCheck('clpv_empl', 'Empleado S/N', false, 'N');

            $ifu->AgregarComandoAlCambiarValor('formato', 'ftrn_tip_movi22();');
            $ifu->AgregarCampoTexto('ftrn_tip_movi', 'ftrn_tip_movi|left', false, 'ftrn_tip_movi', 180, 150);
            break;
        case 'tran':

            $ifu->AgregarCampoListaSQL('empresa', 'Empresa|left', "SELECT EMPR_COD_EMPR, EMPR_NOM_EMPR FROM SAEEMPR ORDER BY 2", true, 170, 150);
            $ifu->AgregarComandoAlCambiarValor('empresa', 'cargar_sucu();');
            $ifu->AgregarCampoListaSQL('sucursal', 'Sucursal|left', "select sucu_cod_sucu, sucu_nom_sucu from saesucu where
                                                                                        sucu_cod_empr = $idempresa order by 1 ", true, 170, 150);
            $ifu->AgregarComandoAlCambiarValor('sucursal', 'cargar_tran();');
            $ifu->AgregarCampoListaSQL('tipo_doc', 'Tipo Documento|left', "select tidu_cod_tidu, 
                                                                                            tidu_des_tidu
                                                                                            from saetidu where
                                                                                            tidu_cod_empr = $idempresa and
                                                                                            tidu_cod_modu = 5 and
                                                                                            tidu_tip_tidu = 'EG' 
                                                                                            order by tidu_cod_tidu desc", true, 150, 150);
            $ifu->AgregarCampoFecha('fecha', 'Fecha Registro Contable|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
            $ifu->AgregarCampoTexto('ruc', 'Ruc|left', true, '', 100, 120);
            $ifu->AgregarCampoTexto('cliente_nombre', 'Beneficiario|left', true, '', 350, 200);
            $ifu->AgregarComandoAlEscribir('cliente_nombre', 'autocompletar(' . $idempresa . ', event, 0 );form1.cliente_nombre.value=form1.cliente_nombre.value.toUpperCase();');
            $ifu->AgregarCampoTexto('cliente', 'Cliente|left', true, '', 50, 50);
            $ifu->AgregarComandoAlPonerEnfoque('cliente', 'this.blur()');
            $ifu->AgregarComandoAlCambiarValor('cliente', 'cargar_datos()');

            $ifu->AgregarCampoListaSQL('empleado', 'Cobrador|left', "select empl_cod_empl, empl_ape_nomb from saeempl where
                                                                                        empl_cod_empr = $idempresa and
                                                                                        empl_cod_eemp = 'A' order by 2 ", true, 170, 150);
            $ifu->AgregarCampoNumerico('valor', 'Valor|left', true, 0, 150, 150);
            $ifu->AgregarCampoListaSQL('formato', 'Formato|left', "select ftrn_cod_ftrn, ftrn_des_ftrn from saeftrn where
                                                                                                ftrn_cod_empr = $idempresa and
                                                                                                ftrn_cod_modu = 5 and
                                                                                                ftrn_tip_movi = 'EG' ", true, 150, 150);
            $ifu->AgregarCampoLista('deas', 'Deas|left', false, 170, 150);
            $sql = "select deas_cod_deas,  saedeas.deas_des_deas from saedeas order by 2";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $ifu->AgregarOpcionCampoLista('deas', $oIfx->f('deas_cod_deas') . ' ' . $oIfx->f('deas_des_deas'), $oIfx->f('deas_cod_deas'));
                    } while ($oIfx->SiguienteRegistro());
                }
            }
            $oIfx->Free();

            $ifu->AgregarCampoTexto('detalle', 'Detalle|left', true, '', 350, 200);
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
            $ifu->AgregarCampoLista('tran', 'Tipo|left', false, 170, 150);
            $sql = "select tran_cod_tran, tran_des_tran, trans_tip_tran from saetran where
                                    tran_cod_empr = $idempresa and
                                    tran_cod_sucu = $idsucursal and
                                    tran_cod_modu = 4 order by 2 ";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $tran_des = $oIfx->f('tran_cod_tran') . ' || ' . $oIfx->f('tran_des_tran') . ' || ' . $oIfx->f('trans_tip_tran');
                        $ifu->AgregarOpcionCampoLista('tran', $tran_des, $oIfx->f('tran_cod_tran'));
                    } while ($oIfx->SiguienteRegistro());
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
            $ifu->AgregarComandoAlEscribir('ret_porc', 'calculaValorRetenido();');

            $ifu->AgregarCampoNumerico('ret_base', 'Base Imponible|left', false, '', 50, 200);
            $ifu->AgregarComandoAlEscribir('ret_base', 'calculaValorRetenido();');

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
            $ifu->AgregarOpcionCampoLista('crdb', 'CREDITO', 'CR');
            $ifu->AgregarOpcionCampoLista('crdb', 'DEBITO', 'DB');
            $ifu->AgregarCampoTexto('documento', 'Documento|left', false, '', 150, 10);


            //ASIENTO CONTABLE
            $fu->AgregarCampoTexto('ejer_cod', 'Ejericio|left', false, '', 100, 100);
            $fu->AgregarCampoTexto('prdo_cod', 'Periodo|left', false, '', 100, 100);

            // CHEQUE
            $fu->AgregarCampoCheck('cheque', 'Cheque|left', true, 'N');
            $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, '', 200, 150);
            $fu->AgregarCampoTexto('cta_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
            $fu->AgregarCampoFecha(
                'fec_cheq',
                'Fecha Vencimiento|left',
                true,
                date('Y') . '/' . date('m') . '/' . date('d')
            );
            $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, '150');

            // MONEDA
            $ifu->AgregarCampoListaSQL('moneda', 'Moneda|left', "select mone_cod_mone, mone_des_mone  from saemone where mone_cod_empr = $idempresa ", true, 150, 150);
            $ifu->AgregarComandoAlCambiarValor('moneda', 'cargar_coti();');

            $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
            $mone_cod = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');
            $ifu->cCampos["moneda"]->xValor = $mone_cod;

            $ifu->AgregarCampoNumerico('cotizacion', 'Cotizacion|left', false, 1, 50, 9);
            $ifu->AgregarCampoNumerico('cotizacion_ext', 'Cotizacion Ext.|left', false, 1, 50, 9);

            $ifu->AgregarCampoNumerico('cotizacion_ret', 'Cotizacion|left', false, 1, 50, 9);

            $ifu->AgregarCampoTexto('detalla_diario', 'Detalle|left', false, '', 170, 200);

            $ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", true, 150, 150);

            // CENTRO COSTOS
            $ifu->AgregarCampoListaSQL('ccosn', 'Centro Costo|left', "select ccosn_cod_ccosn, ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn from saeccosn where
																						ccosn_cod_empr  = $idempresa and
																						ccosn_mov_ccosn = 1
																						order by 1 ", false, 150, 150);

            // CENTRO DE ACTIVIDAD
            $ifu->AgregarCampoListaSQL('actividad', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2", false, 150, 150);

            $ifu->AgregarCampoLista('ccli', 'SubCliente|left', false, 170, 150);

            $ifu->AgregarCampoCheck('clpv_empl', 'Empleado S/N', false, 'N');

            $ifu->AgregarComandoAlCambiarValor('formato', 'ftrn_tip_movi22();');
            $ifu->AgregarCampoTexto('ftrn_tip_movi', 'ftrn_tip_movi|left', false, 'ftrn_tip_movi', 180, 150);

            break;
    }

    $sHtml .= '<table class="table table-striped table-condensed" style="width: 100%; margin-bottom: 0px;" align="center">
                        <tr>
							<td colspan="5">
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
									<div style="display: none;" class="btn btn-primary btn-sm" onclick="parametrosPrestamo();">
										<span class="glyphicon glyphicon-th-large"></span>
										Parametros
									</div>
									<div style="display: none;"  class="btn btn-primary btn-sm" onclick="prestamosClientes();">
										<span class="glyphicon glyphicon-usd"></span>
										Genera Prestamo
									</div>
									<div style="display: none;"  class="btn btn-primary btn-sm" onclick="prestamoAprobado();">
										<span class="glyphicon glyphicon-usd"></span>
										Prestamo Aprobado
									</div>
									<div  class="btn btn-primary btn-sm" onclick="prestamo();">
										<span class="glyphicon glyphicon-usd"></span>
										Prestamo Empleado
									</div>
									<div class="btn btn-primary btn-sm" onclick="nomina();">
										<span class="glyphicon glyphicon-th-list"></span>
										Nomina Empleado
									</div>
									<div class="btn btn-primary btn-sm" onclick="autocompletar_btn();">
										<span class="glyphicon glyphicon-credit-card"></span>
										Pagos Aprobados
									</div>
                                    <div class="btn btn-primary btn-sm" onclick="abre_modal_adjuntos();">
										<span class="glyphicon glyphicon-random"></span>
										Adjuntos
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
                       <td colspan="6" class="bg-primary" align="center">COMPROBANTE DE EGRESO</td>
                   </tr>';
    $sHtml .= '<tr class="bg-info">
						<td class="bg-info"></td>
						<td class="bg-info"></td>
						<td class="bg-info" align="left" colspan="3" style="font-size: 12px;">
								<span> Asiento Contable: ' . $ifu->ObjetoHtml('asto_cod') . '</span>
								<span> Comprobante: ' . $ifu->ObjetoHtml('compr_cod') . '</span>
						</td>
						<td class="bg-info" align="right" class="fecha_letra">Fecha Registro Contable  <input type="date" name="fecha" id="fecha" step="1" value="' . $diaHoy . '" onchange="controlPeriodoIfx()"></td>
					</tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('empresa') . '</td> 
						<td>' . $ifu->ObjetoHtml('empresa') . '</td>
						<td>' . $ifu->ObjetoHtmlLBL('sucursal') . '</td>
						<td>' . $ifu->ObjetoHtml('sucursal') . '</td>     
						<td>' . $ifu->ObjetoHtmlLBL('tipo_doc') . '</td>
						<td>' . $ifu->ObjetoHtml('tipo_doc') . '</td>   
						
                   </tr>';
    $sHtml .= '<tr>
                        <input type="text" name="tipo_clpv" id="tipo_clpv" style="display: none" />
						<td>' . $ifu->ObjetoHtmlLBL('cliente_nombre') . '</td> 
						<td>
							' . $ifu->ObjetoHtml('cliente_nombre') . '
							Empleado S/N:
							' . $ifu->ObjetoHtml('clpv_empl') . '
                            <div class="btn btn-success btn-sm" onclick="cargarModalOc();" title="Visualizar Ordenes de Compra del Cliente/Proveedor">
								<span class="glyphicon glyphicon-folder-open"> </span>
							</div>
						</td>
						<td>' . $ifu->ObjetoHtmlLBL('empleado') . '</td>
						<td>' . $ifu->ObjetoHtml('empleado') . '</td> 
						<td>' . $ifu->ObjetoHtmlLBL('deas') . '</td>
						<td>' . $ifu->ObjetoHtml('deas') . '</td>             
                   </tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('detalle') . '</td> 
						<td>' . $ifu->ObjetoHtml('detalle') . '</td>
						<td>' . $ifu->ObjetoHtmlLBL('moneda') . '</td>
						<td>' . $ifu->ObjetoHtml('moneda') . '</td>  
						<td>' . $ifu->ObjetoHtmlLBL('cotizacion') . '</td>
						<td>' . $ifu->ObjetoHtml('cotizacion') . '</td>
				   </tr>	
				   <tr>
						<td>' . $ifu->ObjetoHtmlLBL('valor') . '</td>
						<td>' . $ifu->ObjetoHtml('valor') . '</td> 
						<td>' . $ifu->ObjetoHtmlLBL('formato') . '</td>
						<td>' . $ifu->ObjetoHtml('formato') . '</td>    
						<td>' . $ifu->ObjetoHtmlLBL('cotizacion_ext') . '</td>
						<td>
                            ' . $ifu->ObjetoHtml('cotizacion_ext') . '
                            <input type="number" id="cotizacion_fact_ori" name="cotizacion_fact_ori" style="display: none" />
                        </td>  
						<td>
                            <input type="text" id="constancia_detraccion_sn" name="constancia_detraccion_sn" style="display: none" />
                            <input type="text" id="numero_deposito_detraccion" name="numero_deposito_detraccion" style="display: none" />
                            <input type="date" id="fecha_emision_detraccion" name="fecha_emision_detraccion" style="display: none" />
                        </td>  
                   </tr>';
    $sHtml .= '<tr>
						<td colspan="8" style="display:none;">
								' . $ifu->ObjetoHtml('cliente') . '' . $fu->ObjetoHtml('ejer_cod') . '' . $fu->ObjetoHtml('prdo_cod') . '
								' . $ifu->ObjetoHtml('ftrn_tip_movi') . '</td>           
                   </tr>';
    $sHtml .= '<tr>
						<td colspan="8"  height="25px"></td>           
                   </tr>';
    $sHtml .= '</table>';


    // DIRECTORIO
    $sHtml_dir .= '<table class="table table-bordered table-hover" align="left" cellpadding="0" cellspacing="2" width="100%" border="0">';
    $sHtml_dir .= '<tr>
						<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('clpv_nom') . '</td>
						<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ccli') . '</td>
						<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('tran') . '</td>
						<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('det_dir') . '</td>	
						<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('factura') . '</td>						
						<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('fact_valor') . '</td> 
						<td bgcolor="#F2F2F2" align="center"></td>
					</tr>';

    $sHtml_dir .= '<tr>
						<td>' . $ifu->ObjetoHtml('clpv_nom') . '' . $ifu->ObjetoHtml('clpv_cod') . '</td>
						<td>' . $ifu->ObjetoHtml('ccli') . '</td>
						<td >' . $ifu->ObjetoHtml('tran') . '</td>
						<td>' . $ifu->ObjetoHtml('det_dir') . '</td>  	
						<td>' . $ifu->ObjetoHtml('factura') . '</td>
						
						<td>' . $ifu->ObjetoHtml('fact_valor') . '</td>  
						<td align="center">
							<div class="btn btn-success btn-sm" onclick="anadir_dir();">
								<span class="glyphicon glyphicon-plus"></span>
								Agregar
							</div>
						
						</td>
					</tr>';
    $sHtml_dir .= '</table>';


    // RETENCION
    $sHtml_ret .= '<table class="table table-bordered table-hover" style="margin-bottom: 0px; width: 100%" align="center">';
    $sHtml_ret .= '<tr>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('cod_ret') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('fact_ret') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ret_clpv') . '</td>  
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ret_porc') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ret_base') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ret_val') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ret_num') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ret_det') . '</td>
							<td bgcolor="#F2F2F2" style="display:none">' . $ifu->ObjetoHtmlLBL('cta_deb') . '</td>
							<td bgcolor="#F2F2F2" style="display:none">' . $ifu->ObjetoHtmlLBL('cta_cre') . '</td>
							<td bgcolor="#F2F2F2" style="display:none">' . $ifu->ObjetoHtmlLBL('tipo') . '</td>
							<td bgcolor="#F2F2F2" align="center"></td>
                   </tr>';

    $sHtml_ret .= '<tr>
							<td>' . $ifu->ObjetoHtml('cod_ret') . '</td> 
							<td>' . $ifu->ObjetoHtml('fact_ret') . '</td>
							<td>' . $ifu->ObjetoHtml('ret_clpv') . '</td>    
							<td>' . $ifu->ObjetoHtml('ret_porc') . '</td>
							<td>' . $ifu->ObjetoHtml('ret_base') . '</td>
							<td>' . $ifu->ObjetoHtml('ret_val') . '</td>
							<td>' . $ifu->ObjetoHtml('ret_num') . '</td>
							<td>' . $ifu->ObjetoHtml('ret_det') . '</td>
							<td style="display:none">' . $ifu->ObjetoHtml('cta_deb') . '</td>
							<td style="display:none">' . $ifu->ObjetoHtml('cta_cre') . '</td>
							<td style="display:none">' . $ifu->ObjetoHtml('tipo') . '</td>
							<td align="center">
								<div class="btn btn-success btn-sm" onclick="anadir_ret();">
									<span class="glyphicon glyphicon-plus"></span>
									Agregar
							</div>
							</td>
                   </tr>';
    $sHtml_ret .= '</table>';

    // CUENTA DASI
    $sHtml_dasi .= '<table class="table table-bordered table-hover" style="margin-bottom: 0px; width: 100%" align="center">';
    $sHtml_dasi .= '<tr>
							<td bgcolor="#F2F2F2" align="center"></td> 
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('nom_cta') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('documento') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('detalla_diario') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('crdb') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('ccosn') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('actividad') . '</td>
							<td bgcolor="#F2F2F2">' . $ifu->ObjetoHtmlLBL('val_cta') . '</td>
							<td bgcolor="#F2F2F2" align="center"></td>
						</tr>';

    $sHtml_dasi .= '<tr>
							<td align="center">
								<div class="btn btn-success btn-sm" onclick="cheque();">
									<span class="glyphicon glyphicon-pencil"></span>
									Cheque
								</div>
                                <br>
                                <br>
                                <div class="btn btn-primary btn-sm" onclick="abre_modal_canje();">
									<span class="glyphicon glyphicon-pencil"></span>
									Canje Letras
								</div>
							</td> 
							<td>' . $ifu->ObjetoHtml('nom_cta') . '' . $ifu->ObjetoHtml('cod_cta') . '</td>
							<td>' . $ifu->ObjetoHtml('documento') . '</td> 
							<td>
                                ' . $ifu->ObjetoHtml('detalla_diario') . '
                            </td>
							<td>' . $ifu->ObjetoHtml('crdb') . '</td> 
							<td>' . $ifu->ObjetoHtml('ccosn') . '</td>
							<td>' . $ifu->ObjetoHtml('actividad') . '</td>
							<td>' . $ifu->ObjetoHtml('val_cta') . '</td> 							
							<td align="center">
								<div class="btn btn-success btn-sm" onclick="anadir_dasi();">
									<span class="glyphicon glyphicon-plus"></span>
									Agregar
								</div>
							</td>
						</tr>';


    $sHtml_dasi .= '</table>';


    $sql_tran = "SELECT tran_cod_tran from saetran where tran_cod_tran like 'CAN%' and tran_cod_sucu = $idsucursal and tran_cod_empr = $idempresa";
    $tran_cod_sucu = consulta_string($sql_tran, 'tran_cod_tran', $oIfx, '');



    $oReturn->assign("divFormularioCabecera", "innerHTML", $sHtml);
    $oReturn->assign("divFormDir", "innerHTML", $sHtml_dir);
    $oReturn->assign("divFormRet", "innerHTML", $sHtml_ret);
    $oReturn->assign("divFormDiario", "innerHTML", $sHtml_dasi);
    $oReturn->assign("tran", "value", $tran_cod_sucu);
    $oReturn->assign("factura", "placeholder", "F4 o Enter");
    $oReturn->assign("factura", "placeholder", "F4 o Enter");
    $oReturn->assign("cliente_nombre", "placeholder", "DIGITE CLIENTE Y PRESIONE ENTER PARA BUSCAR");

    return $oReturn;
}



function genera_pagos($aForm = '')
{
    global $DSN, $DSN_Ifx;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo();
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];

    $oReturn = new xajaxResponse();

    $sHtml .= ' 
    <div style="overflow-x:auto;">
    <table id="tbclientes" align="center" border="0" class="table table-hover table-bordered table-striped table-condensed" style="width: 98%; margin-bottom: 0px;">';

    $sHtml .= ' <thead><tr>
	<th>No</th>
	<th>Fecha</th>
	<th>Cod Solicitud</th>
	<th>Comprobante</th>
	<th>Solicitante</th>
	<th>Gerencia</th>
	<th>Tipo de Pago</th>
	<th>Motivo</th>
	<th>Total</th>';


    $sHtml .= '<th>Solicitud</th>
	<th>Justific.</th>
	<th>Adjuntos</th>';


    $sHtml .= '<th>Seleccionar</th>
	</tr></thead>';

    $sHtml .= '<tbody>';



    $sql = "select pgs_cod_pgs,pgs_est_pgs, pgs_fec_pgs,pgs_carea_pgs, pgs_cod_empl, pgs_tipo_pgs,pgs_moti_pgs,pgs_ger_soli,pgs_tot_pgs 
	from saepgs 
	where 
	(pgs_est_soli = '4' and pgs_egreso_sn != 'S' OR pgs_tipo_pgs = 'CAJA CHICA' and pgs_est_post_soli = 5 and pgs_egreso_sn != 'S' OR pgs_tipo_pgs = 'FONDOS' and pgs_egreso_sn != 'S')
	and pgs_cod_empr=$idempresa  and pgs_tip_pago not in ('10')
	order by 1";

    $i = 1;
    if ($oIfx->Query($sql)) {
        if ($oIfx->NumFilas() > 0) {
            do {
                $fecha = $oIfx->f('pgs_fec_pgs');
                $cod = $oIfx->f('pgs_carea_pgs');
                $empl = $oIfx->f('pgs_cod_empl');
                $ger = $oIfx->f('pgs_ger_soli');
                $tipo = $oIfx->f('pgs_tipo_pgs');
                $moti = $oIfx->f('pgs_moti_pgs');
                $pgscod = $oIfx->f('pgs_cod_pgs');
                $total = number_format($oIfx->f('pgs_tot_pgs'), 2);

                $snom = "select empl_ape_nomb from saeempl where empl_cod_empl='$empl' and empl_cod_empr='$idempresa'";
                $nom = consulta_string_func($snom, 'empl_ape_nomb', $oIfxA, '');
                //if($tipo=='PAGO FACTURAS'){
                //	$est=$oIfx->f('pgs_est_pgs');

                /*	if($est==8){

                        $sHtml.='<tr>
                <td style=align="center">' . $i . '</td>
                <td style=align="center">' . $fecha . '</td>
                <td style=align="center">' . $cod . '</td>
                <td style=align="center">' . $nom . '</td>
                <td style=align="center">' . $ger . '</td>
                <td style=align="center">' . $tipo . '</td>
                <td style=align="center">' . $moti . '</td>
                <td style=align="center">' . $total . '</td>
                <td align="center" ><button class="btn btn-success btn-sm"  onClick="javascript:cargar_pagos('.$pgscod.', \''.$tipo.'\')">
               <i class="glyphicon glyphicon-ok"></i>
                </button></td>
                </tr>';


                    }
                }
                else{*/

                $sqlFprv = "select fprv_cod_asto, fprv_cod_ejer from saefprv where fprv_cod_solipag='$pgscod'";
                $fprv_cod_asto = consulta_string_func($sqlFprv, 'fprv_cod_asto', $oIfxA, '');
                $fprv_cod_ejer = consulta_string_func($sqlFprv, 'fprv_cod_ejer', $oIfxA, '');


                $sHtml .= '<tr>
					<td style=align="center">' . $i . '</td>
					<td style=align="center">' . $fecha . '</td>
					<td style=align="center">' . $cod . '</td>';

                if (empty($fprv_cod_asto) || $tipo == 'FONDOS') {
                    $sHtml .= '
                    <td style=align="center"><code>SIN COMPROB.</code></td>
                    ';
                } else {

                    $sqlAsto = "select asto_num_prdo from saeasto where asto_cod_asto='$fprv_cod_asto'";
                    $asto_num_prdo = consulta_string_func($sqlAsto, 'asto_num_prdo', $oIfxA, '');

                    $sHtml .= '
                    <td style=align="center">
                    <a href="#" onclick="seleccionaItem(' . $idempresa . ', ' . $idsucursal . ', ' . $fprv_cod_ejer . ', ' . $asto_num_prdo . ', \'' . $fprv_cod_asto . '\');">' . $fprv_cod_asto . '</a>
                    </td>
                    ';
                }


                $sHtml .= '<td style=align="center">' . $nom . '</td>
					<td style=align="center">' . $ger . '</td>
					<td style=align="center">' . $tipo . '</td>
					<td style=align="center">' . $moti . '</td>
					<td style=align="center">' . $total . '</td>';


                $sHtml .= '<td>
                            <button style="margin-botton: 10px !important"  class="btn btn-primary btn-sm" value="Generar"   onClick="javascript:vista_previa1(\'' . $pgscod . '\' )">
                                <i class="glyphicon glyphicon-print"></i>
                            </button>
                        </td>
                        <td>
                            <button style="margin-top: 0px !important" class="btn btn-primary btn-sm" value="Generar" onClick="javascript:imprimirJustificaciones(\'' . $pgscod . '\')">
                                <i class="glyphicon glyphicon-print"></i>
                            </button>
                        </td>
                        <td>
                            <button style="margin-top: 0px !important" class="btn btn-primary btn-sm" value="Generar" onClick="javascript:adjuntos_prod( \'' . $idempresa . '\', \'' . $idsucursal . '\', \'' . $pgscod . '\' )">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </button>
                        </td>
                        
                        ';


                $sHtml .= '<td align="center" ><button class="btn btn-success btn-sm"  onClick="javascript:cargar_pagos(' . $pgscod . ', \'' . $tipo . '\')">
				   <i class="glyphicon glyphicon-ok"></i>
					</button></td>
					</tr>';


                //}


                $i++;
            } while ($oIfx->SiguienteRegistro());
        } else {
            $sHtml = 'SIN SOLICITUDES...';
        }
    }

    $sHtml .= '</tbody>';

    $sHtml .= '</table>
    </div>';

    $modal = '
			<div class="modal-dialog" style="width:70%" >
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">DETALLE - PAGOS APROBADOS</h4>
					</div>
					<div class="modal-body">';
    $modal .= $sHtml;
    $modal .= '          </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>';

    $oReturn->assign("ModalPago", "innerHTML", $modal);

    $oReturn->script("init()");

    return $oReturn;
}





function verDiarioContable($aForm = '', $empr = 0, $sucu = 0, $ejer = 0, $mes = 0, $asto = '')
{

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx, $DSN;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oReturn = new xajaxResponse();

    //variables del formulario
    $empresa = $aForm['empresa'];
    $anio = $aForm['anio'];
    $mes_1 = $aForm['mes_1'];
    $mes_2 = $aForm['mes_2'];
    $nivel = $aForm['nivel'];
    $campo = 0;

    $class = new GeneraDetalleAsientoContable();

    $arrayAsto = $class->informacionAsientoContable($oIfx, $empr, $sucu, $ejer, $mes, $asto);

    $arrayDiario = $class->diarioAsientoContable($oIfx, $empr, $sucu, $ejer, $mes, $asto);

    $arrayDirectorio = $class->directorioAsientoContable($oIfx, $empr, $sucu, $ejer, $mes, $asto);

    $arrayRetencion = $class->retencionAsientoContable($oIfx, $empr, $sucu, $ejer, $mes, $asto);

    $arrayAdjuntos = $class->adjuntosAsientoContable($oCon, $empr, $sucu, $ejer, $mes, $asto);

    try {

        //LECTURA SUCIA1
        // 


        //sucursal
        $sql = "select sucu_nom_sucu from saesucu where sucu_cod_sucu = $sucu";
        $sucu_nom_sucu = consulta_string_func($sql, 'sucu_nom_sucu', $oIfx, '');


        $oReturn->assign("divTituloAsto", "innerHTML", $asto . ' - ' . $sucu_nom_sucu);

        if (count($arrayAsto) > 0) {

            $table .= '<table class="table table-striped table-condensed" align="center" width="98%">';
            $table .= '<tr>';
            $table .= '<td colspan="4" class="bg-primary">DIARIO CONTABLE</td>';
            $table .= '</tr>';

            foreach ($arrayAsto as $val) {
                $asto_cod_asto = $val[0];
                $asto_vat_asto = $val[1];
                $asto_ben_asto = $val[2];
                $asto_fec_asto = $val[3];
                $asto_det_asto = $val[4];
                $asto_cod_modu = $val[5];
                $asto_usu_asto = $val[6];
                $asto_user_web = $val[7];
                $asto_fec_serv = $val[8];
                $asto_cod_tidu = $val[9];

                //modulo
                $sql = "select modu_des_modu from saemodu where modu_cod_modu = $asto_cod_modu";
                $modu_des_modu = consulta_string_func($sql, 'modu_des_modu', $oIfx, '');

                //tipo documento
                $sql = "select tidu_des_tidu from saetidu where tidu_cod_tidu = '$asto_cod_tidu'";
                $tidu_des_tidu = consulta_string_func($sql, 'tidu_des_tidu', $oIfx, '');

                $table .= '<tr>';
                $table .= '<td>Diario:</td>';
                $table .= '<td>' . $asto_cod_asto . '</td>';
                $table .= '<td>Fecha:</td>';
                $table .= '<td>' . $asto_fec_asto . '</td>';
                $table .= '</tr>';

                $table .= '<tr>';
                $table .= '<td>Beneficiario:</td>';
                $table .= '<td colspan="3">' . $asto_ben_asto . '</td>';
                $table .= '</tr>';

                $table .= '<tr>';
                $table .= '<td>Modulo:</td>';
                $table .= '<td>' . $modu_des_modu . '</td>';
                $table .= '<td>Documento:</td>';
                $table .= '<td>' . $asto_cod_tidu . ' - ' . $tidu_des_tidu . '</td>';
                $table .= '</tr>';

                $table .= '<tr>';
                $table .= '<td>Detalle:</td>';
                $table .= '<td colspan="3">' . $asto_det_asto . '</td>';
                $table .= '</tr>';
                //sucursal, cod_prove, asto_cod, ejer_cod, prdo_cod
                $table .= '<tr>';
                $table .= '<td>Formato:</td>';
                $table .= '<td align="left">
							<div class="btn btn-primary btn-sm" onclick="vista_previa_diario2(' . $empresa . ',' . $sucu . ', 0, \'' . $asto . '\', ' . $ejer . ', ' . $mes . ');">
								<span class="glyphicon glyphicon-print"></span>
							</div>
						</td>';
                $table .= '<td>Valor:</td>';
                $table .= '<td class="bg-danger fecha_letra" align="left">' . number_format($asto_vat_asto, 2, '.', ',') . '</td>';
                $table .= '</tr>';
            } //fin foreach

            $table .= '</table>';

            $oReturn->assign("divInfo", "innerHTML", $table);
        }

        //directorio
        if (count($arrayDiario) > 0) {

            $tableDia .= '<table class="table table-striped table-condensed table-bordered table-hover" align="center" width="98%">';
            $tableDia .= '<tr>';
            $tableDia .= '<td colspan="5" class="bg-primary">DIARIO</td>
						<td align="center">
							<div class="btn btn-primary btn-sm" onclick="vista_previa_diario2(' . $empresa . ',' . $sucu . ', 0, \'' . $asto . '\', ' . $ejer . ', ' . $mes . ');">
								<span class="glyphicon glyphicon-print"></span>
							</div>
						</td>';
            $tableDia .= '</tr>';
            $tableDia .= '<tr>';
            $tableDia .= '<td>Cuenta Contable</td>';
            $tableDia .= '<td>Centro Costos</td>';
            $tableDia .= '<td>Centro Actividad</td>';
            $tableDia .= '<td>Documento</td>';
            $tableDia .= '<td>Debito</td>';
            $tableDia .= '<td>Credito</td>';
            $tableDia .= '</tr>';
            $totalDeb = 0;
            $totalCre = 0;
            foreach ($arrayDiario as $val) {
                $dasi_cod_cuen = $val[0];
                $dasi_cod_cact = $val[1];
                $ccos_cod_ccos = $val[2];
                $dasi_dml_dasi = $val[3];
                $dasi_cml_dasi = $val[4];
                $dasi_det_asi = $val[5];
                $dasi_num_depo = $val[6];

                //clpv
                $cuen_nom_cuen = '';
                if (!empty($dasi_cod_cuen)) {
                    $sql = "select cuen_nom_cuen from saecuen where cuen_cod_cuen = '$dasi_cod_cuen' and cuen_cod_empr = $empr";
                    $cuen_nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                }

                $ccosn_nom_ccosn = '';
                if (!empty($ccos_cod_ccos)) {
                    $sql = "select ccosn_nom_ccosn from saeccosn where ccosn_cod_ccosn = '$ccos_cod_ccos' and ccosn_cod_empr = $empr";
                    $ccosn_nom_ccosn = consulta_string_func($sql, 'ccosn_nom_ccosn', $oIfx, '');
                }

                $cact_nom_cact = '';
                if (!empty($dasi_cod_cact)) {
                    $sql = "select cact_nom_cact from saecact where cact_cod_cact = '$dasi_cod_cact' and cact_cod_empr = $empr";
                    $cact_nom_cact = consulta_string_func($sql, 'cact_nom_cact', $oIfx, '');
                }

                $tableDia .= '<tr>';
                $tableDia .= '<td>' . $dasi_cod_cuen . ' - ' . $cuen_nom_cuen . '</td>';
                $tableDia .= '<td>' . $ccos_cod_ccos . ' - ' . $ccosn_nom_ccosn . '</td>';
                $tableDia .= '<td>' . $dasi_cod_cact . ' - ' . $cact_nom_cact . '</td>';
                $tableDia .= '<td>' . $dasi_num_depo . '</td>';
                $tableDia .= '<td align="right">' . number_format($dasi_dml_dasi, 2, '.', ',') . '</td>';
                $tableDia .= '<td align="right">' . number_format($dasi_cml_dasi, 2, '.', ',') . '</td>';
                $tableDia .= '</tr>';

                $totalDeb += $dasi_dml_dasi;
                $totalCre += $dasi_cml_dasi;
            } //fin foreach
            $tableDia .= '<tr>';
            $tableDia .= '<td align="right" class="bg-danger fecha_letra" colspan="4">TOTAL:</td>';
            $tableDia .= '<td align="right" class="bg-danger fecha_letra">' . number_format($totalDeb, 2, '.', ',') . '</td>';
            $tableDia .= '<td align="right" class="bg-danger fecha_letra">' . number_format($totalCre, 2, '.', ',') . '</td>';
            $tableDia .= '</tr>';
            $tableDia .= '</table>';

            $oReturn->assign("divDiario", "innerHTML", $tableDia);
        }

        //directorio
        if (count($arrayDirectorio) > 0) {

            $tableDir .= '<table class="table table-striped table-condensed table-bordered table-hover" align="center" width="98%">';
            $tableDir .= '<tr>';
            $tableDir .= '<td colspan="6" class="bg-primary">DIRECTORIO</td>';
            $tableDir .= '</tr>';
            $tableDir .= '<tr>';
            $tableDir .= '<td>No.</td>';
            $tableDir .= '<td>Cliente/Proveedor</td>';
            $tableDir .= '<td>Transaccion</td>';
            $tableDir .= '<td>Factura</td>';
            $tableDir .= '<td>Credito</td>';
            $tableDir .= '<td>Debito</td>';
            $tableDir .= '</tr>';
            $totalDeb = 0;
            $totalCre = 0;
            foreach ($arrayDirectorio as $val) {
                $dir_cod_dir = $val[0];
                $dir_cod_cli = $val[1];
                $tran_cod_modu = $val[2];
                $dir_cod_tran = $val[3];
                $dir_num_fact = $val[4];
                $dir_detalle = $val[5];
                $dir_fec_venc = $val[6];
                $dir_deb_ml = $val[7];
                $dir_cre_ml = $val[8];

                //clpv
                $clpv_nom_clpv = '';
                if (!empty($dir_cod_cli)) {
                    $sql = "select clpv_nom_clpv from saeclpv where clpv_cod_clpv = $dir_cod_cli";
                    $clpv_nom_clpv = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                }

                $tableDir .= '<tr>';
                $tableDir .= '<td>' . $dir_cod_dir . '</td>';
                $tableDir .= '<td>' . $clpv_nom_clpv . '</td>';
                $tableDir .= '<td>' . $dir_cod_tran . '</td>';
                $tableDir .= '<td>' . $dir_num_fact . '</td>';
                $tableDir .= '<td align="right">' . number_format($dir_cre_ml, 2, '.', ',') . '</td>';
                $tableDir .= '<td align="right">' . number_format($dir_deb_ml, 2, '.', ',') . '</td>';
                $tableDir .= '</tr>';

                $totalCre += $dir_cre_ml;
                $totalDeb += $dir_deb_ml;
            } //fin foreach
            $tableDir .= '<tr>';
            $tableDir .= '<td align="right" class="bg-danger fecha_letra" colspan="4">TOTAL:</td>';
            $tableDir .= '<td align="right" class="bg-danger fecha_letra">' . number_format($totalCre, 2, '.', ',') . '</td>';
            $tableDir .= '<td align="right" class="bg-danger fecha_letra">' . number_format($totalDeb, 2, '.', ',') . '</td>';
            $tableDir .= '</tr>';
            $tableDir .= '</table>';

            $oReturn->assign("divDirectorio", "innerHTML", $tableDir);
        }

        //retencion
        if (count($arrayRetencion) > 0) {

            $tableRet .= '<table class="table table-striped table-condensed table-bordered table-hover" align="center" width="98%">';
            $tableRet .= '<tr>';
            $tableRet .= '<td colspan="8" class="bg-primary">RETENCION</td>';
            $tableRet .= '</tr>';
            $tableRet .= '<tr>';
            $tableRet .= '<td>Cliente/Proveedor</td>';
            $tableRet .= '<td>Factura</td>';
            $tableRet .= '<td>Retencion</td>';
            $tableRet .= '<td>Codigo</td>';
            $tableRet .= '<td>Porcentaje</td>';
            $tableRet .= '<td>Base Imp.</td>';
            $tableRet .= '<td>Valor</td>';
            $tableRet .= '<td>Print</td>';
            $tableRet .= '</tr>';
            foreach ($arrayRetencion as $val) {
                $ret_cta_ret = $val[0];
                $ret_porc_ret = $val[1];
                $ret_bas_imp = $val[2];
                $ret_valor = $val[3];
                $ret_num_ret = $val[4];
                $ret_detalle = $val[5];
                $ret_num_fact = $val[6];
                $ret_ser_ret = $val[7];
                $ret_cod_clpv = $val[8];
                $ret_fec_ret = $val[9];

                //clpv
                $clpv_nom_clpv = '';
                if (!empty($ret_cod_clpv)) {
                    $sql = "select clpv_nom_clpv from saeclpv where clpv_cod_clpv = $ret_cod_clpv";
                    $clpv_nom_clpv = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                }

                //fprv
                $printRet = '';
                if ($asto_cod_modu == 4 || $asto_cod_modu == 6) {

                    //fecha fprv o minv
                    if ($asto_cod_modu == 4) {
                        $sql = "select fprv_fec_emis 
								from saefprv
								where fprv_cod_clpv = $ret_cod_clpv and
								fprv_num_fact = '$ret_num_fact' and
								fprv_cod_asto = '$asto' and
								fprv_cod_ejer = $ejer and
								fprv_cod_empr = $empr and
								fprv_cod_sucu = $sucu";
                        $fechaEmis = consulta_string_func($sql, 'fprv_fec_emis', $oIfx, '');
                    } elseif ($asto_cod_modu == 6) {
                        $sql = "select minv_fmov 
								from saeminv
								where minv_cod_clpv = $ret_cod_clpv and
								minv_fac_prov = '$ret_num_fact' and
								minv_comp_cont = '$asto' and
								minv_cod_ejer = $ejer and
								minv_cod_empr = $empr and
								minv_cod_sucu = $sucu";
                        $fechaEmis = consulta_string_func($sql, 'minv_fmov', $oIfx, '');
                    }

                    $printRet = '<div class="btn btn-primary btn-sm" onclick="genera_documento(5, \'' . $campo . '\',\'' . $fprv_clav_sri . '\' ,
																				 \'' . $ret_cod_clpv . '\'  , \'' . $ret_num_fact . '\', \'' . $ejer . '\',
																				 \'' . $asto . '\',  \'' . $fechaEmis . '\', ' . $sucu . ');">
									<span class="glyphicon glyphicon-print"></span>
								</div>';
                }

                $tableRet .= '<tr>';
                $tableRet .= '<td>' . $clpv_nom_clpv . '</td>';
                $tableRet .= '<td>' . $ret_num_fact . '</td>';
                $tableRet .= '<td>' . $ret_ser_ret . ' - ' . $ret_num_ret . '</td>';
                $tableRet .= '<td>' . $ret_cta_ret . '</td>';
                $tableRet .= '<td align="right">' . $ret_porc_ret . '</td>';
                $tableRet .= '<td align="right">' . number_format($ret_bas_imp, 2, '.', ',') . '</td>';
                $tableRet .= '<td align="right">' . number_format($ret_valor, 2, '.', ',') . '</td>';
                $tableRet .= '<td align="center">' . $printRet . '</td>';
                $tableRet .= '</tr>';
            } //fin foreach

            $tableRet .= '</table>';

            $oReturn->assign("divRetencion", "innerHTML", $tableRet);
        }

        //adjuntos
        if (count($arrayAdjuntos) > 0) {

            $tableAdj .= '<table class="table table-striped table-condensed table-bordered table-hover" align="center" width="98%">';
            $tableAdj .= '<tr>';
            $tableAdj .= '<td colspan="2" class="bg-primary">ARCHIVOS ADJUNTOS</td>';
            $tableAdj .= '</tr>';
            $tableAdj .= '<tr>';
            $tableAdj .= '<td>Titulo</td>';
            $tableAdj .= '<td>Ruta</td>';
            $tableAdj .= '</tr>';
            foreach ($arrayAdjuntos as $val) {
                $titulo = $val[0];
                $ruta = $val[1];

                $tableAdj .= '<tr>';
                $tableAdj .= '<td>' . $titulo . '</td>';
                $tableAdj .= '<td><a href="#" onclick="dowloand(\'' . $ruta . '\')">' . $ruta . '</a></td>';
                $tableAdj .= '</tr>';
            } //fin foreach

            $tableAdj .= '</table>';

            $oReturn->assign("divAdjuntos", "innerHTML", $tableAdj);
        }
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}



function genera_pdf_cheque($asto_cod, $formato)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfxA = new Dbo();
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
    $oReturn = new xajaxResponse();


    $sql = "select asto_cod_modu, asto_tipo_mov from saeasto where asto_cod_asto='$asto_cod'";
    $tipomov = consulta_string($sql, 'asto_tipo_mov', $oIfx, '');


    if ($tipomov == 'EG') {
        $sql = "select ftrn_ubi_web from saeftrn where ftrn_cod_ftrn=$formato  and ftrn_ubi_web is not null";
        $ubi = consulta_string($sql, 'ftrn_ubi_web', $oIfx, '');
        if (empty($ubi)) {
            $ubi = 'Include/Formatos/comercial/cheque.php';
        }

        $oReturn->script("imprime_cheque('$ubi');");
    }
    return $oReturn;
}


function genera_documento($tipo_documento = 0, $id = '', $clavAcce = 'no_autorizado', $clpv = 0, $num_fact = '', $ejer = 0, $asto = '', $fec_emis = '', $sucu = 0)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oReturn = new xajaxResponse();

    switch ($tipo_documento) {
        case 1:
            $_SESSION['pdf'] = reporte_factura($id, $clavAcce, $sucu);
            break;
        case 2:
            $_SESSION['pdf'] = reporte_notaDebito($id, $clavAcce);
            break;
        case 3:
            $_SESSION['pdf'] = reporte_notaCredito($id, $clavAcce, $sucu);
            break;
        case 4:
            $_SESSION['pdf'] = reporte_guiaRemision($id, $clavAcce, $sucu);
            break;
        case 5:
            $id = $_SESSION['sqlId'][$id];
            $_SESSION['pdf'] = reporte_retencionGasto($id, $clavAcce, $rutapdf, $clpv, $num_fact, $ejer, $asto, $fec_emis, $sucu);
            break;
        case 6:
            $id = $_SESSION['sqlId'][$id];
            $_SESSION['pdf'] = reporte_retencionInve($id, $clavAcce, $rutapdf, $clpv, $num_fact, $ejer, $asto, $fec_emis, $sucu);
            break;
        case 7:
            $_SESSION['pdf'] = reporte_factura_export($id, $clavAcce);
            break;
        case 8:
            $_SESSION['pdf'] = reporte_factura_flor($id, $clavAcce);
            break;
        case 9:
            $_SESSION['pdf'] = reporte_factura_flor_export($id, $clavAcce);
            break;
        case 10:
            $_SESSION['pdf'] = reporte_guiaRemisionFlor($id, $clavAcce);
            break;
    }

    $oReturn->script('generar_pdf_compras()');

    return $oReturn;
}



function genera_pdf_doc1($pgs, $aForm = '')
{

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    unset($_SESSION['pdf']);
    $oReturn = new xajaxResponse();

    $html = genera_pdf_doc_pago($pgs, 1);

    $_SESSION['pdf'] = $html;

    $oReturn->script('generar_pdf2()');
    return $oReturn;
}

function form_adjuntos($idempresa, $idsucursal, $codpedi, $aForm = '')
{
    global $DSN, $DSN_Ifx;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();


    $oReturn = new xajaxResponse();


    $sHtml .= '<table class="table table-striped table-bordered table-hover table-condensed" style="width: 90%; margin-bottom: 0px;" align="center">';
    $sHtml .= '<tr>
	<td class="info" >No.</td>
	<td class="info">Cod Solicitud</td>
	<td class="info">Tipo Pago</td>
	<td class="info" align="center">Adjuntos</td></tr>';


    $sqlPgs = "select pgs_tip_pago from saepgs where pgs_cod_pgs = $codpedi";
    $pgs_tip_pago = consulta_string_func($sqlPgs, 'pgs_tip_pago', $oIfx, 0);
    ////CARGA DE ADJUNTOS////
    $k = 1;
    $i = 1;
    $sqlpedi = "select pgs_ruta_pgs, dpgs_ruta_dpgs, pgs_tipo_pgs,pgs_carea_pgs from saepgs,saedpgs where pgs_cod_pgs=dpgs_cod_pgs and pgs_cod_pgs=$codpedi and dpgs_cod_sucu=$idsucursal and dpgs_cod_empr= $idempresa";

    if ($oIfx->Query($sqlpedi)) {
        if ($oIfx->NumFilas() > 0) {
            do {

                $tipo = $oIfx->f('pgs_tipo_pgs');
                $codsol = $oIfx->f('pgs_carea_pgs');


                $sHtml .= '<tr>';
                $sHtml .= '<td align="center">' . $k . '</td>';
                $sHtml .= '<td align="center">' . $codsol . '</td>';
                $sHtml .= '<td align="center">' . $tipo . '</td>';

                $sHtml .= '<td align="right" valign="top">';
                $sHtml .= '<table class="table table-striped table-bordered table-hover table-condensed" style="width: 100%; margin-bottom: 0px;" align="center">';
                $sHtml .= '<tr>
				<td class="info" >N.-</td>
				<td class="info" >Ruta</td>
				</tr>';

                $ruta = $oIfx->f('dpgs_ruta_dpgs');
                if (empty($ruta)) {
                    $ruta = $oIfx->f('pgs_ruta_pgs');
                }
                //$ruta=substr($ruta,3);


                $aruta = explode(":", $ruta);



                foreach ($aruta as $ar) {
                    $logo = '';

                    if (!empty($ar)) {


                        //$arc_img=DIR_FACTELEC."Include/Clases/Formulario/Plugins/reloj/$ar";
                        $arc_img = "../../Include/Clases/Formulario/Plugins/reloj/$ar";

                        if (file_exists($arc_img)) {
                            $imagen = $arc_img;


                            $x = '0px';
                            if (preg_match("/jpg|png|PNG|jpeg|gif/", $ar)) {

                                $logo = '<div>
                                    <img src="' . $imagen . '" style="
                                    width:225px;
                                    height:100px;
                                    object-fit; contain;">
                                    </div>';
                                $x = '0px';

                                $sHtml .= '<tr>
                            <td> ' . $i . '</td>
                            <td><a href="' . $arc_img . '" target="_blank" >' . $logo . '</a>
                             </td>
                            </tr>';
                            } else {

                                $logo = '<div>
                            <a href="' . $arc_img . '" target="_blank" >' . $ar . '</a>
                            </div>';

                                $sHtml .= '<tr>
                            <td> ' . $i . '</td>
                            <td> ' . $logo . '</td>
                            </tr>';
                            }
                        } //if existe
                        else {
                            $imagen = '';

                            $sHtml .= '<tr>
                            <td> ' . $i . '</td>
                            <td> ' . $logo . '</td>
                            </tr>';
                        }


                        $i++;
                    } //CIERRE IF aruta
                } //CIERRE FOR EACH

                $sHtml .= '</table></td>';
                $sHtml .= '</tr>';
                $k++;
            } while ($oIfx->SiguienteRegistro());
        }
    }

    $modal = '
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">ADJUNTOS - PEDIDOS</h4>
                        </div>
                        <div class="modal-body">';
    $modal .= $sHtml;

    if ($pgs_tip_pago == 3) {
        $sHtml_ob = mostrarTablaFacturasReembolso($codpedi);
        $modal .= '<hr>';
        $modal .= $sHtml_ob[0];
    } else if ($pgs_tip_pago == 1) {
        $sHtml_ob = buscar_tabla_reembolsos($codpedi);
        $modal .= '<hr>';
        $modal .= $sHtml_ob[0];
    }

    $modal .= '          </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>';

    $oReturn->assign("ModalPago47", "innerHTML", $modal);
    $oReturn->script("abre_modal();");

    return $oReturn;
}


function mostrarTablaFacturasReembolso($id_solicitud)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN, $DSN_Ifx;

    $oCnx = new Dbo();
    $oCnx->DSN = $DSN;
    $oCnx->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];
    $i_con = 1;

    $delet_button = '';
    $sql_cons = "select pgs_cod_pgs, pgs_est_soli, pgs_est_post_soli from saepgs where pgs_cod_pgs=$id_solicitud";
    $pgs_est_soli = consulta_string($sql_cons, 'pgs_est_soli', $oIfx, 0);
    $pgs_est_post_soli = consulta_string($sql_cons, 'pgs_est_post_soli', $oIfx, 0);

    $sql = "select *from saefprr where fprr_cod_solicitud = '$id_solicitud';";

    $html = '<br><br><table class="table table-condensed table-striped table-bordered">';
    $html .= '<thead>
             <tr>
             <th>#</th>
             <th>Identificacion</th>
             <th>Proveedor</th>
             <th>Archivo</th>
             <th>Serie</th>
             <th>Estab</th>
             <th>Num fact</th>
             <th>Total</th>
             <th>Eliminar</th>
             </tr>
             </thead><tbody>';

    $total_sum = 0;

    if ($oIfx->Query($sql)) {
        if ($oIfx->NumFilas() > 0) {
            do {
                $fprr_cod_fprr = $oIfx->f('fprr_cod_fprr');
                $fprr_ruc_prov = $oIfx->f('fprr_ruc_prov');
                $fprr_nom_prov = $oIfx->f('fprr_nom_prov');
                $fprr_num_seri = $oIfx->f('fprr_num_seri');
                $fprr_num_esta = $oIfx->f('fprr_num_esta');
                $fprr_num_fact = $oIfx->f('fprr_num_fact');
                $fprr_fec_emis = $oIfx->f('fprr_fec_emis');
                $fprr_val_totb = $oIfx->f('fprr_val_totb');
                $fprr_val_tots = $oIfx->f('fprr_val_tots');
                $fprr_val_totl = $oIfx->f('fprr_val_totl');
                $fprr_link_archivo = $oIfx->f('fprr_link_archivo');

                if ($pgs_est_soli != 5 || $pgs_est_post_soli > 5) {
                    $delet_button = '<div class="btn btn-danger btn-sm"onclick="javascript:elimina_detalle(' . $fprr_cod_fprr . ',' . $id_solicitud . ');">
											<span class="glyphicon glyphicon-remove"></span>
				</div>';
                }

                $link_archivo = '<code> ------- </code>';


                if ($fprr_link_archivo) {
                    $fprr_link_archivo = '../cre_factura_prove_rs/' . $fprr_link_archivo;
                    if (file_exists($fprr_link_archivo)) {
                        $link_archivo = "<a href='$fprr_link_archivo' target='_blank'> link archivo </a>";
                    }
                }



                $html .= '<tr>';
                $html .= '<td>' . $i_con . '</td>';
                $html .= '<td>' . $fprr_ruc_prov . '</td>';
                $html .= '<td>' . $fprr_nom_prov . '</td>';
                $html .= '<td>' . $link_archivo . '</td>';
                $html .= '<td>' . $fprr_num_seri . '</td>';
                $html .= '<td>' . $fprr_num_esta . '</td>';
                $html .= '<td>' . $fprr_num_fact . '</td>';
                $html .= '<td>' . $fprr_val_totl . '</td>';
                $html .= '<td>' . $delet_button . '</td>';
                $html .= '</tr>';

                $total_sum += $fprr_val_totl;

                $i_con++;
            } while ($oIfx->SiguienteRegistro());

            $html .= '<tr>';
            $html .= '<td colspan="7" align="right"> TOTAL: </td>';
            $html .= '<td>' . $total_sum . '</td>';
            $html .= '<td></td>';
            $html .= '</tr>';
        }
    }
    $oIfx->Free();



    $html .= '</tbody></table>';

    return array($html, $total_sum);
}


function buscar_tabla_reembolsos($cod_solicitud)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];
    $usuario_informix = $_SESSION['U_USER_INFORMIX'];
    $total_sumado = 0;

    $delet_button = '';
    $sql_cons = "select pgs_cod_pgs, pgs_est_soli, pgs_est_post_soli from saepgs where pgs_cod_pgs=$cod_solicitud";
    $pgs_est_soli = consulta_string($sql_cons, 'pgs_est_soli', $oIfx, 0);
    $pgs_est_post_soli = consulta_string($sql_cons, 'pgs_est_post_soli', $oIfx, 0);

    $hml = '<table class="table table-bordered table-hover table-condensed" align="center" style="width: 100%;" id="tabla_reembolsos">
			<tr>
				<td style="text-align: center;" class="bg-primary">No.</td>
				<td style="text-align: center;" class="bg-primary">Tipo </td>
				<td style="text-align: center;" class="bg-primary">Cedula/RUC</td>
				<td style="text-align: center;" class="bg-primary">Tipo Doc</td>
				<td style="text-align: center;" class="bg-primary">N. Estable </td>
				<td style="text-align: center;" class="bg-primary">Pto. Emisi&oacuten</td>
				<td style="text-align: center;" class="bg-primary">No. Factura</td>
				<td style="text-align: center;" class="bg-primary">F. Emisi&oacuten</td>
				<td style="text-align: center;" class="bg-primary" >Archivo</td>
				<td style="text-align: center;" class="bg-primary" >Total</td>
				<td style="text-align: center;" class="bg-primary" >Eliminar</td>
			</tr>';
    $gra_total = 0;
    $gra_con_iva = 0;
    $gra_sin_iva = 0;
    $gra_iva = 0;
    $gra_val_iva = 0;

    $canti_ = 0;

    $select_reembolsos = " select *from saeminr where minr_cod_solicitud = $cod_solicitud;";


    if ($oIfx->Query($select_reembolsos)) {
        if ($oIfx->NumFilas() > 0) {
            do {
                $minr_cod_minr = $oIfx->f('minr_cod_minr');
                $idempresa = $oIfx->f('minr_cod_empr');
                $idsucursal = $oIfx->f('minr_cod_sucu');
                $minr_num_comp = $oIfx->f('minr_num_comp');
                $minr_cod_ejer = $oIfx->f('minr_cod_ejer');
                $minr_num_prdo = $oIfx->f('minr_num_prdo');
                $tipo_iden = $oIfx->f('minr_tipo_iden');
                $ruc_cli = $oIfx->f('minr_ide_prov');
                $fpagop_prov = $oIfx->f('minr_fpagop_prov');
                $tipo_prov = $oIfx->f('minr_tipo_prov');
                $tipo_doc = $oIfx->f('minr_tipo_docu');
                $num_est = $oIfx->f('minr_num_esta');
                $pto_emis = $oIfx->f('minr_pto_emis');
                $sec_docu = $oIfx->f('minr_sec_docu');
                $fec_emis = $oIfx->f('minr_fec_emis');
                $num_auto = $oIfx->f('minr_num_auto');


                $con_miva = $oIfx->f('minr_con_miva');
                $sin_miva = $oIfx->f('minr_sin_miva');
                $iva_porc = $oIfx->f('minr_iva_porc');
                $iva_valo = $oIfx->f('minr_iva_valo');
                $detalle = $oIfx->f('minr_det_minr');
                $idbodega = $oIfx->f('minr_cod_bode');
                $codigo_producto = $oIfx->f('minr_cod_viatico');
                $codigo_solicitud = $oIfx->f('minr_cod_solicitud');
                $minr_link_archivo = $oIfx->f('minr_link_archivo');

                $suma = $con_miva + $sin_miva + $iva_valo;

                $canti_++;
                $gra_total += $suma;
                $gra_con_iva += $con_miva;
                $gra_sin_iva += $sin_miva;
                $gra_iva += $iva_porc;
                $gra_val_iva += $iva_valo;




                if ($codigo_producto == 'LGV001') {
                    $codigo_producto_label = 'MOVILIZACION';
                } elseif ($codigo_producto == 'LGV002') {
                    $codigo_producto_label = 'ALIMENTACION';
                } elseif ($codigo_producto == 'LGV003') {
                    $codigo_producto_label = 'HOSPEDAJE';
                } elseif ($codigo_producto == 'CCSO001') {
                    $codigo_producto_label = 'CAJA CHICA SUMINISTROS DE OFICINA';
                } elseif ($codigo_producto == 'CCALI001') {
                    $codigo_producto_label = 'ALIMENTACION CAJA CHICA';
                } elseif ($codigo_producto == 'CCMAN001') {
                    $codigo_producto_label = 'MANTENIMIENTO EDIFICIO CAJA CHICA';
                } elseif ($codigo_producto == 'CCDIE001') {
                    $codigo_producto_label = 'DIETAS CAJA CHICA';
                } elseif ($codigo_producto == 'CCFLET001') {
                    $codigo_producto_label = 'FLETES Y ENVIOS CAJA CHICA';
                } elseif ($codigo_producto == 'CCASEO001') {
                    $codigo_producto_label = 'SUMINISTROS ASEO CAJA CHICA';
                } elseif ($codigo_producto == 'CCMANT001') {
                    $codigo_producto_label = 'MANTENIMIENTOS VEHICULOS CAJA CHICA';
                } elseif ($codigo_producto == 'CCCOMB001') {
                    $codigo_producto_label = 'COMBUSTIBLE CAJA CHICA';
                } elseif ($codigo_producto == 'CCMOV001') {
                    $codigo_producto_label = 'MOVILIZACION CAJA CHICA';
                } else {
                    $codigo_producto_label = 'NO DEFINIDO';
                }

                $link_archivo = '<code> ------- </code>';

                if (file_exists($minr_link_archivo)) {
                    $link_archivo = "<a href='$minr_link_archivo' target='_blank'> link archivo </a>";
                }

                if ($pgs_est_soli != 5 || $pgs_est_post_soli > 5) {
                    $delet_button = '<div class="btn btn-danger btn-sm"onclick="javascript:eliminar_reembolso(' . $minr_cod_minr . ',' . $cod_solicitud . ');">
											<span class="glyphicon glyphicon-remove"></span>
				</div>';
                }


                $hml .= '<tr>
			<td>' . $canti_ . '</td>
			<td>' . $codigo_producto_label . '</td>
			<td>' . $ruc_cli . '</td>
			<td>' . $tipo_doc . '</td>
			<td>' . $num_est . '</td>
			<td>' . $pto_emis . '</td>
			<td>' . $sec_docu . '</td>
			<td>' . $fec_emis . '</td>
			<td>' . $link_archivo . '</td>
			<td align="right">' . number_format($suma, 2, '.', ',') . '</td>
			<td align="center" >' . $delet_button . '</td>
		 </tr>';
            } while ($oIfx->SiguienteRegistro());


            $hml .= '<tr> 
			<td class="bg-primary text-right" colspan="9">TOTAL</td>
			<td class="bg-primary" align="right">' . number_format($gra_total, 2, '.', ',') . '</td>
			<td class="bg-primary" ></td>
			
		 </tr>';

            $total_sumado = $gra_total;
        }
    }

    $hml .= '</table>';



    return array($hml, $total_sumado);
}

function agrega_modifica_grid_dir_pago($nTipo = 0, $aForm = '', $id = '', $coti = '', $mone_cod = '', $coti_ext = 0, $codpago, $tipo)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oIfxB = new Dbo;
    $oIfxB->DSN = $DSN_Ifx;
    $oIfxB->Conectar();

    $oIfxC = new Dbo;
    $oIfxC->DSN = $DSN_Ifx;
    $oIfxC->Conectar();

    $oReturn = new xajaxResponse();

    $aDataGrid = $_SESSION['aDataGirdDir'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];
    //$array     = $_SESSION['U_FACTURA'];

    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];



    if ($tipo == 'PAGO FACTURAS') {

        $tipo = 1;
    }
    if ($tipo == 'VIATICOS') {

        $tipo = 2;
    }
    if ($tipo == 'FONDOS') {

        $tipo = 3;
    }
    if ($tipo == 'PAGO NOMINA') {

        $tipo = 4;
    }

    if ($tipo == 'REEMBOLSOS') {

        $tipo = 5;
    }

    if ($tipo == 'CAJA CHICA') {

        $tipo = 6;
    }
    if ($tipo == 'ANTICIPO PROVEEDORES') {

        $tipo = 7;
    }

    if ($tipo == 'OTROS') {

        $tipo = 8;
    }

    if ($tipo == 'ANTICIPO JUNTAS') {

        $tipo = 9;
    }


    try {

        //TIPO DE TRASANCCION
        $sqlt = "select tran_cod_tran from saetran where tran_cod_tran like 'CAN%' and trans_tip_tran='DB' and tran_cod_empr=$idempresa and tran_cod_sucu=$idsucursal";
        $tran_clpv = consulta_string_func($sqlt, 'tran_cod_tran', $oIfxB, '');


        if ($tipo == 1 || $tipo == 5) {

            unset($array);
            $i = 1;
            $sqlcheq = "select sum(dpgs_vpag_dpgs) as tot from saedpgs where dpgs_cod_pgs=$codpago";
            $total_cheque = consulta_string_func($sqlcheq, 'tot', $oIfxB, 0);
            $sqlpag = "select * from saedpgs where dpgs_cod_pgs=$codpago";


            if ($oIfx->Query($sqlpag)) {
                if ($oIfx->NumFilas() > 0) {
                    do {


                        $ruc = $oIfx->f('dpgs_pruc_dpgs');
                        $detalle = $oIfx->f('dpgs_dcri_dpgs');

                        $nombre_proveedor = $oIfx->f('dpgs_npro_dpgs');

                        $valor_pagado = $oIfx->f('dpgs_vpag_dpgs');



                        $sqlclpv = "select clpv_cod_clpv from saeclpv where clpv_ruc_clpv='$ruc'";
                        $clpv_cod = consulta_string_func($sqlclpv, 'clpv_cod_clpv', $oIfxB, '');


                        // CUENTAS DE CLPV
                        $sql = "select clpv_cod_cuen, grpv_cod_grpv from saeclpv where clpv_cod_empr = $idempresa and clpv_cod_clpv = $clpv_cod ";
                        $clpv_cuen = consulta_string_func($sql, 'clpv_cod_cuen', $oIfxB, '');


                        if (empty($clpv_cuen)) {
                            $clpv_gr = consulta_string_func($sql, 'grpv_cod_grpv', $oIfxB, '');
                            $sql = "select  grpv_cta_grpv  from saegrpv where
                                            grpv_cod_empr = $idempresa and
                                            grpv_cod_grpv = '$clpv_gr' ";
                            $clpv_cuen = consulta_string_func($sql, 'grpv_cta_grpv', $oIfxB, '');
                        }


                        // ------------------------------------------------------------------------------------
                        // TOMAMOS LA CUENTA CONTABLE DE LA MONEDA EN CASO DE TENER CONFIGURADO ADRIAN47
                        // ------------------------------------------------------------------------------------
                        $moneda_ad = $aForm['moneda'];
                        $sql_moneda = "SELECT mone_cod_cuen from saemone where
										mone_cod_mone = $moneda_ad
										";
                        $mone_cod_cuen = consulta_string_func($sql_moneda, 'mone_cod_cuen', $oIfx, '');
                        if (!empty($mone_cod_cuen)) {
                            $clpv_cuen = $mone_cod_cuen;
                        }
                        // ------------------------------------------------------------------------------------
                        // FIN TOMAMOS LA CUENTA CONTABLE DE LA MONEDA EN CASO DE TENER CONFIGURADO ADRIAN47
                        // ------------------------------------------------------------------------------------



                        // NOMBRE CUENtA
                        $sql = "select cuen_nom_cuen from saecuen where 
                                        cuen_cod_empr = $idempresa and
                                        cuen_cod_cuen = '$clpv_cuen' ";
                        $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfxB, '');



                        // TRANSACCIONAL
                        $sql = "select trim(para_fac_cxp) as tran  from saepara where para_cod_empr = $idempresa and para_cod_sucu = $idsucursal ";
                        $tran_cod = consulta_string_func($sql, 'tran', $oIfxB, '');


                        $sql = "select sucu_cod_sucu, sucu_nom_sucu from saesucu where sucu_cod_empr = $idempresa ";
                        unset($array_sucu);
                        $array_sucu = array_dato($oIfxB, $sql, 'sucu_cod_sucu', 'sucu_nom_sucu');


                        $numfact = $oIfx->f('dpgs_ncom_dpgs');
                        //dmcp_num_fac='$numfact' AND
                        $sql_sp = "select dmcp_cod_sucu, dmcp_num_fac,  min(dcmp_fec_emis) as dcmp_fec_emis, max(dmcp_fec_ven) as dmcp_fec_ven, 
					   MAX((select sum(COALESCE(dcmp_deb_ml,0) - COALESCE(dcmp_cre_ml,0))
								from saedmcp y	where 
								y.dmcp_cod_empr = saedmcp.dmcp_cod_empr and 
								y.clpv_cod_clpv = saedmcp.clpv_cod_clpv and
								y.dmcp_num_fac  = saedmcp.dmcp_num_fac)) saldo
						from saedmcp WHERE 
						dmcp_cod_empr = $idempresa 	AND 
						clpv_cod_clpv = $clpv_cod	AND 
						dmcp_num_fac='$numfact' AND
						dmcp_est_dcmp <>'AN'  AND
						saedmcp.dmcp_num_fac in ( select trim(dmcp_num_fac) from saedmcp  WHERE 
													dmcp_cod_empr   = $idempresa AND 
													clpv_cod_clpv   = $clpv_cod and
													dcmp_fec_emis  <= CURRENT_DATE group by dmcp_num_fac
													having sum(dcmp_deb_ml) - sum(dcmp_cre_ml) <> 0 
												)
						group by dmcp_cod_sucu, dmcp_num_fac							
						having  sum(dcmp_deb_ml) - sum(dcmp_cre_ml) <> 0     
						ORDER BY dmcp_num_fac ";


                        if ($oIfxC->Query($sql_sp)) {
                            if ($oIfxC->NumFilas() > 0) {
                                do {

                                    $tran = $tran_cod;
                                    $fact_num = $oIfxC->f('dmcp_num_fac');
                                    $fec_emis = $oIfxC->f('dcmp_fec_emis');
                                    $fec_venc = $oIfxC->f('dmcp_fec_ven');
                                    $saldo = abs($oIfxC->f('saldo'));
                                    $saldo_condicion = $oIfxC->f('saldo');


                                    $array[$i] = array(
                                        $i,
                                        $fact_num,
                                        $fec_emis,
                                        $fec_venc,
                                        $valor_pagado,
                                        $idempresa,
                                        $idsucursal,
                                        $clpv_cod,
                                        $tran_clpv,
                                        $det,
                                        $clpv_cuen,
                                        $cuen_nom
                                    );


                                    $i++;
                                } while ($oIfxC->SiguienteRegistro());
                            }
                        }
                    } while ($oIfx->SiguienteRegistro());
                }

                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;
            }




            $contpag = 0;
            $sqlcpag = "select distinct(dpgs_pruc_dpgs) as cruc from saedpgs where dpgs_cod_pgs=$codpago";
            if ($oIfx->Query($sqlcpag)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $contpag++;
                    } while ($oIfx->SiguienteRegistro());
                }
            }
        } //CIERRE IF TIPO 1

        // Viaticos - Fondos - - Caja Chica
        if ($tipo == 2 || $tipo == 3 || $tipo == 4 || $tipo == 6 || $tipo == 7 || $tipo == 8 || $tipo == 9) {
            $sqlpag = "select * from saedpgs where dpgs_cod_pgs=$codpago";


            //        print_r($sqlpag);exit;
            if ($oIfx->Query($sqlpag)) {
                if ($oIfx->NumFilas() > 0) {
                    do {


                        $sqlmo = "select pgs_moti_pgs from saepgs where pgs_cod_empr=$idempresa and pgs_cod_pgs=$codpago";
                        $motivo = consulta_string_func($sqlmo, 'pgs_moti_pgs', $oIfxA, '');
                        $ben = $oIfx->f('dpgs_ben_dpgs');

                        $sqlres = "select empl_ape_empl,empl_nom_empl  from saeempl where empl_cod_empl='$ben'";
                        $ape = consulta_string_func($sqlres, 'empl_ape_empl', $oIfxA, '');
                        $nom = consulta_string_func($sqlres, 'empl_nom_empl', $oIfxA, '');
                        $nombre = $nom . ' ' . $ape;
                        if ($tipo == 2) {
                            $totviat = $oIfx->f('dpgs_vapr_dpgs');
                        }
                        if ($tipo == 3) {
                            $totviat = $oIfx->f('dpgs_fval_dpgs');
                        }
                        if ($tipo == 4) {
                            $totviat = $oIfx->f('dpgs_mont_dpgs');
                            $motivo = $oIfx->f('dpgs_dcri_dpgs');
                        }
                        if ($tipo == 6) {
                            $totviat = $oIfx->f('dpgs_fval_dpgs');
                        }
                        if ($tipo == 7) {
                            $totviat = $oIfx->f('dpgs_vpag_dpgs');
                        }
                        if ($tipo == 8) {
                            $totviat = $oIfx->f('dpgs_vpag_dpgs');
                        }
                        if ($tipo == 9) {
                            $totviat = $oIfx->f('dpgs_vpag_dpgs');
                        }


                        $totpago = number_format($totviat, 2);
                    } while ($oIfx->SiguienteRegistro());
                }
            }
        } //CIERRE IF TIPOS 2,3,4



        $aLabelGrid = array(
            'Fila',
            'Cliente',
            'Subcliente',
            'Tipo',
            'Factura',
            'Fec. Vence',
            'Detalle',
            'Cotizacion',
            'Debito Moneda Local',
            'Credito Moneda Local',
            'Debito Moneda Ext',
            'Credito Moneda Ext',
            'Modificar',
            'Eliminar',
            'DI'
        );

        $aLabelDiar = array(
            'Fila',
            'Cuenta',
            'Nombre',
            'Documento',
            'Cotizacion',
            'Debito Moneda Local',
            'Credito Moneda Local',
            'Debito Moneda Ext',
            'Credito Moneda Ext',
            'Modificar',
            'Eliminar',
            'Beneficiario',
            'Cuenta Bancaria',
            'Cheque',
            'Fecha Venc',
            'Formato Cheque',
            'Codigo Ctab',
            'Detalle',
            'Centro Costo',
            'Centro Actividad',
            'DIR',
            'RET'
        );





        //VALIDACION DE ARRAY GRID
        if ($tipo == 1 || $tipo == 5) {

            // VARIABLES
            $tran_cod = $aForm["tran"];
            //$detalle    = $aForm["det_dir"];
            $ccli_cod = $aForm["ccli"];

            $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
            $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

            if ($mone_cod == $mone_base) {
                $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
                $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

                $sql = "select tcam_val_tcam from saetcam where
				mone_cod_empr = $idempresa and
				tcam_cod_mone = $mone_extr and
				tcam_fec_tcam in (
									select max(tcam_fec_tcam)  from saetcam where
											mone_cod_empr = $idempresa and
											tcam_cod_mone = $mone_extr
								)  ";
                $coti = $coti_ext; //consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);
            }



            if ($nTipo == 0) {
                if (count($array) > 0) {
                    $cont = 0;
                    $contd = 0;
                    foreach ($array as $val) {


                        $ix = abs($val[4]);
                        $fact_num = $val[1];
                        $fec_emis = $val[2];
                        $fec_venc = $val[3];
                        $saldo = abs($val[4]);
                        $idempresa = $val[5];
                        $idsucursal = $val[6];
                        $clpv_cod = $val[7];

                        if ($tipo == 1) {
                            $tran_cod = $tran_clpv;
                        } else {
                            $tran_cod = $val[8];
                        }

                        $det_dir = $val[9];
                        $clpv_cuen = $val[10];
                        $cuen_nom = $val[11];

                        $txt = $ix;

                        if ($txt > 0) {
                            // DIRECTORIO
                            $cont = count($aDataGrid);
                            if ($cont == 0) {
                                $cont = count($array);
                            }


                            $aDataGrid[$cont][$aLabelGrid[0]] = floatval($cont);
                            $aDataGrid[$cont][$aLabelGrid[1]] = $clpv_cod;
                            $aDataGrid[$cont][$aLabelGrid[2]] = $ccli_cod;
                            $aDataGrid[$cont][$aLabelGrid[3]] = $tran_cod;
                            $aDataGrid[$cont][$aLabelGrid[4]] = $fact_num;
                            $aDataGrid[$cont][$aLabelGrid[5]] = $fec_venc;
                            $aDataGrid[$cont][$aLabelGrid[6]] = $det_dir;
                            $aDataGrid[$cont][$aLabelGrid[7]] = $coti;

                            $valDirCre = 0;
                            $valDirDeb = $txt;

                            if ($mone_cod == $mone_base) {
                                // moneda local
                                $cre_tmp = 0;
                                $deb_tmp = 0;
                                if ($coti > 0) {
                                    $cre_tmp = round(($valDirCre / $coti), 2);
                                }

                                if ($coti > 0) {
                                    $deb_tmp = round(($valDirDeb / $coti), 2);
                                }

                                $aDataGrid[$cont][$aLabelGrid[8]] = $valDirDeb;
                                $aDataGrid[$cont][$aLabelGrid[9]] = $valDirCre;
                                $aDataGrid[$cont][$aLabelGrid[10]] = $deb_tmp;
                                $aDataGrid[$cont][$aLabelGrid[11]] = $cre_tmp;
                            } else {
                                // moneda extra

                                $aDataGrid[$cont][$aLabelGrid[8]] = $valDirDeb * $coti;
                                $aDataGrid[$cont][$aLabelGrid[9]] = $valDirCre * $coti;

                                $aDataGrid[$cont][$aLabelGrid[10]] = $valDirDeb;
                                $aDataGrid[$cont][$aLabelGrid[11]] = $valDirCre;
                            }

                            $aDataGrid[$cont][$aLabelGrid[12]] = '';

                            $contd = count($aDataDiar);
                            $aDataGrid[$cont][$aLabelGrid[13]] = '<div align="center">
																<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
																title = "Presione aqui para Eliminar"
																style="cursor: hand !important; cursor: pointer !important;"
																onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
																alt="Eliminar"
																align="bottom" />
															</div>';
                            $aDataGrid[$cont][$aLabelGrid[14]] = $contd;


                            // DIARIO
                            $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
                            $aDataDiar[$contd][$aLabelDiar[1]] = $clpv_cuen;
                            $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom;
                            $aDataDiar[$contd][$aLabelDiar[3]] = $doc;
                            $aDataDiar[$contd][$aLabelDiar[4]] = $coti;


                            if ($mone_cod == $mone_base) {
                                // moneda local
                                $cre_tmp = 0;
                                $deb_tmp = 0;
                                if ($coti > 0) {
                                    $cre_tmp = round(($valDirCre / $coti), 2);
                                }

                                if ($coti > 0) {
                                    $deb_tmp = round(($valDirDeb / $coti), 2);
                                }

                                $aDataDiar[$contd][$aLabelDiar[5]] = $valDirDeb;
                                $aDataDiar[$contd][$aLabelDiar[6]] = $valDirCre;
                                $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
                                $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
                            } else {
                                // moneda extra
                                $aDataDiar[$contd][$aLabelDiar[5]] = $valDirDeb * $coti;
                                $aDataDiar[$contd][$aLabelDiar[6]] = $valDirCre * $coti;
                                $aDataDiar[$contd][$aLabelDiar[7]] = $valDirDeb;
                                $aDataDiar[$contd][$aLabelDiar[8]] = $valDirCre;
                            }

                            $aDataDiar[$contd][$aLabelDiar[9]] = '';
                            $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
																	title = "Presione aqui para Eliminar"
																	style="cursor: hand !important; cursor: pointer !important;"
																	onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
																	alt="Eliminar"
																	align="bottom" />';
                            $aDataDiar[$contd][$aLabelDiar[11]] = '';
                            $aDataDiar[$contd][$aLabelDiar[12]] = '';
                            $aDataDiar[$contd][$aLabelDiar[13]] = '0';
                            $aDataDiar[$contd][$aLabelDiar[14]] = '';
                            $aDataDiar[$contd][$aLabelDiar[15]] = '';
                            $aDataDiar[$contd][$aLabelDiar[16]] = '';
                            $aDataDiar[$contd][$aLabelDiar[17]] = $det_dir;
                            $aDataDiar[$contd][$aLabelDiar[18]] = '';
                            $aDataDiar[$contd][$aLabelDiar[19]] = '';
                            $aDataDiar[$contd][$aLabelDiar[20]] = $cont;
                        } //cierre txt
                    } // fin foreach
                } // fin if

            }

            $_SESSION['aDataGirdDir'] = $aDataGrid;
            $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
            $oReturn->assign("divDir", "innerHTML", $sHtml);


            // DIARIO
            $sHtml = '';
            $_SESSION['aDataGirdDiar'] = $aDataDiar;


            $oReturn->assign("detalle", "value", $detalle);
            $oReturn->assign("cliente", "value", $clpv_cod);

            $oReturn->assign("cliente_nombre", "value", $nombre_proveedor);

            $sHtml = mostrar_grid_dia($idempresa, $idsucursal);

            $oReturn->assign("divDiario", "innerHTML", $sHtml);



            // TOTAL DIARIO
            $oReturn->script("total_diario();");
        } //CIERRE IF TIPO 1


        if ($contpag == 1) {
            $oReturn->script("cheque_pago('$nombre_proveedor', $total_cheque);");
            $oReturn->assign("codpgs", "value", $codpago);
        }

        if ($tipo == 2 || $tipo == 3 || $tipo == 4 || $tipo == 6 || $tipo == 7 || $tipo == 8 || $tipo == 9) {


            //Fondos
            if ($tipo == 3) {

                $sqlres = "select clpv_cod_clpv from saeclpv where clpv_ruc_clpv='$ben' and clpv_clopv_clpv = 'PV';";
                $ben_cod = consulta_string_func($sqlres, 'clpv_cod_clpv', $oIfxA, '');

                if (!$ben_cod) {
                    throw new Exception("No se encontro el proveedor, con num identificacion: $ben");
                }

                $oReturn->assign("detalle", "value", $motivo);
                $oReturn->assign("cliente", "value", $ben_cod);
                $oReturn->assign("clpv_cod", "value", $ben_cod);

                $oReturn->assign("cod_solicitud", "value", $codpago);
                $oReturn->assign("valor", "value", $totpago);
                $oReturn->assign("cliente_nombre", "value", $nombre);
                $oReturn->assign("clpv_nom", "value", $nombre);

                $oReturn->script('document.getElementById("clpv_empl").checked = false');
                $ccosn_cod = '';
                if ($codpago) {
                    $sql_ccos = "select pgs_cod_ccos from saepgs where pgs_cod_pgs = '$codpago' ";
                    $ccosn_cod = consulta_string_func($sql_ccos, 'pgs_cod_ccos', $oIfx, '');
                }
                $oReturn->assign("ccosn", "value", $ccosn_cod);

                $aniof = date('Y');
                $mesf = date('m');
                $diaf = date('d');
                $factura = $diaf . '' . $mesf . '' . $aniof;
                $oReturn->assign("tran", "value", 'AFR');
                $oReturn->assign("det_dir", "value", $motivo);
                $oReturn->assign("factura", "value", $factura);
                $oReturn->assign("fact_valor", "value", $totviat);

                $oReturn->script("anadir_dir();");
                $oReturn->script("cheque_pago('$nombre', $totviat);");
                $_SESSION['codSaepgs'] = $codpago;
                $oReturn->assign("cod_solicitud", "value", $codpago);


                /*
                //val_cta
                $oReturn->assign("detalle","value",$motivo);
                $oReturn->assign("cliente","value",$ben);
                $oReturn->assign("clpv_cod","value",$ben);


                $cuenta_cruce_fondos = '1.01.02.07.011';
                $oReturn->assign("cod_cta","value", $cuenta_cruce_fondos);
                $sql = "SELECT cuen_nom_cuen
                    from saecuen where
                    cuen_cod_cuen = '$cuenta_cruce_fondos'";

                $nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                $oReturn->assign("nom_cta","value", $nom_cuen);
                $oReturn->assign("val_cta","value", $totviat);
                $oReturn->assign("crdb","value", 'DB');
                // Codigo de la tabla saepgs ($codpago)
                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;

                $oReturn->assign("cod_solicitud","value", $codpago);
                $oReturn->assign("valor","value",$totpago);
                $oReturn->assign("cliente_nombre","value",$nombre);
                $oReturn->assign("clpv_nom","value",$nombre);

                $oReturn->script('document.getElementById("clpv_empl").checked = true');
                $ccosn_cod = '';
                if($codpago){
                    $sql_ccos    = "select pgs_cod_ccos from saepgs where pgs_cod_pgs = '$codpago' ";
                    $ccosn_cod = consulta_string_func($sql_ccos, 'pgs_cod_ccos', $oIfx, '');

                }
                $oReturn->assign("ccosn","value",$ccosn_cod);

                $oReturn->script("anadir_dasi();");
                // unset($_SESSION['codModu3']);
                // $_SESSION['codModu3'] = 'FONDOS';

                $oReturn->script("cheque_pago('$nombre', $totviat);");
                */
            } else if ($tipo == 2) {
                // Viaticos
                $sqlres = "select clpv_cod_clpv from saeclpv where clpv_ruc_clpv='$ben' and clpv_clopv_clpv = 'PV';";
                $ben_cod = consulta_string_func($sqlres, 'clpv_cod_clpv', $oIfxA, '');

                if (!$ben_cod) {
                    throw new Exception("No se encontro el proveedor, con num identificacion: $ben");
                }

                $oReturn->assign("detalle", "value", $motivo);
                $oReturn->assign("cliente", "value", $ben_cod);
                $oReturn->assign("clpv_cod", "value", $ben_cod);

                $cuenta_cruce_fondos = '1.01.02.07.006';
                $oReturn->assign("cod_cta", "value", $cuenta_cruce_fondos);
                $sql = "SELECT cuen_nom_cuen
					from saecuen where
					cuen_cod_cuen = '$cuenta_cruce_fondos'";

                $nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                $oReturn->assign("nom_cta", "value", $nom_cuen);
                $oReturn->assign("val_cta", "value", $totviat);
                $oReturn->assign("crdb", "value", 'DB');
                // Codigo de la tabla saepgs ($codpago)
                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;

                $oReturn->assign("valor", "value", $totpago);
                $oReturn->assign("cliente_nombre", "value", $nombre);
                $oReturn->assign("clpv_nom", "value", $nombre);
                $oReturn->script('document.getElementById("clpv_empl").checked = true');

                // DIARIO

                $oReturn->assign("cod_solicitud", "value", $codpago);
                $oReturn->assign("tran", "value", 'ANT');
                $oReturn->assign("det_dir", "value", $motivo);
                $oReturn->assign("factura", "value", date('Ymd'));
                $oReturn->assign("fact_valor", "value", $totviat);

                $oReturn->script("anadir_dir('1.01.02.07.006');");

                $oReturn->script("cheque_pago('$nombre', $totviat);");
            } else if ($tipo == 6) {
                // Viaticos
                $sqlres = "select clpv_cod_clpv from saeclpv where clpv_ruc_clpv like '%$ben%' and clpv_clopv_clpv = 'PV';";
                $ben_cod = consulta_string_func($sqlres, 'clpv_cod_clpv', $oIfxA, '');

                if (!$ben_cod) {
                    throw new Exception("No se encontro el proveedor, con num identificacion: $ben");
                }

                $oReturn->assign("detalle", "value", $motivo);
                $oReturn->assign("cliente", "value", $ben_cod);
                $oReturn->assign("clpv_cod", "value", $ben_cod);

                $sql_cuenta_resp = "select pcch_cod_cuen from saepcch where pcch_cod_empl like '%$ben%'";
                $pcch_cod_cuen = consulta_string_func($sql_cuenta_resp, 'pcch_cod_cuen', $oIfxA, '');

                $cuenta_cruce_fondos = $pcch_cod_cuen;
                $oReturn->assign("cod_cta", "value", $cuenta_cruce_fondos);
                $sql = "SELECT cuen_nom_cuen
					from saecuen where
					cuen_cod_cuen = '$cuenta_cruce_fondos'";

                $nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                $oReturn->assign("nom_cta", "value", $nom_cuen);
                $oReturn->assign("val_cta", "value", $totviat);
                $oReturn->assign("crdb", "value", 'DB');
                // Codigo de la tabla saepgs ($codpago)
                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;

                $oReturn->assign("valor", "value", $totpago);
                $oReturn->assign("cliente_nombre", "value", $nombre);
                $oReturn->assign("clpv_nom", "value", $nombre);
                $oReturn->script('document.getElementById("clpv_empl").checked = true');

                // DIARIO

                $oReturn->assign("cod_solicitud", "value", $codpago);
                $oReturn->assign("tran", "value", 'ANT');
                $oReturn->assign("det_dir", "value", $motivo);
                $oReturn->assign("factura", "value", date('Ymd'));
                $oReturn->assign("fact_valor", "value", $totviat);

                $oReturn->script("anadir_dir('$pcch_cod_cuen');");

                $oReturn->script("cheque_pago('$nombre', $totviat);");
            } else if ($tipo == 7) {
                // Viaticos
                $sqlres = "select clpv_cod_clpv, clpv_nom_clpv from saeclpv where clpv_ruc_clpv='$ben' and clpv_clopv_clpv = 'PV';";
                //            $oReturn->alert($sqlres);
                $ben_cod = consulta_string_func($sqlres, 'clpv_cod_clpv', $oIfxA, '');
                $nombre = consulta_string_func($sqlres, 'clpv_nom_clpv', $oIfxA, '');

                if (!$ben_cod) {
                    throw new Exception("No se encontro el proveedor, con num identificacion: $ben");
                }

                $oReturn->assign("detalle", "value", $motivo);
                $oReturn->assign("cliente", "value", $ben_cod);
                $oReturn->assign("clpv_cod", "value", $ben_cod);

                $cuenta_cruce_fondos = '1.01.02.11.001';
                $oReturn->assign("cod_cta", "value", $cuenta_cruce_fondos);
                $sql = "SELECT cuen_nom_cuen
					from saecuen where
					cuen_cod_cuen = '$cuenta_cruce_fondos'";

                $nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                $oReturn->assign("nom_cta", "value", $nom_cuen);
                $oReturn->assign("val_cta", "value", $totviat);
                $oReturn->assign("crdb", "value", 'DB');
                // Codigo de la tabla saepgs ($codpago)
                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;

                $oReturn->assign("valor", "value", $totpago);
                $oReturn->assign("cliente_nombre", "value", $nombre);
                $oReturn->assign("clpv_nom", "value", $nombre);
                $oReturn->script('document.getElementById("clpv_empl").checked = true');

                // DIARIO

                $oReturn->assign("cod_solicitud", "value", $codpago);
                $oReturn->assign("tran", "value", 'ANT');
                $oReturn->assign("det_dir", "value", $motivo);
                $oReturn->assign("factura", "value", date('Ymd'));
                $oReturn->assign("fact_valor", "value", $totviat);

                $oReturn->script("anadir_dir('1.01.02.11.001');");

                $oReturn->script("cheque_pago('$nombre', $totviat);");
            } else if ($tipo == 8) {
                // Viaticos
                //            $sqlres = "select clpv_cod_clpv, clpv_nom_clpv from saeclpv where clpv_ruc_clpv='$ben' and clpv_clopv_clpv = 'PV';";
                //            $oReturn->alert($sqlres);
                //            $ben_cod = consulta_string_func($sqlres, 'clpv_cod_clpv', $oIfxA, '');
                //            $nombre = consulta_string_func($sqlres, 'clpv_nom_clpv', $oIfxA, '');
                //
                //            if(!$ben_cod){
                //                throw new Exception( "No se encontro el proveedor, con num identificacion: $ben" );
                //            }

                $oReturn->assign("detalle", "value", $motivo);
                //            $oReturn->assign("cliente","value",$motivo);
                //            $oReturn->assign("clpv_cod","value",$ben_cod);

                //            $cuenta_cruce_fondos = '1.01.02.11.001';
                //            $oReturn->assign("cod_cta","value", $cuenta_cruce_fondos);
                //            $sql = "SELECT cuen_nom_cuen
                //					from saecuen where
                //					cuen_cod_cuen = '$cuenta_cruce_fondos'";
                //
                //            $nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                //            $oReturn->assign("nom_cta","value", $nom_cuen);
                $oReturn->assign("val_cta", "value", $totviat);
                //            $oReturn->assign("crdb","value", 'DB');
                //            // Codigo de la tabla saepgs ($codpago)
                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;

                $oReturn->assign("valor", "value", $totpago);
                $oReturn->assign("cliente_nombre", "value", $nombre);
                $oReturn->assign("clpv_nom", "value", $nombre);
                //            $oReturn->script('document.getElementById("clpv_empl").checked = true');

                //            // DIARIO

                $oReturn->assign("cod_solicitud", "value", $codpago);
                //            $oReturn->assign("tran","value", 'ANT');
                //            $oReturn->assign("det_dir","value", $motivo);
                //            $oReturn->assign("factura","value", date('Ymd'));
                $oReturn->assign("fact_valor", "value", $totviat);
                //
                //            $oReturn->script("anadir_dir('1.01.02.11.001');");

                $oReturn->script("cheque_pago('$nombre', $totviat);");
            } else if ($tipo == 9) {
                // Viaticos
                $sqlres = "select clpv_cod_clpv, clpv_nom_clpv from saeclpv where clpv_ruc_clpv='$ben' and clpv_clopv_clpv = 'PV';";
                //            $oReturn->alert($sqlres);
                $ben_cod = consulta_string_func($sqlres, 'clpv_cod_clpv', $oIfxA, '');
                $nombre = consulta_string_func($sqlres, 'clpv_nom_clpv', $oIfxA, '');

                if (!$ben_cod) {
                    throw new Exception("No se encontro el proveedor, con num identificacion: $ben");
                }

                $oReturn->assign("detalle", "value", $motivo);
                $oReturn->assign("cliente", "value", $ben_cod);
                $oReturn->assign("clpv_cod", "value", $ben_cod);

                $cuenta_cruce_fondos = '1.01.02.11.001';
                $oReturn->assign("cod_cta", "value", $cuenta_cruce_fondos);
                $sql = "SELECT cuen_nom_cuen
					from saecuen where
					cuen_cod_cuen = '$cuenta_cruce_fondos'";

                $nom_cuen = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
                $oReturn->assign("nom_cta", "value", $nom_cuen);
                $oReturn->assign("val_cta", "value", $totviat);
                $oReturn->assign("crdb", "value", 'DB');
                // Codigo de la tabla saepgs ($codpago)
                unset($_SESSION['codSaepgs']);
                $_SESSION['codSaepgs'] = $codpago;

                $oReturn->assign("valor", "value", $totpago);
                $oReturn->assign("cliente_nombre", "value", $nombre);
                $oReturn->assign("clpv_nom", "value", $nombre);
                $oReturn->script('document.getElementById("clpv_empl").checked = true');

                // DIARIO

                $oReturn->assign("cod_solicitud", "value", $codpago);
                $oReturn->assign("tran", "value", 'JP01');
                $oReturn->assign("det_dir", "value", $motivo);
                $oReturn->assign("factura", "value", date('Ymd'));
                $oReturn->assign("fact_valor", "value", $totviat);

                $oReturn->script("anadir_dir('1.01.02.11.001');");

                $oReturn->script("cheque_pago('$nombre', $totviat);");
            }
        }



        $oReturn->script("cerrarModal();");
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }
    return $oReturn;
}


function reporte_facturas($idempresa, $idsucursal, $clpv_cod, $factura, $tran_clpv, $det, $mone)
{
    //Definiciones
    global $DSN_Ifx;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN;

    $oReturn = new xajaxResponse();
    unset($_SESSION['U_FACTURA']);

    // CUENTAS DE CLPV
    $sql = "select clpv_cod_cuen, grpv_cod_grpv from saeclpv where clpv_cod_empr = $idempresa and clpv_cod_clpv = $clpv_cod ";
    $clpv_cuen = consulta_string_func($sql, 'clpv_cod_cuen', $oIfx, '');
    if (empty($clpv_cuen)) {
        $clpv_gr = consulta_string_func($sql, 'grpv_cod_grpv', $oIfx, '');
        $sql = "select  grpv_cta_grpv  from saegrpv where
                        grpv_cod_empr = $idempresa and
                        grpv_cod_grpv = '$clpv_gr' ";
        $clpv_cuen = consulta_string_func($sql, 'grpv_cta_grpv', $oIfx, '');
    }

    // ------------------------------------------------------------------------------------
    // TOMAMOS LA CUENTA CONTABLE DE LA MONEDA EN CASO DE TENER CONFIGURADO ADRIAN47
    // ------------------------------------------------------------------------------------
    $moneda_ad = $mone;
    $sql_moneda = "SELECT mone_cod_cuen from saemone where
										mone_cod_mone = $moneda_ad
										";
    $mone_cod_cuen = consulta_string_func($sql_moneda, 'mone_cod_cuen', $oIfx, '');
    if (!empty($mone_cod_cuen)) {
        $clpv_cuen = $mone_cod_cuen;
    }
    // ------------------------------------------------------------------------------------
    // FIN TOMAMOS LA CUENTA CONTABLE DE LA MONEDA EN CASO DE TENER CONFIGURADO ADRIAN47
    // ------------------------------------------------------------------------------------


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

    $sql_mone = "SELECT mone_cod_mone, mone_des_mone from saemone where mone_cod_empr = $idempresa ";
    unset($array_mone);
    $array_mone = array_dato($oIfx, $sql_mone, 'mone_cod_mone', 'mone_des_mone');


    $table_op .= '<table class="table table-bordered table-hover" align="center" style="width: 98%;">
					 <tr><td colspan="11" align="center" class="bg-primary">FACTURAS</td></tr>';
    $table_op .= '<tr>
                            <td align="center" colspan="6">*Detalle: <input style="text-transform: uppercase;" id="detalle_fact_vent" type="text" size="50" onkeyup="captura_detalle();"></td>
                            <td colspan="5" align="right">
                                <input type="button" value="ACEPTAR"
                                    onClick="javascript: cargar();"
                                    id="BuscaBtn" class="myButton_BT"
                                    style="width:80px; height:25px;" />
                            </td>
                     </tr>';
    $table_op .= '<tr>
                            <td align="center" class="bg-primary">N.-</td>
                            <td align="center" class="bg-primary">Sucursal</td>
                            <td align="center" class="bg-primary">Modena</td>
                            <td align="center" class="bg-primary">Cotiza.</td>
                            <!--
                            <td align="center" class="bg-primary">Tran</td>
                            -->
                            <td align="center" class="bg-primary">Factura</td>
                            <td align="center" class="bg-primary">F. Emision</td>
                            <td align="center" class="bg-primary">F. Vence</td>                            
                            <td align="center" class="bg-primary" style="display:none">Valor Rete.</td>
                            <td align="center" class="bg-primary">Saldo</td>
                            <td align="center" class="bg-primary"><input type="checkbox" name="check" value="S" onchange="cargar_tot();"></td>
                            <td align="right" class="bg-primary"></td> 
                     </tr>';

    // $sql_sp = "select * from sp_consulta_factprove_web( $idempresa, $idsucursal , $clpv_cod, '$factura' )";
    $sql_sp1 = "select dmcp_cod_sucu, dmcp_num_fac, dmcp_cod_mone, min(dcmp_fec_emis) as dcmp_fec_emis, max(dmcp_fec_ven) as dmcp_fec_ven, 
					   MAX((select sum(COALESCE(dcmp_deb_ml,0) - COALESCE(dcmp_cre_ml,0))
								from saedmcp y	where 
								y.dmcp_cod_empr = saedmcp.dmcp_cod_empr and 
								y.clpv_cod_clpv = saedmcp.clpv_cod_clpv and
								y.dmcp_num_fac  = saedmcp.dmcp_num_fac)) saldo
						from saedmcp WHERE 
						dmcp_cod_empr = $idempresa 	AND 
						clpv_cod_clpv = $clpv_cod	AND 
						dmcp_cod_sucu = $idsucursal and
						dmcp_est_dcmp <>'AN'  AND
						saedmcp.dmcp_num_fac in ( select trim(dmcp_num_fac) from saedmcp  WHERE 
													dmcp_cod_empr   = $idempresa AND 
													clpv_cod_clpv   = $clpv_cod and
													dcmp_fec_emis  <= CURRENT_DATE group by dmcp_num_fac
													having sum(dcmp_deb_ml) - sum(dcmp_cre_ml) <> 0 
												)
						group by dmcp_cod_sucu, dmcp_num_fac							
						having  sum(dcmp_deb_ml) - sum(dcmp_cre_ml) <> 0     
						ORDER BY dmcp_num_fac ";



    $sql_sp = "SELECT
                dmcp_num_fac,
                MIN ( dcmp_fec_emis ) AS dcmp_fec_emis,
                MAX ( dmcp_fec_ven ) AS dmcp_fec_ven,
                MAX ( dmcp_cod_mone ) AS dmcp_cod_mone,
                MAX ( dmcp_cod_ejer ) AS dmcp_cod_ejer,
                SUM ( dcmp_deb_ml ),
                SUM ( dmcp_deb_mext ),
                MAX (
                    (
                        SELECT SUM
                            ( COALESCE ( dcmp_deb_ml, 0 ) - COALESCE ( dcmp_cre_ml, 0 ) ) 
                        FROM
                            saedmcp y 
                        WHERE
                            y.dmcp_cod_empr = $idempresa 
                            AND y.clpv_cod_clpv = '$clpv_cod' 
                            AND y.dmcp_num_fac = saedmcp.dmcp_num_fac 
                        ) 
                    ) saldo,
                    MAX (
                        (
                        SELECT SUM
                            ( COALESCE ( dmcp_deb_mext, 0 ) - COALESCE ( dmcp_cre_mext, 0 ) ) 
                        FROM
                            saedmcp y 
                        WHERE
                            y.dmcp_cod_empr = $idempresa 
                            AND y.clpv_cod_clpv = '$clpv_cod'  
                            AND y.dmcp_num_fac = saedmcp.dmcp_num_fac 
                        ) 
                    ) saldo_mext,
                    MAX (
                        (
                        SELECT COALESCE
                            ( SUM ( dcmp_cre_ml ), 0 ) 
                        FROM
                            saedmcp x,
                            saetret,
                            saetran 
                        WHERE
                            x.dmcp_cod_empr = $idempresa 
                            AND x.clpv_cod_clpv = '$clpv_cod' 
                            AND saetran.tran_cod_tran = 'FAC' 
                            AND saetran.tran_cod_modu = x.dmcp_cod_modu 
                            AND saetran.tran_cod_empr = x.dmcp_cod_empr 
                            AND saetret.tret_cod = saetran.tran_cod_tret 
                            AND saetret.tret_cod_empr = saetran.tran_cod_empr 
                            AND x.dmcp_num_fac = saedmcp.dmcp_num_fac 
                        ) 
                    ) valor_rete 
                FROM
                    saedmcp 
                WHERE
                    dmcp_cod_empr = $idempresa 
                    AND clpv_cod_clpv = '$clpv_cod' 
                    AND dmcp_est_dcmp <> 'AN' 
                    -- AND dmcp_num_fac LIKE '%0180316%'
                GROUP BY
                    1 
                HAVING
                    MAX (
                        (
                        SELECT SUM
                            ( COALESCE ( dcmp_deb_ml, 0 ) - COALESCE ( dcmp_cre_ml, 0 ) ) 
                        FROM
                            saedmcp y 
                        WHERE
                    y.dmcp_cod_empr = $idempresa 
                            AND y.clpv_cod_clpv = '$clpv_cod' 
                            AND y.dmcp_num_fac = saedmcp.dmcp_num_fac 
                        ) 
                    ) <> 0 
                ORDER BY
                    dcmp_fec_emis
        ";




    $sql_sp = "SELECT
                    dmcp_num_fac,
                    dmcp_cod_mone,
                    MAX(dmcp_val_coti) AS dmcp_val_coti,
                    MAX(dmcp_cod_tran) AS dmcp_cod_tran, -- Si no funciona borrar esta linea
                    MIN ( dcmp_fec_emis ) AS dcmp_fec_emis,
                    MAX ( dmcp_fec_ven ) AS dmcp_fec_ven,
                    MAX ( dmcp_cod_ejer ) AS dmcp_cod_ejer,
                    SUM ( dcmp_deb_ml ) as dcmp_deb_ml,
                    SUM ( dmcp_deb_mext ) as dmcp_deb_mext,
                    SUM ( dcmp_cre_ml ) as dcmp_cre_ml,
                    SUM ( dmcp_cre_mext ) as dmcp_cre_mext,
                    SUM ( COALESCE ( dcmp_deb_ml, 0 ) - COALESCE ( dcmp_cre_ml, 0 ) ) as saldo,
                    SUM ( COALESCE ( dmcp_deb_mext, 0 ) - COALESCE ( dmcp_cre_mext, 0 ) ) as saldo_mext
                FROM
                    saedmcp 
                WHERE
                    dmcp_cod_empr = $idempresa 
                    AND clpv_cod_clpv = '$clpv_cod' 
                    AND dmcp_est_dcmp <> 'AN' 
                GROUP BY
                    1,2
                                HAVING
                    SUM ( COALESCE ( dcmp_deb_ml, 0 ) - COALESCE ( dcmp_cre_ml, 0 ) ) <> 0 
                ORDER BY
                    dcmp_fec_emis;
        ";

    // echo ($sql_sp);
    // exit;


    $sql_mone_base = "SELECT pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql_mone_base, 'pcon_mon_base', $oIfx, '');




    //$oReturn->alert($sql_sp);
    unset($array);
    $total = 0;
    $i = 1;
    $tot_ret = 0;
    //$oReturn->alert($sql_sp);
    if ($oIfx->Query($sql_sp)) {
        if ($oIfx->NumFilas() > 0) {
            do {
                //$tran     = $tran_cod;
                $tran = $oIfx->f('dmcp_cod_tran');
                $fact_num = $oIfx->f('dmcp_num_fac');
                $fec_emis = fecha_mysql_funcYmd($oIfx->f('dcmp_fec_emis'));
                $fec_venc = fecha_mysql_funcYmd($oIfx->f('dmcp_fec_ven'));
                $saldo = abs($oIfx->f('saldo'));
                $saldo_mext = abs($oIfx->f('saldo_mext'));
                $saldo_condicion = $oIfx->f('saldo');
                $dmcp_cod_mone = $oIfx->f('dmcp_cod_mone');
                $dmcp_val_coti = $oIfx->f('dmcp_val_coti');


                // Cuando se tiene una moneda diferente
                if ($dmcp_cod_mone != $mone_base) {
                    $saldo = $saldo_mext;
                }



                //echo $saldo;exit;
                $ret = $oIfx->f('ret');
                $sucu_nom = $array_sucu[$oIfx->f('dmcp_cod_sucu')];
                $mone_nom = $array_mone[$dmcp_cod_mone];
                $bgcolor = '';
                if ($saldo_condicion > 0) {
                    $tran = '';
                }

                $ifu->AgregarCampoTexto($i, '', false, 0, 100, 50);

                $ifu->AgregarComandoAlCambiarValor($i, "xajax_calculo( xajax.getFormValues('form1')) ");
                $ifu->AgregarComandoAlEscribir($i, 'mascara(this,cpf)');

                $array[$i] = array(
                    $i,
                    $fact_num,
                    $fec_emis,
                    $fec_venc,
                    $saldo,
                    $idempresa,
                    $idsucursal,
                    $clpv_cod,
                    $tran_clpv,
                    $det,
                    $clpv_cuen,
                    $cuen_nom,
                    $dmcp_cod_mone,
                    $dmcp_val_coti,
                    $tran
                );

                if ($sClass == 'off')
                    $sClass = 'on';
                else
                    $sClass = 'off';
                if ($saldo_condicion > 0) {
                    $table_op .= '<tr bgcolor="yellow" onClick="javascript:bajar_valor_a_cruzar(  \'' . $fact_num . '\' , \'' . $saldo . '\'   )">';
                } else {
                    $table_op .= '<tr  height="20" class="' . $sClass . '"
                                            onMouseOver="javascript:this.className=\'link\';"
                                            onMouseOut="javascript:this.className=\'' . $sClass . '\';">';
                }

                $table_op .= '<td align="right">' . $i . '</td>';
                $table_op .= '<td align="left">' . $sucu_nom . '</td>';
                $table_op .= '<td align="left">' . $mone_nom . '</td>';
                $table_op .= '<td align="left">' . $dmcp_val_coti . '</td>';
                /*
                $table_op .= '<td align="right">' . $tran . '</td>';
                */
                $table_op .= '<td align="right">' . $fact_num . '</td>';
                $table_op .= '<td align="right">' . $fec_emis . '</td>';
                $table_op .= '<td align="right">' . $fec_venc . '</td>';
                $table_op .= '<td align="right" style="display:none">' . $ret . '</td>';
                $table_op .= '<td align="right">' . number_format($saldo, 2, '.', ',') . '</td>';
                if ($saldo_condicion < 0) {
                    $table_op .= '<td align="right">' . $ifu->ObjetoHtml($i) . '</td>';
                    $table_op .= '<td align="right">
                                            <input type="button" value=".."
                                                    onClick="javascript:valor_fact(  \'' . $i . '\' , \'' . $saldo . '\'   )"
                                                    id="BuscaBtn" class="myButton_BT"
                                                    style="width:25px; height:18px;" />
                                     </td>';
                } else {
                    $table_op .= '<td colspan="2">VALOR A CRUZAR CON FACTURAS</td>';
                }

                $table_op .= '</tr>';
                $i++;
                $total += $saldo;
                $tot_ret += $ret;
            } while ($oIfx->SiguienteRegistro());
            $table_op .= '<tr height="20" class="' . $sClass . '"
                                            onMouseOver="javascript:this.className=\'link\';"
                                            onMouseOut="javascript:this.className=\'' . $sClass . '\';">';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right" class="fecha_letra">TOTAL:</td>';
            $table_op .= '<td align="right" class="fecha_letra" style="display:none">' . $tot_ret . '</td>';
            $table_op .= '<td align="right" class="fecha_letra">' . number_format($total, 2, '.', ',') . '</td>';
            $table_op .= '<td align="right" class="letra_rojo" id="tot_cobro">0.00</td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '</tr>';
        } else {
            $table_op = '<span class="fecha_letra">Sin Datos...</span>';
        }
    }
    $oIfx->Free();
    $table_op .= '</table>';

    $_SESSION['U_FACTURA'] = $array;

    $oReturn->assign("divFormularioDetalle", "innerHTML", $table_op);

    return $oReturn;
}

// CALCULO
function calculo($aForm)
{
    //Definiciones
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();
    $array = $_SESSION['U_FACTURA'];

    if (count($array) > 0) {
        $total = 0;
        foreach ($array as $val) {
            $id = $val[0];
            $txt = abs(str_replace(",", "", $aForm[$id]));

            $total += $txt;
        }
    }
    $oReturn->assign("tot_cobro", "innerHTML", number_format(round($total, 2), 2, '.', ','));

    return $oReturn;
}

function cargar_tot($aForm)
{
    //Definiciones
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();
    $array = $_SESSION['U_FACTURA'];
    $check = $aForm['check'];

    if (count($array) > 0) {
        $total = 0;

        if (!empty($check)) {
            foreach ($array as $val) {
                $id = $val[0];
                $valor = $val[4];

                $oReturn->assign($id, "value", $valor);
                $total += $valor;
            }
        } else {
            foreach ($array as $val) {
                $id = $val[0];
                $oReturn->assign($id, "value", 0);
            }
        }
    }
    $oReturn->assign("tot_cobro", "innerHTML", $total);

    return $oReturn;
}

// FACTURAS
function reporte_facturas_ret($idempresa, $idsucursal, $clpv_cod, $factura)
{
    //Definiciones
    global $DSN_Ifx;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN;

    $oReturn = new xajaxResponse();

    $table_op .= '<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">';
    $table_op .= '<legend class="Titulo">FACTURAS</legend>';
    $table_op .= '<table align="center" border="0" cellpadding="2" cellspacing="1" width="99%" class="footable">';
    $table_op .= '<tr>
                            <th class="diagrama">N.-</th>
                            <th class="diagrama">Tran</th>
                            <th class="diagrama">Factura</th>
                            <th class="diagrama">F. Emision</th>
                            <th class="diagrama">F. Vence</th>
                            <th class="diagrama">Saldo</th>
                            <th class="diagrama" style="display:none">Valor Rete.</th>
                     </tr>';

    $sql_sp = "SELECT * FROM sp_consulta_factprove_web( $idempresa, $idsucursal , $clpv_cod, '$factura' )";

    unset($array);
    $total = 0;
    $i = 1;
    $tot_ret = 0;
    if ($oIfx->Query($sql_sp)) {
        if ($oIfx->NumFilas() > 0) {
            do {
                $tran = $oIfx->f('tran');
                $fact_num = $oIfx->f('factura');
                $fec_emis = fecha_mysql_funcYmd($oIfx->f('fec_emis'));
                $fec_venc = fecha_mysql_funcYmd($oIfx->f('fec_ven'));
                $saldo = $oIfx->f('saldo_local');
                $ret = $oIfx->f('ret');

                // BASE IMPONIBLE
                list($a, $b, $c) = explode('-', $fact_num);
                $sql = "select  ( fact_con_miva + fact_sin_miva + fact_fle_fact  +  fact_otr_fact + fact_fin_fact ) as total  
                                    from saefact where
                                    fact_cod_clpv   = $clpv_cod and
                                    fact_num_preimp = '$b' and
                                    fact_cod_empr   = $idempresa and 
                                    fact_cod_sucu = $idsucursal ";
                $base = consulta_string_func($sql, 'total', $oIfxA, 0);

                if ($sClass == 'off')
                    $sClass = 'on';
                else
                    $sClass = 'off';
                $table_op .= '<tr height="20" class="' . $sClass . '"
                                            onMouseOver = "javascript:this.className=\'link\';"
                                            onMouseOut  = "javascript:this.className=\'' . $sClass . '\';" 
                                            onclick     = "cargar_fact(\'' . $fact_num . '\', \'' . $base . '\');">';
                $table_op .= '<td align="right">' . $i . '</td>';
                $table_op .= '<td align="right">' . $tran . '</td>';
                $table_op .= '<td align="right">' . $fact_num . '</td>';
                $table_op .= '<td align="right">' . $fec_emis . '</td>';
                $table_op .= '<td align="right">' . $fec_venc . '</td>';
                $table_op .= '<td align="right">' . $saldo . '</td>';
                $table_op .= '<td align="right" style="display:none">' . $ret . '</td>';
                $table_op .= '</tr>';
                $i++;
                $total += $saldo;
                $tot_ret += $ret;
            } while ($oIfx->SiguienteRegistro());
            $table_op .= '<tr height="20" class="' . $sClass . '"
                                            onMouseOver="javascript:this.className=\'link\';"
                                            onMouseOut="javascript:this.className=\'' . $sClass . '\';"
                                            onclick = "cargar_fact(\'' . $fact_num . '\');" >';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right"></td>';
            $table_op .= '<td align="right" class="fecha_letra">TOTAL:</td>';
            $table_op .= '<td align="right" class="fecha_letra">' . $total . '</td>';
            $table_op .= '<td align="right" class="fecha_letra" style="display:none">' . $tot_ret . '</td>';
            $table_op .= '</tr>';
        } else {
            $table_op = '<span class="fecha_letra">Sin Datos...</span>';
        }
    }
    $oIfx->Free();
    $table_op .= '</table></fieldset>';

    $oReturn->assign("divFormularioDetalle", "innerHTML", $table_op);

    return $oReturn;
}

// DIRECTORIO
function agrega_modifica_grid_dir($nTipo = 0, $aForm = '', $id = '', $idempresa = '', $coti = '', $mone_cod = '', $coti_ext = 0)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $aDataGrid = $_SESSION['aDataGirdDir'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];
    $array = $_SESSION['U_FACTURA'];

    $aLabelGrid = array(
        'Fila',
        'Cliente',
        'Subcliente',
        'Tipo',
        'Factura',
        'Fec. Vence',
        'Detalle',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'DI'
    );

    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad',
        'DIR',
        'RET'
    );


    $oReturn = new xajaxResponse();

    // VARIABLES
    $tran_cod = $aForm["tran"];
    $detalle = $aForm["det_dir"];
    $ccli_cod = $aForm["ccli"];




    $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

    if ($mone_cod == $mone_base) {
        $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
        $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

        $sql = "select tcam_val_tcam from saetcam where
				mone_cod_empr = $idempresa and
				tcam_cod_mone = $mone_extr and
				tcam_fec_tcam in (
									select max(tcam_fec_tcam)  from saetcam where
											mone_cod_empr = $idempresa and
											tcam_cod_mone = $mone_extr
								)  ";

        $coti = $coti_ext; //consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);

    }

    if ($nTipo == 0) {
        if (count($array) > 0) {
            $cont = 0;
            $contd = 0;
            $numero_facturas_seleccionado_ad = 0;
            $cod_transaccion = '';
            foreach ($array as $val) {
                $ix = $val[0];
                $fact_num = $val[1];
                $fec_emis = $val[2];
                $fec_venc = $val[3];
                $saldo = abs($val[4]);
                $idempresa = $val[5];
                $idsucursal = $val[6];
                $clpv_cod = $val[7];
                $tran_cod = $val[8];
                $det_dir = $val[9];
                $clpv_cuen = $val[10];
                $cuen_nom = $val[11];
                $dmcp_mone = $val[12];
                $dmcp_coti = $val[13];
                $tran_fact = $val[14];

                // ------------------------------------------------------------------------------------
                // Transaccion de la detracion cuenta
                // ------------------------------------------------------------------------------------


                // --------------------------------------------------------------------------
                // CUENTAS ADICIONALES PERU
                // --------------------------------------------------------------------------
                $empr_cod_pais = $_SESSION['U_PAIS_COD'];
                $sql_codInter_pais = "SELECT pais_codigo_inter from saepais where pais_cod_pais = $empr_cod_pais;";
                $codigo_pais = consulta_string_func($sql_codInter_pais, 'pais_codigo_inter', $oIfx, 0);

                $sql_pcon = "SELECT pcon_cue_niif from saepcon WHERE pcon_cod_empr = $idempresa;";
                $pcon_cue_niif = consulta_string_func($sql_pcon, 'pcon_cue_niif', $oIfx, 0);

                if ($codigo_pais == 51 && $pcon_cue_niif == 'S') {


                    $sql_retencion_bien = "SELECT pccp_tran_det from saepccp where pccp_cod_empr = $idempresa";
                    $pccp_tran_det = consulta_string_func($sql_retencion_bien, 'pccp_tran_det', $oIfx, '');
                    if ($pccp_tran_det == $tran_fact) {
                        $sql_cuen_tran = "SELECT tran_cod_cuen from saetran where tran_cod_tran = '$tran_fact' and tran_cod_modu = 4 and tran_cod_empr = $idempresa ";
                        $clpv_cuen = consulta_string_func($sql_cuen_tran, 'tran_cod_cuen', $oIfxA, '');

                        if (!empty($clpv_cuen)) {
                            $sql_cuen_nom = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$clpv_cuen' and cuen_cod_empr = $idempresa ";
                            $cuen_nom = consulta_string_func($sql_cuen_nom, 'cuen_nom_cuen', $oIfxA, '');
                        }
                    }
                }
                // ------------------------------------------------------------------------------------
                // FIN Transaccion de la detracion cuenta
                // ------------------------------------------------------------------------------------


                $txt = str_replace(",", "", $aForm[$ix]);
                if ($txt > 0) {

                    $numero_facturas_seleccionado_ad++;
                    $cod_transaccion = $tran_fact;

                    // DIRECTORIO
                    $cont = count($aDataGrid);
                    $aDataGrid[$cont][$aLabelGrid[0]] = floatval($cont);
                    $aDataGrid[$cont][$aLabelGrid[1]] = $clpv_cod;
                    $aDataGrid[$cont][$aLabelGrid[2]] = $ccli_cod;
                    $aDataGrid[$cont][$aLabelGrid[3]] = $tran_cod;
                    $aDataGrid[$cont][$aLabelGrid[4]] = $fact_num;
                    $aDataGrid[$cont][$aLabelGrid[5]] = $fec_venc;
                    $aDataGrid[$cont][$aLabelGrid[6]] = $det_dir;
                    $aDataGrid[$cont][$aLabelGrid[7]] = $dmcp_coti;

                    $valDirCre = 0;
                    $valDirDeb = $txt;

                    if ($mone_cod == $mone_base) {
                        // moneda local
                        $cre_tmp = 0;
                        $deb_tmp = 0;
                        if ($coti > 0) {
                            $cre_tmp = round(($valDirCre / $coti), 2);
                        }

                        if ($coti > 0) {
                            $deb_tmp = round(($valDirDeb / $coti), 2);
                        }

                        $aDataGrid[$cont][$aLabelGrid[8]] = $valDirDeb;
                        $aDataGrid[$cont][$aLabelGrid[9]] = $valDirCre;
                        $aDataGrid[$cont][$aLabelGrid[10]] = $deb_tmp;
                        $aDataGrid[$cont][$aLabelGrid[11]] = $cre_tmp;
                    } else {
                        // moneda extra

                        $aDataGrid[$cont][$aLabelGrid[8]] = $valDirDeb * $dmcp_coti;
                        $aDataGrid[$cont][$aLabelGrid[9]] = $valDirCre * $dmcp_coti;

                        $aDataGrid[$cont][$aLabelGrid[10]] = $valDirDeb;
                        $aDataGrid[$cont][$aLabelGrid[11]] = $valDirCre;

                        //tipo de transaccion
                        $sql_tipo_tran = "SELECT trans_tip_tran from saetran where tran_cod_tran = '$tran_cod' and tran_cod_modu = 4 and tran_cod_empr = $idempresa ";
                        $trans_tip_tran = consulta_string_func($sql_tipo_tran, 'trans_tip_tran', $oIfxA, '');

                        if ($trans_tip_tran == 'DB') {
                            $total_dire = $valDirDeb * $dmcp_coti;
                        } else if ($trans_tip_tran == 'CR') {
                            $total_dire = $valDirCre * $dmcp_coti;
                        }

                        //
                    }

                    $aDataGrid[$cont][$aLabelGrid[12]] = '';

                    $contd = count($aDataDiar);
                    $aDataGrid[$cont][$aLabelGrid[13]] = '<div align="center">
																<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
																title = "Presione aqui para Eliminar"
																style="cursor: hand !important; cursor: pointer !important;"
																onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
																alt="Eliminar"
																align="bottom" />
															</div>';
                    $aDataGrid[$cont][$aLabelGrid[14]] = $contd;


                    // DIARIO



                    $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
                    $aDataDiar[$contd][$aLabelDiar[1]] = $clpv_cuen;
                    $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom;
                    $aDataDiar[$contd][$aLabelDiar[3]] = $doc;
                    $aDataDiar[$contd][$aLabelDiar[4]] = $coti;


                    if ($mone_cod == $mone_base) {
                        // moneda local
                        $cre_tmp = 0;
                        $deb_tmp = 0;
                        if ($coti > 0) {
                            $cre_tmp = round(($valDirCre / $coti), 2);
                        }

                        if ($coti > 0) {
                            $deb_tmp = round(($valDirDeb / $coti), 2);
                        }

                        $aDataDiar[$contd][$aLabelDiar[5]] = $valDirDeb;
                        $aDataDiar[$contd][$aLabelDiar[6]] = $valDirCre;
                        $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
                        $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;

                        $oReturn->assign("cotizacion_fact_ori", "value", $coti);
                    } else {

                        $coti = $dmcp_coti;
                        $oReturn->assign("cotizacion_fact_ori", "value", $coti);

                        // moneda extra
                        $aDataDiar[$contd][$aLabelDiar[5]] = $valDirDeb * $coti;
                        $aDataDiar[$contd][$aLabelDiar[6]] = $valDirCre * $coti;
                        $aDataDiar[$contd][$aLabelDiar[7]] = $valDirDeb;
                        $aDataDiar[$contd][$aLabelDiar[8]] = $valDirCre;

                        if ($trans_tip_tran == 'DB') {
                            $total_diar = $valDirDeb * $coti;
                        } else if ($trans_tip_tran == 'CR') {
                            $total_diar = $valDirCre * $coti;
                        }
                    }

                    $aDataDiar[$contd][$aLabelDiar[9]] = '';
                    $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
																	title = "Presione aqui para Eliminar"
																	style="cursor: hand !important; cursor: pointer !important;"
																	onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
																	alt="Eliminar"
																	align="bottom" />';
                    $aDataDiar[$contd][$aLabelDiar[11]] = '';
                    $aDataDiar[$contd][$aLabelDiar[12]] = '';
                    $aDataDiar[$contd][$aLabelDiar[13]] = '0';
                    $aDataDiar[$contd][$aLabelDiar[14]] = '';
                    $aDataDiar[$contd][$aLabelDiar[15]] = '';
                    $aDataDiar[$contd][$aLabelDiar[16]] = '';
                    $aDataDiar[$contd][$aLabelDiar[17]] = $det_dir;
                    $aDataDiar[$contd][$aLabelDiar[18]] = '';
                    $aDataDiar[$contd][$aLabelDiar[19]] = '';
                    $aDataDiar[$contd][$aLabelDiar[20]] = $cont;



                    // --------------------------------------------------------------------------
                    // CUENTAS ADICIONALES PERU
                    // --------------------------------------------------------------------------
                    $empr_cod_pais = $_SESSION['U_PAIS_COD'];
                    $sql_codInter_pais = "SELECT pais_codigo_inter from saepais where pais_cod_pais = $empr_cod_pais;";
                    $codigo_pais = consulta_string_func($sql_codInter_pais, 'pais_codigo_inter', $oIfx, 0);

                    $sql_pcon = "SELECT pcon_cue_niif from saepcon WHERE pcon_cod_empr = $idempresa;";
                    $pcon_cue_niif = consulta_string_func($sql_pcon, 'pcon_cue_niif', $oIfx, 0);

                    if ($codigo_pais == 51 && $pcon_cue_niif == 'S') {
                        // Cuando es Peru baja dos cuentas adicionales: cuan_ana_deb y cuen_anal_cre
                        $sql_cuen = "SELECT cuen_ana_deb, cuen_ana_cre from saecuen where cuen_cod_cuen = '$clpv_cuen';";
                        $cuen_ana_deb = consulta_string_func($sql_cuen, 'cuen_ana_deb', $oIfx, 0);
                        $cuen_ana_cre = consulta_string_func($sql_cuen, 'cuen_ana_cre', $oIfx, 0);

                        $existe_cuenta = 'N';
                        foreach ($aDataDiar as $key => $value) {
                            if ($value['Cuenta'] == $cuen_ana_deb || $value['Cuenta'] == $cuen_ana_cre) {
                                $existe_cuenta = 'S';
                            }
                        }
                        if ($existe_cuenta == 'N') {
                            // --------------------------------------
                            // DEBITO
                            // --------------------------------------

                            $sql_cuen_deb = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_ana_deb';";
                            $cuen_nom_cuen_deb = consulta_string_func($sql_cuen_deb, 'cuen_nom_cuen', $oIfx, 0);
                            $oReturn->assign("cod_cta", "value", $cuen_ana_deb);
                            $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_deb);
                            $oReturn->assign("detalla_diario", "value", 'CUENTA ADICIONAL DEBITO');
                            // CR => Credito || DB => Debito
                            $oReturn->assign("crdb", "value", 'DB');
                            $oReturn->assign("val_cta", "value", $txt);
                            $oReturn->script("anadir_dasi();");

                            // --------------------------------------
                            // CREDITO
                            // --------------------------------------


                            $sql_cuen_cre = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_ana_cre';";
                            $cuen_nom_cuen_cre = consulta_string_func($sql_cuen_cre, 'cuen_nom_cuen', $oIfx, 0);
                            $oReturn->assign("cod_cta", "value", $cuen_ana_cre);
                            $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_cre);
                            $oReturn->assign("detalla_diario", "value", 'CUENTA ADICIONAL CREDITO');
                            // CR => Credito || DB => Debito
                            $oReturn->assign("crdb", "value", 'CR');
                            $oReturn->assign("val_cta", "value", $txt);
                            $oReturn->script("anadir_dasi();");
                        }
                    }

                    // --------------------------------------------------------------------------
                    // FIN CUENTAS ADICIONALES PERU
                    // --------------------------------------------------------------------------



                }
            } // fin foreach

            $sql_retencion_bien = "SELECT pccp_tran_det from saepccp where pccp_cod_empr = $idempresa";
            $pccp_tran_det = consulta_string_func($sql_retencion_bien, 'pccp_tran_det', $oIfx, '');

            if ($numero_facturas_seleccionado_ad == 1) {
                if ($pccp_tran_det == $cod_transaccion) {
                    $oReturn->assign('constancia_detraccion_sn', 'value', 'S');
                } else {
                    $oReturn->assign('constancia_detraccion_sn', 'value', 'N');
                }
            } else {
                $oReturn->assign('constancia_detraccion_sn', 'value', 'N');
            }
        } // fin if

    }

    // -----------------------------------------------------------------------------------
    // Verificamos si existe utilidado perdida en el tipo de cambio Adrian47
    // -----------------------------------------------------------------------------------


    if (!empty($total_dire) && !empty($total_diar)) {
        $diferencia_utilidad = $total_diar - $total_dire;
        if ($diferencia_utilidad < 0) {
            // UTILIDAD
            //INGRESA DEBITO
            $sql_cuen_utilidad = "SELECT pcon_cta_utic from saepcon where pcon_cod_empr = $idempresa ";
            $cuen_utilidad = consulta_string_func($sql_cuen_utilidad, 'pcon_cta_utic', $oIfx, '');
            $diferencia_utilidad_mext = round($diferencia_utilidad / $coti, 2);

            // INGRESO DEBITO
            $sql_cuen_deb = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_utilidad';";
            $cuen_nom_cuen_deb = consulta_string_func($sql_cuen_deb, 'cuen_nom_cuen', $oIfx, 0);
            $oReturn->assign("cod_cta", "value", $cuen_utilidad);
            $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_deb);
            $oReturn->assign("detalla_diario", "value", 'CUENTA UTILIDAD');
            // CR => Credito || DB => Debito
            $oReturn->assign("crdb", "value", 'DB');
            $oReturn->assign("val_cta", "value", $diferencia_utilidad_mext);
            $oReturn->script("anadir_dasi();");

            //
        } else if ($diferencia_utilidad > 0) {
            // PERDIDA
            //INGRESA CREDITO
            $diferencia_utilidad = abs($diferencia_utilidad);
            $sql_cuen_perdida = "SELECT pcon_cta_pedc from saepcon where pcon_cod_empr = $idempresa ";
            $cuen_perdida = consulta_string_func($sql_cuen_perdida, 'pcon_cta_pedc', $oIfx, '');
            $diferencia_utilidad_mext = round($diferencia_utilidad / $coti, 2);


            // INGRESO CREDITO
            $sql_cuen_cre = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_perdida';";
            $cuen_nom_cuen_cre = consulta_string_func($sql_cuen_cre, 'cuen_nom_cuen', $oIfx, 0);
            $oReturn->assign("cod_cta", "value", $cuen_perdida);
            $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_cre);
            $oReturn->assign("detalla_diario", "value", 'CUENTA PERDIDA');
            // CR => Credito || DB => Debito
            $oReturn->assign("crdb", "value", 'CR');
            $oReturn->assign("val_cta", "value", $diferencia_utilidad_mext);
            $oReturn->script("anadir_dasi();");
        }
    }

    // -----------------------------------------------------------------------------------
    // FIN Verificamos si existe utilidado perdida en el tipo de cambio
    // -----------------------------------------------------------------------------------


    $_SESSION['aDataGirdDir'] = $aDataGrid;
    $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
    $oReturn->assign("divDir", "innerHTML", $sHtml);

    // DIARIO
    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataDiar;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario", "innerHTML", $sHtml);

    // TOTAL DIARIO
    $oReturn->script("total_diario();");
    $oReturn->script("cerrarModalch();");

    //	$oReturn->script("cerrar_ventana();");
    return $oReturn;
}

// DIRECTRIO SIN FACTURA
function agrega_modifica_grid_dir_ori($nTipo = 0, $aForm = '', $cuenta_paso = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();


    try {

        $aDataGrid = $_SESSION['aDataGirdDir'];
        $aDataDiar = $_SESSION['aDataGirdDiar'];

        $aLabelGrid = array(
            'Fila',
            'Cliente',
            'Subcliente',
            'Tipo',
            'Factura',
            'Fec. Vence',
            'Detalle',
            'Cotizacion',
            'Debito Moneda Local',
            'Credito Moneda Local',
            'Debito Moneda Ext',
            'Credito Moneda Ext',
            'Modificar',
            'Eliminar',
            'DI'
        );

        $aLabelDiar = array(
            'Fila',
            'Cuenta',
            'Nombre',
            'Documento',
            'Cotizacion',
            'Debito Moneda Local',
            'Credito Moneda Local',
            'Debito Moneda Ext',
            'Credito Moneda Ext',
            'Modificar',
            'Eliminar',
            'Beneficiario',
            'Cuenta Bancaria',
            'Cheque',
            'Fecha Venc',
            'Formato Cheque',
            'Codigo Ctab',
            'Detalle',
            'Centro Costo',
            'Centro Actividad',
            'DIR',
            'RET'
        );

        $oReturn = new xajaxResponse();

        // VARIABLES
        $tran_cod = $aForm["tran"];
        $detalle = $aForm["det_dir"];
        $doc = $aForm["documento"];
        $idsucursal = $aForm["sucursal"];
        $ccosn_cod = $aForm["ccosn"];
        $act_cod = $aForm["actividad"];
        $ccli_cod = $aForm["ccli"];
        $cod_solicitud = $aForm["cod_solicitud"];

        if ($cod_solicitud) {
            $sql_ccos = "select pgs_cod_ccos from saepgs where pgs_cod_pgs = '$cod_solicitud' ";
            $ccosn_cod = consulta_string_func($sql_ccos, 'pgs_cod_ccos', $oIfx, '');
        }


        if (empty($idempresa)) {
            $idempresa = $aForm["empresa"];
        }

        if (empty($mone_cod)) {
            $mone_cod = $aForm["moneda"];
        }

        $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
        $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

        if ($mone_cod == $mone_base) {
            $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
            $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

            $sql = "select tcam_val_tcam from saetcam where
				mone_cod_empr = $idempresa and
				tcam_cod_mone = $mone_extr and
				tcam_fec_tcam in (
									select max(tcam_fec_tcam)  from saetcam where
											mone_cod_empr = $idempresa and
											tcam_cod_mone = $mone_extr
								)  ";

            $coti = $aForm["cotizacion_ext"]; // consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);

        } else {
            $coti = $aForm["cotizacion"];
        }

        if ($nTipo == 0) {
            $cont = 0;
            $contd = 0;
            $ix = $val[0];
            $fact_num = $aForm['factura'];
            $fec_emis = $aForm['fecha'];
            $fec_venc = $aForm['fecha'];
            //$saldo     = $val[4];
            //$idempresa = $val[5];
            //$idsucursal= $val[6];
            $clpv_cod = $aForm['clpv_cod'];
            $tran_cod = $aForm['tran'];
            $det_dir = $aForm['det_dir'];
            $tipo_clpv = $aForm['tipo_clpv'];
            //$clpv_cuen = $val[10];
            //$cuen_nom  = $val[11];

            $sql_modu = '';
            if ($tipo_clpv == 'PV') {
                $sql_modu = 'tran_cod_modu = 4 and';
            } else if ($tipo_clpv == 'CL') {
                $sql_modu = 'tran_cod_modu = 3 and';
            }


            $sql = "select tran_cod_cuen from saetran where 
								  tran_cod_tran = '$tran_cod' and 
								  tran_cod_sucu = $idsucursal and
								  tran_cod_empr = $idempresa and
                                  $sql_modu
								( tran_ant_tran = 1 or 
								  tran_cie_tran = 1   
								) ";
            $clpv_cuen = consulta_string_func($sql, 'tran_cod_cuen', $oIfx, '');

            if ($cuenta_paso) {
                $clpv_cuen = $cuenta_paso;
            }
            //					$oReturn->alert($clpv_cuen);

            // CUENTAS DE CLPV
            $sql = "select clpv_cod_cuen, grpv_cod_grpv, clpv_clopv_clpv from saeclpv where clpv_cod_empr = $idempresa and clpv_cod_clpv = $clpv_cod ";
            $tipo = consulta_string_func($sql, 'clpv_clopv_clpv', $oIfx, '');

            if (empty($clpv_cuen)) {
                $clpv_cuen = consulta_string_func($sql, 'clpv_cod_cuen', $oIfx, '');
                if (empty($clpv_cuen)) {
                    $clpv_gr = consulta_string_func($sql, 'grpv_cod_grpv', $oIfx, '');
                    $sql = "select  grpv_cta_grpv  from saegrpv where
										grpv_cod_empr = $idempresa and
										grpv_cod_grpv = '$clpv_gr' ";
                    $clpv_cuen = consulta_string_func($sql, 'grpv_cta_grpv', $oIfx, '');
                }
            }

            // ------------------------------------------------------------------------------------
            // TOMAMOS LA CUENTA CONTABLE DE LA MONEDA EN CASO DE TENER CONFIGURADO ADRIAN47
            // ------------------------------------------------------------------------------------
            $moneda_ad = $aForm['moneda'];
            $sql_moneda = "SELECT mone_cod_cuen from saemone where
										mone_cod_mone = $moneda_ad
										";
            $mone_cod_cuen = consulta_string_func($sql_moneda, 'mone_cod_cuen', $oIfx, '');
            if (!empty($mone_cod_cuen)) {
                $clpv_cuen = $mone_cod_cuen;
            }
            // ------------------------------------------------------------------------------------
            // FIN TOMAMOS LA CUENTA CONTABLE DE LA MONEDA EN CASO DE TENER CONFIGURADO ADRIAN47
            // ------------------------------------------------------------------------------------


            // NOMBRE CUENtA
            $sql = "select cuen_nom_cuen from saecuen where 
			                    cuen_cod_empr = $idempresa and
			                    cuen_cod_cuen = '$clpv_cuen' ";
            $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');

            if ($tipo_clpv == 'PV') {
                $mensaje_cuenta_error = "Cuenta contable: $clpv_cuen no existe. Parametrizar en Lado derecho/ Cuentas por Pagar/ Maestros de Transaccion. Transaccion: $tran_cod";
            } else if ($tipo_clpv == 'CL') {
                $mensaje_cuenta_error = "Cuenta contable: $clpv_cuen no existe. Parametrizar en Lado derecho/ Cuentas por Cobrar/ Maestros de Transaccion. Transaccion: $tran_cod";
            }

            if (empty($cuen_nom)) {
                throw new Exception($mensaje_cuenta_error);
            }


            //$tipo  	   = $val[12];
            $ccli = $aForm['ccli'];
            $txt = abs(str_replace(",", "", $aForm['fact_valor']));

            $valDirCre = 0;
            $valDiaCre = 0;
            $valDirDeb = 0;
            $valDiaDeb = 0;

            if ($tipo == 'CL') {
                $modulo = 3;
            } elseif ($tipo == 'PV') {
                $modulo = 4;
            }

            $modulo = 4;

            //tipo de transaccion
            $sql = "select trans_tip_tran from saetran where tran_cod_tran = '$tran_cod' and tran_cod_modu = $modulo and tran_cod_empr = $idempresa ";
            $trans_tip_tran = consulta_string($sql, 'trans_tip_tran', $oIfx, '');

            //$oReturn->alert($sql);

            if ($trans_tip_tran == 'DB') {
                $valDirDeb = $txt;
                $valDiaDeb = $txt;
            } elseif ($trans_tip_tran == 'CR') {
                $valDirCre = $txt;
                $valDiaCre = $txt;
            }

            // DIRECTORIO

            // Limpiar // de fecha
            $fec_venc = str_replace('/', '', $fec_venc);

            $cont = count($aDataGrid);
            $aDataGrid[$cont][$aLabelGrid[0]] = floatval($cont);
            $aDataGrid[$cont][$aLabelGrid[1]] = $clpv_cod;
            $aDataGrid[$cont][$aLabelGrid[2]] = $ccli_cod;
            $aDataGrid[$cont][$aLabelGrid[3]] = $tran_cod;
            $aDataGrid[$cont][$aLabelGrid[4]] = $fact_num;
            $aDataGrid[$cont][$aLabelGrid[5]] = $fec_venc;
            $aDataGrid[$cont][$aLabelGrid[6]] = $det_dir;
            $aDataGrid[$cont][$aLabelGrid[7]] = $coti;

            if ($mone_cod == $mone_base) {
                // moneda local
                $cre_tmp = 0;
                $deb_tmp = 0;
                if ($coti > 0) {
                    $cre_tmp = round(($valDirCre / $coti), 2);
                }

                if ($coti > 0) {
                    $deb_tmp = round(($valDirDeb / $coti), 2);
                }

                $aDataGrid[$cont][$aLabelGrid[8]] = $valDirDeb;
                $aDataGrid[$cont][$aLabelGrid[9]] = $valDirCre;
                $aDataGrid[$cont][$aLabelGrid[10]] = $deb_tmp;
                $aDataGrid[$cont][$aLabelGrid[11]] = $cre_tmp;
            } else {
                // moneda extra

                $aDataGrid[$cont][$aLabelGrid[8]] = $valDirDeb * $coti;
                $aDataGrid[$cont][$aLabelGrid[9]] = $valDirCre * $coti;

                $aDataGrid[$cont][$aLabelGrid[10]] = $valDirDeb;
                $aDataGrid[$cont][$aLabelGrid[11]] = $valDirCre;
            }

            $aDataGrid[$cont][$aLabelGrid[12]] = '';

            $contd = count($aDataDiar);
            $aDataGrid[$cont][$aLabelGrid[13]] = '<div align="center">
															<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
															alt="Eliminar"
															align="bottom" />
														</div>';


            $aDataGrid[$cont][$aLabelGrid[14]] = $contd;

            // DIARIO

            $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
            $aDataDiar[$contd][$aLabelDiar[1]] = $clpv_cuen;
            $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom;
            $aDataDiar[$contd][$aLabelDiar[3]] = $doc;
            $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

            if ($mone_cod == $mone_base) {
                // moneda local
                $cre_tmp = 0;
                $deb_tmp = 0;
                if ($coti > 0) {
                    $cre_tmp = round(($valDirCre / $coti), 2);
                }

                if ($coti > 0) {
                    $deb_tmp = round(($valDirDeb / $coti), 2);
                }

                $aDataDiar[$contd][$aLabelDiar[5]] = $valDiaDeb;
                $aDataDiar[$contd][$aLabelDiar[6]] = $valDiaCre;
                $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
                $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
            } else {
                // moneda extra
                $aDataDiar[$contd][$aLabelDiar[5]] = $valDiaDeb * $coti;
                $aDataDiar[$contd][$aLabelDiar[6]] = $valDiaCre * $coti;
                $aDataDiar[$contd][$aLabelDiar[7]] = $valDirDeb;
                $aDataDiar[$contd][$aLabelDiar[8]] = $valDirCre;
            }

            $aDataDiar[$contd][$aLabelDiar[9]] = '';
            $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
															alt="Eliminar"
															align="bottom" />';
            $aDataDiar[$contd][$aLabelDiar[11]] = '';
            $aDataDiar[$contd][$aLabelDiar[12]] = '';
            $aDataDiar[$contd][$aLabelDiar[13]] = '';
            $aDataDiar[$contd][$aLabelDiar[14]] = '';
            $aDataDiar[$contd][$aLabelDiar[15]] = '';
            $aDataDiar[$contd][$aLabelDiar[16]] = '';
            $aDataDiar[$contd][$aLabelDiar[17]] = $det_dir;
            $aDataDiar[$contd][$aLabelDiar[18]] = $ccosn_cod;
            $aDataDiar[$contd][$aLabelDiar[19]] = $act_cod;
            $aDataDiar[$contd][$aLabelDiar[20]] = $cont;


            /*$aLabelDiar = array('Fila', 'Cuenta', 'Nombre', 'Documento', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar',
                    'Beneficiario',   'Cuenta Bancaria',     'Cheque',     'Fecha Venc',  'Formato Cheque', 'Codigo Ctab', 'Detalle' );
                    */
        }

        $_SESSION['aDataGirdDir'] = $aDataGrid;
        $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
        $oReturn->assign("divDir", "innerHTML", $sHtml);

        // DIARIO
        $sHtml = '';
        $_SESSION['aDataGirdDiar'] = $aDataDiar;
        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario", "innerHTML", $sHtml);

        // TOTAL DIARIO
        $oReturn->script("total_diario();");
        $oReturn->script("cerrar_ventana();");
        $oReturn->assign('tran', 'value', 0);
        $oReturn->assign('ccli', 'value', 0);
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }
    return $oReturn;
}

function mostrar_grid_dir($idempresa, $idsucursal)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $aDataGrid = $_SESSION['aDataGirdDir'];
    $aLabelGrid = array(
        'Fila',
        'Cliente',
        'Subcliente',
        'Tipo',
        'Factura',
        'Fec. Vence',
        'Detalle',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'DI'
    );

    $cont = 0;
    $tot_cre = 0;
    $tot_deb = 0;

    if ($aDataGrid) {
        foreach ($aDataGrid as $aValues) {
            $aux = 0;
            foreach ($aValues as $aVal) {
                if ($aux == 0) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
                } elseif ($aux == 1) {
                    $sql = "select  clpv_nom_clpv from saeclpv where clpv_cod_clpv = $aVal and clpv_cod_empr = $idempresa ";
                    $clpv_nom = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $clpv_nom . '</div>';
                } elseif ($aux == 2) {
                    $aVal = $aVal = !0 ? $aVal : "aaa";
                    if (!$aVal) {
                        $aVal = "0";
                    }
                    $sql = "select ccli_nom_conta from saeccli 	where
												ccli_cod_empr = $idempresa and
												ccli_cod_ccli = '$aVal' ";
                    $ccli_nom = consulta_string_func($sql, 'ccli_nom_conta', $oIfx, '');
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $ccli_nom . '</div>';
                } elseif ($aux == 3) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
                } elseif ($aux == 4) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
                } elseif ($aux == 5) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
                } elseif ($aux == 6) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
                } elseif ($aux == 7) {    //Cotizacion
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                } elseif ($aux == 8) {    // DEBITO
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                    $tot_deb += $aVal;
                } elseif ($aux == 9) {    //CREDITO
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                    $tot_cre += $aVal;
                } elseif ($aux == 10) {    //DEBITO EXT
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                } elseif ($aux == 11) {    //CREDITO EXT
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                } elseif ($aux == 14) {    //DI
                    $di = $aVal;
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
                } elseif ($aux == 12) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
                                                                        <img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
                                                                        title = "Presione aqui para Eliminar"
                                                                        style="cursor: hand !important; cursor: pointer !important;"
                                                                        onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ');"
                                                                        alt="Eliminar"
                                                                        align="bottom" />
                                                                    </div>';
                } else
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                $aux++;
            }
            $cont++;
        }
    }

    $array = array('', '', '', '', '', '', '', '', $tot_deb, $tot_cre);
    return genera_grid($aDatos, $aLabelGrid, 'DIRECTORIO', 99, '', $array);
    //        $aData = null, $aLabel = null, $sTitulo = 'Reporte', $iAncho = '400', $aAccion = null,$Totales=null, $aOrden = null
}

function elimina_detalle_dir($id = null, $idempresa, $idsucursal, $id_di = '', $id_ret)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();

    $aLabelGrid = array(
        'Id',
        'Cliente',
        'Subcliente',
        'Tipo',
        'Factura',
        'Fec. Vence',
        'Detalle',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'DI'
    );

    unset($aDataGrid);
    $contador = 0;

    $aDataGrid = $_SESSION['aDataGirdDir'];
    $contador = count($aDataGrid);
    if ($contador > 1) {
        if (!empty($id)) {
            unset($aDataGrid[$id]);
            $aDataGrid = array_values($aDataGrid);

            $cont = 0;

            foreach ($aDataGrid as $aValues) {
                $aux = 0;
                foreach ($aValues as $aVal) {
                    if ($aux == 0) {
                        $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
                    } elseif ($aux == 12) {
                        $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
																				<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
																				title = "Presione aqui para Eliminar"
																				style="cursor: hand !important; cursor: pointer !important;"
																				onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ');"
																				alt="Eliminar"
																				align="bottom" />
																			</div>';
                    } else
                        $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                    $aux++;
                }
                $cont++;
            }

            $_SESSION['aDataGirdDir'] = $aDatos;
            $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
            $oReturn->assign("divDir", "innerHTML", $sHtml);
        } // fin fif
    } else {
        unset($aDataGrid[0]);
        $_SESSION['aDataGirdDir'] = $aDatos;
        $sHtml = "";
        $oReturn->assign("divDir", "innerHTML", $sHtml);
    }



    // DIARIO
    $aLabelGrid = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad',
        'DIR',
        'RET'
    );

    unset($aDataGrid);
    $contador = 0;
    $aDataGrid = $_SESSION['aDataGirdDiar'];
    $contador = count($aDataGrid);
    unset($aDatos);
    if ($contador > 1) {
        unset($aDataGrid[$id_di]);
        $aDataGrid = array_values($aDataGrid);
        $cont = 0;
        foreach ($aDataGrid as $aValues) {

            $aux = 0;
            foreach ($aValues as $aVal) {
                if ($aux == 0) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
                } elseif ($aux == 10) {
                    $vacio = '-1';
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
                                                                <img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_dir(' . $vacio . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $cont . ', -1 );"
                                                                alt="Eliminar"
                                                                align="bottom" />
                                                            </div>';
                } else
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                $aux++;
            }


            $cont++;
        }

        $_SESSION['aDataGirdDiar'] = $aDatos;
        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario", "innerHTML", $sHtml);
    } else {
        unset($aDataGrid[0]);
        $_SESSION['aDataGirdDiar'] = $aDatos;
        $sHtml = "";
        $oReturn->assign("divDiario", "innerHTML", $sHtml);
    }


    // RETENCION
    if ($id_ret >= 0) {
        $aLabelGrid = array(
            'Fila',
            'Cta Ret',
            'Cliente',
            'Factura',
            'Ret Cliente',
            'Porc(%)',
            'Base Impo',
            'Valor',
            'N.- Retencion',
            'Detalle',
            'Cotizacion',
            'Debito Moneda Local',
            'Credito Moneda Local',
            'Debito Moneda Ext',
            'Credito Moneda Ext',
            'Modificar',
            'Eliminar',
            'DI'
        );
        unset($aDataGrid);
        $contador = 0;

        $aDataGrid = $_SESSION['aDataGirdRet'];
        $contador = count($aDataGrid);

        unset($aDatos);
        if ($contador > 1) {
            unset($aDataGrid[$id_ret]);
            $aDataGrid = array_values($aDataGrid);
            $cont = 0;
            foreach ($aDataGrid as $aValues) {
                $aux = 0;
                foreach ($aValues as $aVal) {
                    if ($aux == 0) {
                        $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
                    } elseif ($aux == 15) {
                        $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
																	<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
																	title = "Presione aqui para Eliminar"
																	style="cursor: hand !important; cursor: pointer !important;"
																	onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ');"
																	alt="Eliminar"
																	align="bottom" />
																</div>';
                    } else
                        $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                    $aux++;
                }
                $cont++;
            }

            $_SESSION['aDataGirdRet'] = $aDatos;
            $sHtml = mostrar_grid_ret($idempresa, $idsucursal);
            $oReturn->assign("divRet", "innerHTML", $sHtml);
        } else {
            unset($aDataGrid[0]);
            $_SESSION['aDataGirdRet'] = $aDatos;
            $sHtml = "";
            $oReturn->assign("divRet", "innerHTML", $sHtml);
        }
    } // fin reten if

    // TOTAL DIARIO
    $oReturn->script("total_diario();");

    return $oReturn;
}



// DIARIO
function agrega_modifica_grid_dia($nTipo = 0, $aForm = '', $id = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $aDataDiar = $_SESSION['aDataGirdDiar'];

    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad'
    );
    $oReturn = new xajaxResponse();

    // VARIABLES
    $cod_cta = $aForm["cod_cta"];
    $nom_cta = $aForm["nom_cta"];
    $val_cta = str_replace(",", "", $aForm['val_cta']);
    // Adrian47
    $idempresa = $aForm["empresa"];
    $idsucursal = $aForm["sucursal"];
    $detalle = $aForm["detalla_diario"];
    $ccosn_cod = $aForm["ccosn"];
    $act_cod = $aForm["actividad"];
    $documento = $aForm["documento"];
    $mone_cod = $aForm["moneda"];

    $numero_deposito_detraccion = strtoupper($aForm["numero_deposito_detraccion"]);
    $fecha_emision_detraccion = $aForm["fecha_emision_detraccion"];
    if (!empty($numero_deposito_detraccion) && !empty($fecha_emision_detraccion)) {
        $detalle = 'PAGO DETRACCION: ' . $numero_deposito_detraccion . ' ' . $fecha_emision_detraccion;
    }




    if (!empty($cod_cta)) {

        $sql = "select COALESCE(cuen_cact_cuen,'N') AS cuen_cact_cuen, COALESCE(cuen_ccos_cuen, 'N')  as cuen_ccos_cuen
				from saecuen where
				cuen_cod_empr = $idempresa and
				cuen_cod_cuen = '$cod_cta'	";
        if ($oIfx->Query($sql)) {
            if ($oIfx->NumFilas() > 0) {
                $ccos_sn = $oIfx->f('cuen_ccos_cuen');
                $cact_sn = $oIfx->f('cuen_cact_cuen');
            } else {
                $ccos_sn = 'N';
                $cact_sn = 'N';
            }
        }

        if (empty($ccos_sn)) {
            $ccos_sn = 'N';
        }

        if (empty($cact_sn)) {
            $cact_sn = 'N';
        }


        $ctrl_sn = 0;
        $msn_erro = '';
        if ($ccos_sn == 'N' && $cact_sn == 'N') {
            $ctrl_sn = 1;
        }

        if ($ccos_sn == 'N' && $cact_sn == 'S') {
            if (strlen($act_cod) > 0) {
                $ctrl_sn = 1;
            } else {
                $msn_erro = '!!! Por favor Seleccione Centro Actividad...';
                $ctrl_sn = 0;
            }
        }

        if ($ccos_sn == 'S' && $cact_sn == 'N') {
            if (strlen($ccosn_cod) > 0) {
                $ctrl_sn = 1;
            } else {
                $msn_erro = '!!! Por favor Seleccione Centro Costo...';
                $ctrl_sn = 0;
            }
        }

        if ($ccos_sn == 'S' && $cact_sn == 'S') {
            if (strlen($ccosn_cod) > 0 && strlen($act_cod) > 0) {
                $ctrl_sn = 1;
            } else {
                $msn_erro = '!!! Por favor Seleccione Centro Costo - Centro Actividad. ...';
                $ctrl_sn = 0;
            }
        }

        $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
        $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

        if ($mone_cod == $mone_base) {
            $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
            $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

            $sql = "select tcam_val_tcam from saetcam where
                mone_cod_empr = $idempresa and
                tcam_cod_mone = $mone_extr and
                tcam_fec_tcam in (
                                    select max(tcam_fec_tcam)  from saetcam where
                                            mone_cod_empr = $idempresa and
                                            tcam_cod_mone = $mone_extr
                                )  ";

            $coti = $aForm["cotizacion_ext"]; //consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);
        } else {
            $coti = $aForm["cotizacion"];
        }

        $tipo = $aForm['crdb'];

        if ($tipo == 'CR') {
            $cred = $val_cta;
            $deb = 0;
        } elseif ($tipo == 'DB') {
            $cred = 0;
            $deb = $val_cta;
        }

        $val_cta_ad = $val_cta;


        if ($ctrl_sn == 1) {
            if ($nTipo == 0) {
                // DIARIO
                $contd = count($aDataDiar);
                $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
                $aDataDiar[$contd][$aLabelDiar[1]] = $cod_cta;
                $aDataDiar[$contd][$aLabelDiar[2]] = $nom_cta;
                $aDataDiar[$contd][$aLabelDiar[3]] = $documento;
                $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

                if ($mone_cod == $mone_base) {
                    // moneda local
                    $cre_tmp = 0;
                    $deb_tmp = 0;
                    if ($coti > 0) {
                        $cre_tmp = round(($cred / $coti), 2);
                    }

                    if ($coti > 0) {
                        $deb_tmp = round(($deb / $coti), 2);
                    }

                    $aDataDiar[$contd][$aLabelDiar[5]] = $deb;
                    $aDataDiar[$contd][$aLabelDiar[6]] = $cred;
                    $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
                    $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
                } else {
                    // moneda extra
                    $aDataDiar[$contd][$aLabelDiar[5]] = $deb * $coti;
                    $aDataDiar[$contd][$aLabelDiar[6]] = $cred * $coti;
                    $aDataDiar[$contd][$aLabelDiar[7]] = $deb;
                    $aDataDiar[$contd][$aLabelDiar[8]] = $cred;
                }

                $vacio = '-1';
                $aDataDiar[$contd][$aLabelDiar[9]] = '';
                $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:xajax_elimina_detalle_dir(' . $vacio . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
															alt="Eliminar"
															align="bottom" />';
                $aDataDiar[$contd][$aLabelDiar[11]] = '';
                $aDataDiar[$contd][$aLabelDiar[12]] = '';
                $aDataDiar[$contd][$aLabelDiar[13]] = '';
                $aDataDiar[$contd][$aLabelDiar[14]] = '';
                $aDataDiar[$contd][$aLabelDiar[15]] = '';
                $aDataDiar[$contd][$aLabelDiar[16]] = '';
                $aDataDiar[$contd][$aLabelDiar[17]] = $detalle;
                $aDataDiar[$contd][$aLabelDiar[18]] = $ccosn_cod;
                $aDataDiar[$contd][$aLabelDiar[19]] = $act_cod;
                //$oReturn->alert('asas');



                // --------------------------------------------------------------------------
                // CUENTAS ADICIONALES PERU
                // --------------------------------------------------------------------------
                $empr_cod_pais = $_SESSION['U_PAIS_COD'];
                $sql_codInter_pais = "SELECT pais_codigo_inter from saepais where pais_cod_pais = $empr_cod_pais;";
                $codigo_pais = consulta_string_func($sql_codInter_pais, 'pais_codigo_inter', $oIfx, 0);

                $sql_pcon = "SELECT pcon_cue_niif from saepcon WHERE pcon_cod_empr = $idempresa;";
                $pcon_cue_niif = consulta_string_func($sql_pcon, 'pcon_cue_niif', $oIfx, 0);

                if ($codigo_pais == 51 && $pcon_cue_niif == 'S') {
                    // Cuando es Peru baja dos cuentas adicionales: cuan_ana_deb y cuen_anal_cre
                    $sql_cuen = "SELECT cuen_ana_deb, cuen_ana_cre from saecuen where cuen_cod_cuen = '$cod_cta';";
                    $cuen_ana_deb = consulta_string_func($sql_cuen, 'cuen_ana_deb', $oIfx, 0);
                    $cuen_ana_cre = consulta_string_func($sql_cuen, 'cuen_ana_cre', $oIfx, 0);

                    $existe_cuenta = 'N';
                    foreach ($aDataDiar as $key => $value) {
                        if ($value['Cuenta'] == $cuen_ana_deb || $value['Cuenta'] == $cuen_ana_cre) {
                            $existe_cuenta = 'S';
                        }
                    }
                    if ($existe_cuenta == 'N') {

                        $total_adicional = $val_cta_ad;

                        // --------------------------------------
                        // DEBITO
                        // --------------------------------------

                        $sql_cuen_deb = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_ana_deb';";
                        $cuen_nom_cuen_deb = consulta_string_func($sql_cuen_deb, 'cuen_nom_cuen', $oIfx, 0);
                        $oReturn->assign("cod_cta", "value", $cuen_ana_deb);
                        $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_deb);
                        $oReturn->assign("detalla_diario", "value", 'CUENTA ADICIONAL DEBITO');
                        // CR => Credito || DB => Debito
                        $oReturn->assign("crdb", "value", 'DB');
                        $oReturn->assign("val_cta", "value", $total_adicional);
                        $oReturn->script("anadir_dasi();");

                        // --------------------------------------
                        // CREDITO
                        // --------------------------------------


                        $sql_cuen_cre = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_ana_cre';";
                        $cuen_nom_cuen_cre = consulta_string_func($sql_cuen_cre, 'cuen_nom_cuen', $oIfx, 0);
                        $oReturn->assign("cod_cta", "value", $cuen_ana_cre);
                        $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_cre);
                        $oReturn->assign("detalla_diario", "value", 'CUENTA ADICIONAL CREDITO47');
                        // CR => Credito || DB => Debito
                        $oReturn->assign("crdb", "value", 'CR');
                        $oReturn->assign("val_cta", "value", $total_adicional);
                        $oReturn->script("anadir_dasi();");
                    }
                }

                // --------------------------------------------------------------------------
                // FIN CUENTAS ADICIONALES PERU
                // --------------------------------------------------------------------------




            }

            // DIARIO
            $sHtml = '';
            $_SESSION['aDataGirdDiar'] = $aDataDiar;
            $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
            $oReturn->assign("divDiario", "innerHTML", $sHtml);

            $oReturn->assign("cod_cta", "value", '');
            $oReturn->assign("nom_cta", "value", '');
            $oReturn->assign("val_cta", "value", '');

            // TOTAL DIARIO
            $oReturn->script("total_diario();");

            $oReturn->script("cerrar_ventana();");
        } else {
            $oReturn->alert($msn_erro);
        }
    }

    return $oReturn;
}

function mostrar_grid_dia($idempresa, $idsucursal)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN, $DSN_Ifx;

    $oCnx = new Dbo();
    $oCnx->DSN = $DSN;
    $oCnx->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $idempresa = $_SESSION['U_EMPRESA'];
    $aDataGrid = $_SESSION['aDataGirdDiar'];

    $aLabelGrid = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad',
        'DIR',
        'RET'
    );
    $cont = 0;
    $tot_cre = 0;
    $tot_cre_ext = 0;
    $tot_deb = 0;
    $tot_deb_ext = 0;
    if ($aDataGrid) {
        foreach ($aDataGrid as $aValues) {
            $aux = 0;
            foreach ($aValues as $aVal) {
                if ($aux == 0) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = ($cont + 1);
                } elseif ($aux == 1) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 2) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 4) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                } elseif ($aux == 5) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                    $tot_deb += $aVal;
                } elseif ($aux == 6) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                    $tot_cre += $aVal;
                } elseif ($aux == 7) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                    $tot_deb_ext += $aVal;
                } elseif ($aux == 8) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                    $tot_cre_ext += $aVal;
                } elseif ($aux == 9) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:modificar_valor(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ');"
															alt="Eliminar"
															align="bottom" />';
                } elseif ($aux == 11) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 12) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 13) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 14) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 15) {
                    // FORMATO
                    if (!$aVal) {
                        $aVal = "0";
                    }
                    $sql = "select  ftrn_des_ftrn  from saeftrn where
                                    ftrn_cod_empr = $idempresa and
                                    ftrn_cod_ftrn = '$aVal'  ";
                    $ftrn_nom = consulta_string_func($sql, 'ftrn_des_ftrn', $oIfx, 0);
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $ftrn_nom . '</div>';
                } elseif ($aux == 16) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 17) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                } elseif ($aux == 18) {
                    // CENTRO COSTO
                    $sql = "select ccosn_cod_ccosn, ( ccosn_nom_ccosn || ' - ' || ccosn_cod_ccosn ) as  ccosn_nom_ccosn from saeccosn where
									ccosn_cod_empr  = $idempresa and
									ccosn_mov_ccosn = 1 and
									ccosn_cod_ccosn = '$aVal' ";
                    $ccosn_nom = consulta_string_func($sql, 'ccosn_nom_ccosn', $oIfx, '');
                    $aDatos[$cont][$aLabelGrid[$aux]] = $ccosn_nom;
                } elseif ($aux == 19) {
                    // CENTRO ACTIVIDAD
                    $sql = "select cact_cod_cact , ( cact_nom_cact ||  ' - ' || cact_cod_cact ) as cact_nom_cact from saecact where
										cact_cod_empr = $idempresa and
										cact_cod_cact = '$aVal'  ";
                    $act_nom = consulta_string_func($sql, 'cact_nom_cact', $oIfx, '');
                    $aDatos[$cont][$aLabelGrid[$aux]] = $act_nom;
                } else
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                $aux++;
            }
            $cont++;
        }
    }

    $array = array('', '', '', '', '', $tot_deb, $tot_cre, $tot_deb_ext, $tot_cre_ext);
    return genera_grid($aDatos, $aLabelGrid, 'DIARIO', 99, '', $array);
}

function elimina_detalle_dia($id = null, $idempresa, $idsucursal)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();

    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito',
        'Credito',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad',
        'DIR',
        'RET'
    );

    $aDataGrid = $_SESSION['aDataGirdDiar'];
    $contador = count($aDataGrid);
    if ($contador > 1) {
        unset($aDataGrid[$id]);
        $_SESSION['aDataGirdDiar'] = $aDataGrid;

        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario", "innerHTML", $sHtml);
    } else {
        unset($aDataGrid[0]);
        $_SESSION['aDataGirdDiar'] = $aDatos;
        $sHtml = "";
        $oReturn->assign("divDiario", "innerHTML", $sHtml);

        $aDataGridDir = $_SESSION['aDataGirdDir'];
        $contadorDir = count($aDataGridDir);
        if ($contadorDir > 1) {
            unset($aDataGridDir[$id]);
            $_SESSION['aDataGirdDir'] = $aDataGridDir;
            $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
            $oReturn->assign("divDir", "innerHTML", $sHtml);
        } else {
            unset($aDataGridDir[0]);
            $_SESSION['aDataGirdDir'] = $aDatos;
            $sHtml = "";
            $oReturn->assign("divDir", "innerHTML", $sHtml);
        }
    }


    return $oReturn;
}



// RETENCION
function agrega_modifica_grid_ret($nTipo = 0, $aForm = '', $id = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $aDataGrid = $_SESSION['aDataGirdRet'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];

    $aLabelGrid = array(
        'Fila',
        'Cta Ret',
        'Cliente',
        'Factura',
        'Ret Cliente',
        'Porc(%)',
        'Base Impo',
        'Valor',
        'N.- Retencion',
        'Detalle',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'DI'
    );

    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad',
        'DIR',
        'RET'
    );

    $oReturn = new xajaxResponse();

    // VARIABLES
    $idempresa = $aForm["empresa"];
    $idsucursal = $aForm["sucursal"];
    $cod_ret = $aForm["cod_ret"];
    $fact_ret = $aForm["fact_ret"];
    $clpv_ret = $aForm["ret_clpv"];
    $porc_ret = $aForm["ret_porc"];
    $base_ret = str_replace(",", "", $aForm['ret_base']);
    $val_ret = round(($base_ret * $porc_ret / 100), 2);
    $num_ret = $aForm["ret_num"];
    $det_ret = $aForm["ret_det"];
    $cta_deb = $aForm["cta_deb"];
    $cta_cre = $aForm["cta_cre"];
    $tipo = $aForm["tipo"];
    $clpv_nom = $aForm["clpv_nom"];
    $clpv_cod = $aForm["clpv_cod"];
    $mone_cod = $aForm["moneda"];

    $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

    if ($mone_cod == $mone_base) {
        $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
        $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

        $coti = $aForm["cotizacion_ext"];
    } else {
        $coti = $aForm["cotizacion"];
    }

    $valDirCre = 0;
    $valDiaCre = 0;
    $valDirDeb = 0;
    $valDiaDeb = 0;

    $val_deb = 0;
    $val_cre = 0;
    if ($tipo == 'CR') {
        // CREDITO
        $sql = "select cuen_nom_cuen from saecuen where 
				cuen_cod_empr = $idempresa and
				cuen_cod_cuen = '$cta_cre' ";
        $val_cre = $val_ret;
        $valDirCre = $val_ret;
        $valDiaCre = $val_ret;
    } else {
        // DEBITO
        $sql = "select cuen_nom_cuen from saecuen where 
				cuen_cod_empr = $idempresa and
				cuen_cod_cuen = '$cta_deb' ";
        $val_deb = $val_ret;
        $valDirDeb = $val_ret;
        $valDiaDeb = $val_ret;
    }
    $cuen_nom = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');

    if ($nTipo == 0) {
        // RETENCION
        $cont = count($aDataGrid);
        $aDataGrid[$cont][$aLabelGrid[0]] = floatval($cont);
        $aDataGrid[$cont][$aLabelGrid[1]] = $cod_ret;
        $aDataGrid[$cont][$aLabelGrid[2]] = $clpv_cod;
        $aDataGrid[$cont][$aLabelGrid[3]] = $fact_ret;
        $aDataGrid[$cont][$aLabelGrid[4]] = $clpv_ret;
        $aDataGrid[$cont][$aLabelGrid[5]] = $porc_ret;
        $aDataGrid[$cont][$aLabelGrid[6]] = $base_ret;
        $aDataGrid[$cont][$aLabelGrid[7]] = $val_ret;
        $aDataGrid[$cont][$aLabelGrid[8]] = $num_ret;
        $aDataGrid[$cont][$aLabelGrid[9]] = $det_ret;
        $aDataGrid[$cont][$aLabelGrid[10]] = $coti;

        if ($mone_cod == $mone_base) {
            // moneda local
            $cre_tmp = 0;
            $deb_tmp = 0;
            if ($coti > 0) {
                $cre_tmp = round(($valDirCre / $coti), 2);
            }

            if ($coti > 0) {
                $deb_tmp = round(($valDirDeb / $coti), 2);
            }

            $aDataGrid[$cont][$aLabelGrid[11]] = $valDirDeb;
            $aDataGrid[$cont][$aLabelGrid[12]] = $valDirCre;
            $aDataGrid[$cont][$aLabelGrid[13]] = $deb_tmp;
            $aDataGrid[$cont][$aLabelGrid[14]] = $cre_tmp;
        } else {
            // moneda extra

            $aDataGrid[$cont][$aLabelGrid[11]] = $valDirDeb * $coti;
            $aDataGrid[$cont][$aLabelGrid[12]] = $valDirCre * $coti;

            $aDataGrid[$cont][$aLabelGrid[13]] = $valDirDeb;
            $aDataGrid[$cont][$aLabelGrid[14]] = $valDirCre;
        }

        $aDataGrid[$cont][$aLabelGrid[15]] = '';

        $contd = count($aDataDiar);
        $aDataGrid[$cont][$aLabelGrid[16]] = '<div align="center">
													<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
													title = "Presione aqui para Eliminar"
													style="cursor: hand !important; cursor: pointer !important;"
													onclick="javascript:xajax_elimina_detalle_ret(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ');"
													alt="Eliminar"
													align="bottom" />
												</div>';
        $aDataGrid[$cont][$aLabelGrid[17]] = $contd;

        // DIARIO
        $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
        $aDataDiar[$contd][$aLabelDiar[1]] = $cta_cre . $cta_deb;
        $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom;
        $aDataDiar[$contd][$aLabelDiar[3]] = $doc;
        $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

        if ($mone_cod == $mone_base) {
            // moneda local
            $cre_tmp = 0;
            $deb_tmp = 0;
            if ($coti > 0) {
                $cre_tmp = round(($valDirCre / $coti), 2);
            }

            if ($coti > 0) {
                $deb_tmp = round(($valDirDeb / $coti), 2);
            }

            $aDataDiar[$contd][$aLabelDiar[5]] = $valDiaDeb;
            $aDataDiar[$contd][$aLabelDiar[6]] = $valDiaCre;
            $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
            $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
        } else {
            // moneda extra
            $aDataDiar[$contd][$aLabelDiar[5]] = $valDiaDeb * $coti;
            $aDataDiar[$contd][$aLabelDiar[6]] = $valDiaCre * $coti;
            $aDataDiar[$contd][$aLabelDiar[7]] = $valDirDeb;
            $aDataDiar[$contd][$aLabelDiar[8]] = $valDirCre;
        }

        $vacio = '-1';
        $aDataDiar[$contd][$aLabelDiar[9]] = '';
        $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
																	title = "Presione aqui para Eliminar"
																	style="cursor: hand !important; cursor: pointer !important;"
																	onclick="javascript:xajax_elimina_detalle_dir(' . $vacio . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', ' . $cont . '  );"
																	alt="Eliminar"
																	align="bottom" />';
        $aDataDiar[$contd][$aLabelDiar[11]] = '';
        $aDataDiar[$contd][$aLabelDiar[12]] = '';
        $aDataDiar[$contd][$aLabelDiar[13]] = '';
        $aDataDiar[$contd][$aLabelDiar[14]] = '';
        $aDataDiar[$contd][$aLabelDiar[15]] = '';
        $aDataDiar[$contd][$aLabelDiar[16]] = '';
        $aDataDiar[$contd][$aLabelDiar[17]] = $det_dir;
        $aDataDiar[$contd][$aLabelDiar[18]] = '';
        $aDataDiar[$contd][$aLabelDiar[19]] = '';
        $aDataDiar[$contd][$aLabelDiar[20]] = '';
        $aDataDiar[$contd][$aLabelDiar[21]] = $cont;
    }

    // RETENCION
    $_SESSION['aDataGirdRet'] = $aDataGrid;
    $sHtml = mostrar_grid_ret($idempresa, $idsucursal);
    $oReturn->assign("divRet", "innerHTML", $sHtml);

    // DIARIO
    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataDiar;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario", "innerHTML", $sHtml);

    // TOTAL DIARIO
    $oReturn->script("total_diario();");

    $oReturn->script("cerrar_ventana();");
    return $oReturn;
}

function mostrar_grid_ret($idempresa, $idsucursal)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $aDataGrid = $_SESSION['aDataGirdRet'];
    $aLabelGrid = array(
        'Fila',
        'Cta Ret',
        'Cliente',
        'Factura',
        'Ret Cliente',
        'Porc(%)',
        'Base Impo',
        'Valor',
        'N.- Retencion',
        'Detalle',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'DI'
    );
    $cont = 0;
    $tot_cre = 0;
    $tot_deb = 0;
    $tot_cre_ext = 0;
    $tot_deb_ext = 0;
    foreach ($aDataGrid as $aValues) {
        $aux = 0;
        foreach ($aValues as $aVal) {
            if ($aux == 0) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
            } elseif ($aux == 2) {
                $sql = "select  clpv_nom_clpv from saeclpv where clpv_cod_clpv = $aVal and clpv_cod_empr = $idempresa ";
                $clpv_nom = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $clpv_nom . '</div>';
            } elseif ($aux == 3) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
            } elseif ($aux == 4) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
            } elseif ($aux == 5) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . $aVal . '</div>';
            } elseif ($aux == 6) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . $aVal . '</div>';
            } elseif ($aux == 7) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
            } elseif ($aux == 8) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
            } elseif ($aux == 9) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="left">' . $aVal . '</div>';
            } elseif ($aux == 10) {        // COTIZACION
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
            } elseif ($aux == 11) {        // DEBITO Moneda
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                $tot_deb += $aVal;
            } elseif ($aux == 12) {        // Credito Moneda
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                $tot_cre += $aVal;
            } elseif ($aux == 13) {        // DEBITO Moneda Ext
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                $tot_deb_ext += $aVal;
            } elseif ($aux == 14) {    // Credito Moneda Ext
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . number_format(round($aVal, 2), 2, '.', ',') . '</div>';
                $tot_cre_ext += $aVal;
            } elseif ($aux == 15) {
                $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
                                                                <img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_ret(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ');"
                                                                alt="Eliminar"
                                                                align="bottom" />
                                                            </div>';
            } else
                $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
            $aux++;
        }
        $cont++;
    }
    $array = array('', '', '', '', '', '', '', '', '', '', '', $tot_deb, $tot_cre, $tot_deb_ext, $tot_cre_ext, '', '');
    return genera_grid($aDatos, $aLabelGrid, 'RETENCION', 99, '', $array);
}

function elimina_detalle_ret($id = null, $idempresa, $idsucursal, $id_di)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();

    $aLabelGrid = array(
        'Fila',
        'Cta Ret',
        'Cliente',
        'Factura',
        'Ret Cliente',
        'Porc(%)',
        'Base Impo',
        'Valor',
        'N.- Retencion',
        'Detalle',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'DI'
    );

    $aDataGrid = $_SESSION['aDataGirdRet'];

    $contador = count($aDataGrid);
    if ($contador > 1) {
        unset($aDataGrid[$id]);
        $aDataGrid = array_values($aDataGrid);
        $cont = 0;

        foreach ($aDataGrid as $aValues) {
            $aux = 0;
            foreach ($aValues as $aVal) {
                if ($aux == 0) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
                } elseif ($aux == 15) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
																			<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
																			title = "Presione aqui para Eliminar"
																			style="cursor: hand !important; cursor: pointer !important;"
																			onclick="javascript:xajax_elimina_detalle_ret(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ');"
																			alt="Eliminar"
																			align="bottom" />
																		</div>';
                } else
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                $aux++;
            }
            $cont++;
        }

        $_SESSION['aDataGirdRet'] = $aDatos;
        $sHtml = mostrar_grid_ret($idempresa, $idsucursal);
        $oReturn->assign("divRet", "innerHTML", $sHtml);
    } else {
        unset($aDataGrid[0]);
        $_SESSION['aDataGirdRet'] = $aDatos;
        $sHtml = "";
        $oReturn->assign("divRet", "innerHTML", $sHtml);
    }


    // DIARIO
    $aLabelGrid = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito',
        'Credito',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad',
        'DIR',
        'RET'
    );

    unset($aDataGrid);
    $contador = 0;
    $aDataGrid = $_SESSION['aDataGirdDiar'];
    $contador = count($aDataGrid);
    unset($aDatos);
    if ($contador > 1) {
        unset($aDataGrid[$id_di]);
        $aDataGrid = array_values($aDataGrid);
        $cont = 0;
        foreach ($aDataGrid as $aValues) {
            $aux = 0;
            foreach ($aValues as $aVal) {
                if ($aux == 0) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="right">' . ($cont + 1) . '</div>';
                } elseif ($aux == 7) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
                                                                <img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/pencil.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ');"
                                                                alt="Eliminar"
                                                                align="bottom" />
                                                            </div>';
                } elseif ($aux == 8) {
                    $aDatos[$cont][$aLabelGrid[$aux]] = '<div align="center">
                                                                <img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_dir(' . $cont . ', ' . $idempresa . ', ' . $idsucursal . ');"
                                                                alt="Eliminar"
                                                                align="bottom" />
                                                            </div>';
                } else
                    $aDatos[$cont][$aLabelGrid[$aux]] = $aVal;
                $aux++;
            }
            $cont++;
        }

        $_SESSION['aDataGirdDiar'] = $aDatos;
        $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
        $oReturn->assign("divDiario", "innerHTML", $sHtml);
    } else {
        unset($aDataGrid[0]);
        $_SESSION['aDataGirdDiar'] = $aDatos;
        $sHtml = "";
        $oReturn->assign("divDiario", "innerHTML", $sHtml);
    }

    // TOTAL DIARIO
    $oReturn->script("total_diario();");

    return $oReturn;
}


/********************************************
G U A R D A R     T R A N S A C C I O N
 ********************************************/
function guardar($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oReturn = new xajaxResponse();

    //      VARIABLES
    $user_web = $_SESSION['U_ID'];
    $user_ifx = $_SESSION['U_USER_INFORMIX'];
    $aDataGrid = $_SESSION['aDataGirdDir'];
    $aDataDiar = $_SESSION['aDataGirdDiar'];
    $aDataGridRet = $_SESSION['aDataGirdRet'];

    $idempresa = $aForm['empresa'];
    $idsucursal = $aForm['sucursal'];
    $tidu_cod = $aForm['tipo_doc'];
    $fecha_mov = $aForm['fecha'];

    $clpv_ruc = $aForm['ruc'];
    $clpv_nom = $aForm['cliente_nombre'];
    $clpv_cod = $aForm['cliente'];
    $empl_cod = $aForm['empleado'];
    $asto_val = str_replace(",", "", $aForm['valor']);
    $form_cod = $aForm['formato'];
    $deas = $aForm['deas'];
    $deta_asto = $aForm['detalle'];
    $asto_cod = $aForm['asto_cod'];
    $moneda_f = $aForm['moneda'];
    $cotizacion = $aForm['cotizacion'];
    $comp_cod = $aForm['compr_cod'];
    $time = date("Y-m-d H:i:s");
    $cod_solicitud = $aForm['cod_solicitud'];

    if (empty($clpv_cod)) {
        $clpv_cod = 0;
    }

    // ---------------------------------------------------------------
    // Control asientos dfescuadrados
    // ---------------------------------------------------------------
    $debito_loc = 0;
    $credito_loc = 0;
    $debito_ext = 0;
    $credito_ext = 0;
    foreach ($aDataDiar as $value) {
        // MONEDA LOCAL
        $debito_loc += $value['Debito Moneda Local'];
        $credito_loc += $value['Credito Moneda Local'];
        // MONEDA EXTRANJERA
        $debito_ext += $value['Debito Moneda Ext'];
        $credito_ext += $value['Credito Moneda Ext'];
    }

    $tot_loc = number_format($debito_loc, 2, '.', '') - number_format($credito_loc, 2, '.', '');
    $tot_ext = number_format($debito_ext, 2, '.', '') - number_format($credito_ext, 2, '.', '');
    // ---------------------------------------------------------------
    // Control asientos dfescuadrados
    // ---------------------------------------------------------------

    if ($tot_loc == 0) {
        if (count($aDataDiar) > 0) {
            //      TRANSACCIONALIDAD IFX
            try {
                // commit
                $oIfx->QueryT('BEGIN WORK;');

                //MAYORIZACION
                $class = new mayorizacion_class();
                unset($array);
                $array = $class->secu_asto($oIfx, $idempresa, $idsucursal, 5, $fecha_mov, $user_ifx, $tidu_cod);
                foreach ($array as $val) {
                    $secu_asto = $val[0];
                    $secu_dia = $val[1];
                    $tidu = $val[2];
                    $idejer = $val[3];
                    $idprdo = $val[4];
                    $moneda = $val[5];
                    $tcambio = $val[6];
                    $empleado = $val[7];
                    $usua_nom = $val[8];
                } // fin foreach

                $moneda = $aForm['moneda'];

                //---------------------------------------------------------------
                //		ACTUALIZACION DE ADJUNTOS (INGRESO DEL ASTO)			//
                //						SUEJO4967				   				//
                //---------------------------------------------------------------

                $sql = "UPDATE comercial.adjuntos set asto = '$secu_asto',
                id_ejer='$idejer',
                id_prdo='$idprdo',
                estado='A'	where
                estado = 'PE' and
                id_clpv = $clpv_cod ";

                $oIfx->QueryT($sql);

                $sql_delete = "DELETE from comercial.adjuntos where estado='PE'";
                $oIfx->QueryT($sql_delete);

                //---------------------------------------------------------------
                // 					FIN DE ACTUALIZACION DE ADJUNTOS		   //
                //---------------------------------------------------------------

                // SAEASTO
                $class->saeasto(
                    $oIfx,
                    $secu_asto,
                    $idempresa,
                    $idsucursal,
                    $idejer,
                    $idprdo,
                    $moneda,
                    $user_ifx,
                    '',
                    $clpv_nom,
                    0,
                    $fecha_mov,
                    $deta_asto,
                    $secu_dia,
                    $fecha_mov,
                    $tidu,
                    $usua_nom,
                    $user_web,
                    5
                );

                // SAEDIR
                $x = 1;
                $j = 1;
                $cod_dir = 0;
                if (count($aDataGrid) > 0) {
                    foreach ($aDataGrid as $aValues) {
                        $aux = 0;
                        $total = 0;
                        foreach ($aValues as $aVal) {
                            if ($aux == 0) {
                                // CONT
                                $cod_dir++;
                            } elseif ($aux == 1) {
                                // CLPV COD
                                $clpv_cod = $aVal;
                                $sql = "select  clpv_nom_clpv from saeclpv where clpv_cod_clpv = $clpv_cod and clpv_cod_empr = $idempresa ";
                                $clpv_nom = consulta_string_func($sql, 'clpv_nom_clpv', $oIfx, '');
                            } elseif ($aux == 2) {
                                // CCLI
                                $ccli_cod = $aVal;
                            } elseif ($aux == 3) {
                                // TIPO
                                $tipo = $aVal;
                            } elseif ($aux == 4) {
                                // FACTURA
                                $factura = $aVal;
                            } elseif ($aux == 5) {
                                // FECHA VENCE
                                $fec_vence = $aVal;
                                $fec_vence = str_replace('/', '', $fec_vence);
                            } elseif ($aux == 6) {
                                // DETALLE
                                $detalle = $aVal;
                            } elseif ($aux == 7) {
                                // COTIZACION
                                $cotiza = $aVal;
                            } elseif ($aux == 8) {
                                // DEBITO
                                $debito = $aVal;
                            } elseif ($aux == 9) {
                                // CREDITO
                                $credito = $aVal;
                            } elseif ($aux == 10) {
                                // DEBITO EXT
                                $debito_ext = $aVal;
                            } elseif ($aux == 11) {
                                // CREDITO EXT
                                $credito_ext = $aVal;

                                $class->saedir(
                                    $oIfx,
                                    $idempresa,
                                    $idsucursal,
                                    $idprdo,
                                    $idejer,
                                    $secu_asto,
                                    $clpv_cod,
                                    4,
                                    $tipo,
                                    $factura,
                                    $fec_vence,
                                    $detalle,
                                    $debito,
                                    $credito,
                                    $debito_ext,
                                    $credito_ext,
                                    'DB',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    $user_web,
                                    $cod_dir,
                                    $cotiza,
                                    $clpv_nom,
                                    $ccli_cod,
                                    $cod_solicitud
                                );
                            }
                            $aux++;
                        }
                        $x++;
                        $j++;
                    } // fin foreach

                }

                // RET
                if (count($aDataGridRet) > 0) {
                    $x = 1;
                    $j = 1;
                    foreach ($aDataGridRet as $aValues) {
                        $aux = 0;
                        $total = 0;
                        foreach ($aValues as $aVal) {
                            if ($aux == 0) {
                                $ret_secu = $aVal + 1;
                            } elseif ($aux == 1) {
                                $cta_ret = $aVal;
                            } elseif ($aux == 2) {
                                $clpv_cod = $aVal;
                                $sql = "select  clpv_nom_clpv, clpv_ruc_clpv from saeclpv where clpv_cod_clpv = $clpv_cod and clpv_cod_empr = $idempresa ";
                                if ($oIfx->Query($sql)) {
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
                            } elseif ($aux == 3) {
                                $factura = $aVal;
                            } elseif ($aux == 4) {
                                $ret_clpv = $aVal;
                            } elseif ($aux == 5) {
                                $ret_porc = $aVal;
                            } elseif ($aux == 6) {
                                $ret_base = $aVal;
                            } elseif ($aux == 7) {
                                $ret_val = $aVal;
                            } elseif ($aux == 8) {
                                $ret_num = $aVal;
                            } elseif ($aux == 9) {
                                $ret_det = $aVal;
                            } elseif ($aux == 10) {
                                $cotiza = $aVal;
                            } elseif ($aux == 11) {
                                $debito = $aVal;
                            } elseif ($aux == 12) {
                                $credito_ext = $aVal;
                            } elseif ($aux == 13) {
                                $debito_ext = $aVal;
                            } elseif ($aux == 14) {
                                $credito = $aVal;
                                $class->saeret(
                                    $oIfx,
                                    $idempresa,
                                    $idsucursal,
                                    $idprdo,
                                    $idejer,
                                    $secu_asto,
                                    $clpv_cod,
                                    $clpv_nom,
                                    $clpv_dir,
                                    '',
                                    $clpv_ruc,
                                    $ret_secu,
                                    $cta_ret,
                                    $ret_porc,
                                    $ret_base,
                                    $ret_val,
                                    $ret_num,
                                    $ret_det,
                                    $debito,
                                    $credito,
                                    $debito_ext,
                                    $credito_ext,
                                    $factura,
                                    '',
                                    '',
                                    '',
                                    $clpv_correo,
                                    'N',
                                    $cotiza
                                );
                            }
                            $aux++;
                        }
                        $x++;
                        $j++;
                    } // fin foreach
                }

                //$oReturn->alert(count($aDataDiar));
                // DIARIO
                if (count($aDataDiar) > 0) {
                    $x = 1;
                    $j = 1;
                    $total = 0;
                    $dasi_cod = 0;
                    foreach ($aDataDiar as $aValues) {
                        $aux = 0;
                        foreach ($aValues as $aVal) {
                            if ($aux == 0) {
                                $dasi_cod++;
                            } elseif ($aux == 1) {
                                $cta_cod = $aVal;
                            } elseif ($aux == 2) {
                                $cta_nom = $aVal;
                            } elseif ($aux == 3) {
                                $documento = $aVal;
                            } elseif ($aux == 4) {
                                $cotiza = $aVal;
                            } elseif ($aux == 5) {
                                $debito = $aVal;
                            } elseif ($aux == 6) {
                                $credito = $aVal;
                                $total += $debito;
                            } elseif ($aux == 7) {
                                $debito_ext = $aVal;
                            } elseif ($aux == 8) {
                                $credito_ext = $aVal;
                            } elseif ($aux == 11) {
                                // BENEFICIARIO
                                $ben_cheq = $aVal;
                            } elseif ($aux == 12) {
                                // CTA BANCARIA
                                $cta_cheq = $aVal;
                            } elseif ($aux == 13) {
                                // CHEQUE
                                $num_cheq = $aVal;
                            } elseif ($aux == 14) {
                                // FECHA VENC
                                $fec_cheq = fecha_informix_func($aVal);
                            } elseif ($aux == 15) {
                                // FORMATO CHEQUE
                                $form_cheq = $aVal;
                            } elseif ($aux == 16) {
                                // CTA COD
                                $cod_cheq = $aVal;
                            } elseif ($aux == 17) {
                                $detalle_dasi = $aVal;
                            } elseif ($aux == 18) {
                                $ccosn_cod = $aVal;
                            } elseif ($aux == 19) {
                                $act_cod = $aVal;

                                $opBand = 'S';
                                $opBacn = 'N';
                                $opFlch = '';
                                if (!empty($cta_cheq)) {
                                    $opBacn = 'S';
                                    $opFlch = 1;
                                }

                                if (empty($num_cheq)) {
                                    $num_cheq = $documento;
                                }

                                //$oReturn->alert('debito '.$detalle_dasi);
                                //$oReturn->alert('credi '.$credito);

                                // DASI
                                $class->saedasi(
                                    $oIfx,
                                    $idempresa,
                                    $idsucursal,
                                    $cta_cod,
                                    $idprdo,
                                    $idejer,
                                    $ccosn_cod,
                                    $debito,
                                    $credito,
                                    $debito_ext,
                                    $credito_ext,
                                    $cotiza,
                                    $detalle_dasi,
                                    $clpv_cod,
                                    '',
                                    $user_web,
                                    $secu_asto,
                                    $dasi_cod_ret,
                                    $dasi_dir,
                                    $dasi_cta_ret,
                                    $opBand,
                                    $opBacn,
                                    $opFlch,
                                    $num_cheq,
                                    $act_cod
                                );

                                if ($cod_cheq > 0) {
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
                            $aux++;
                        }
                        $x++;
                        $j++;
                    } // fin foreach
                } // fin

                // ACTUALIZACION SAEASTO
                $sql = "update saeasto set asto_est_asto = 'MY', 
									asto_vat_asto = $total  where
									asto_cod_empr = $idempresa  and
									asto_cod_sucu = $idsucursal and
									asto_cod_asto = '$secu_asto' and
									asto_cod_ejer = $idejer and
									asto_num_prdo = $idprdo and
									asto_cod_empr = $idempresa and     
									asto_cod_sucu = $idsucursal and
									asto_user_web = $user_web ";
                $oIfx->QueryT($sql);


                /*  // Comentado Adrian
            if (!empty($_SESSION['RRHH_EMPL_CAB_PRES'])) {
                $sql = $_SESSION['RRHH_EMPL_CAB_PRES'] . "," . "'" . $secu_asto . "')";
                $oIfx->QueryT($sql);
                $array        = $_SESSION['ARRAY_TABLA_AMORTIZACION'];
                $serial = $_SESSION['RRHH_EMPL_CAB_PRES_SERIAL'];
                foreach ($array as $val) {
                    $i                     = $val[0];
                    $cuota                 = $val[1];
                    $interesCalculado    = $val[2];
                    $amortizacion        = $val[3];
                    $monto                = $val[4];
                    $nuevafecha            = fecha_informix_func($val[5]);

                    $sql = "insert into saecuot ( cuot_num_cuot,		cuot_cod_pret,		cuot_mot_capi,		
                                                        cuot_est_cuot,		cuot_mot_inte,		cuot_fec_venc) 
                                                values ( $i,					'$serial',		    $cuota,
                                                        '0',					$interesCalculado,	'$nuevafecha' ) ";
                    $oIfx->QueryT($sql);
                }
            }
            */  // FIN Comentado Adrian



                $oReturn->assign("asto_cod", "value", $secu_asto);
                $oReturn->assign("compr_cod", "value", $secu_asto);

                // ASIENTOS
                $oReturn->assign("asto_cod", "value", $secu_asto);
                $oReturn->assign("ejer_cod", "value", $idejer);
                $oReturn->assign("prdo_cod", "value", $idprdo);


                $codpago = $_SESSION['codSaepgs'];

                if (!empty($codpago)) {
                    $sql = "select pgs_tip_pago from saepgs where pgs_cod_pgs=$codpago";
                    $tpag = consulta_string($sql, 'pgs_tip_pago', $oIfx, 0);
                    //VALIDACION FACTURAS
                    if ($tpag == 4) {
                        $sql = "update saepgs set pgs_est_soli = 5, pgs_cruce_sn = 1 where pgs_cod_pgs = $codpago";
                        $oIfx->QueryT($sql);
                    }
                    // Caja Chica
                    if ($tpag == 6) {
                        $sql = "update saepgs set pgs_egreso_sn = 'S' where pgs_cod_pgs = $codpago";
                        $oIfx->QueryT($sql);
                    }
                    // Fondos
                    if ($tpag == 2) {
                        $sql = "update saepgs set pgs_egreso_sn = 'S', pgs_egr_cod_dmcc = '$factura' where pgs_cod_pgs = $codpago";
                        $oIfx->QueryT($sql);
                    }

                    // Fondos
                    if ($tpag == 7) {
                        $sql = "update saepgs set pgs_est_soli = 5, pgs_egreso_sn = 'S' where pgs_cod_pgs = $codpago";
                        $oIfx->QueryT($sql);
                    }

                    // Fondos
                    if ($tpag == 8) {
                        $sql = "update saepgs set pgs_est_soli = 5, pgs_egreso_sn = 'S' where pgs_cod_pgs = $codpago";
                        $oIfx->QueryT($sql);
                    }
                }





                $oIfx->QueryT('COMMIT WORK;');
                $oReturn->alert('Ingresado Correctamente...');

                $oReturn->script('jsRemoveWindowLoad();');
                unset($_SESSION['aDataGirdDir']);
                unset($_SESSION['aDataGirdDiar']);
                unset($_SESSION['aDataGirdRet']);
                unset($_SESSION['codSaepgs']);
            } catch (Exception $e) {
                // rollback
                $oIfx->QueryT('ROLLBACK WORK;');
                $oReturn->alert($e->getMessage());
                $oReturn->assign("ctrl", "value", 1);

                $oReturn->script('habilitar_boton();');
                $oReturn->script('jsRemoveWindowLoad();');
            }
        } else {
            $oReturn->alert('Por favor ingrese un Ingreso....');
            $oReturn->script('habilitar_boton();');
            $oReturn->script('jsRemoveWindowLoad();');
        }
    } else {
        $oReturn->alert('Diario descuadrado');
        $oReturn->script('habilitar_boton();');
        $oReturn->script('jsRemoveWindowLoad();');
    }

    return $oReturn;
}

function numero_ret($aForm = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();

    $rete = $aForm['ret_num'];
    $len = strlen(($rete));
    $ceros = cero_mas_func('0', (9 - $len));
    $rete = $ceros . $rete;

    $oReturn->assign("ret_num", "value", $rete);

    return $oReturn;
}

function total_diario($aForm = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    global $DSN_Ifx;
    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();


    $oReturn = new xajaxResponse();

    $aDataGrid = $_SESSION['aDataGirdDiar'];


    $idempresa = $aForm["empresa"];
    $idsucursal = $aForm["sucursal"];
    $mone_cod = $aForm["moneda"];
    $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

    if ($mone_cod == $mone_base) {
        $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
        $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

        $sql = "select tcam_val_tcam from saetcam where
				mone_cod_empr = $idempresa and
				tcam_cod_mone = $mone_extr and
				tcam_fec_tcam in (
									select max(tcam_fec_tcam)  from saetcam where
											mone_cod_empr = $idempresa and
											tcam_cod_mone = $mone_extr
								)  ";

        $coti = $aForm["cotizacion_ext"]; // consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);

    } else {
        $coti = $aForm["cotizacion"];
    }



    $cont = 0;
    $tot_cre = 0;
    $tot_deb = 0;
    foreach ($aDataGrid as $aValues) {
        $fila_ingresada = $aValues['Fila'];
        $aux = 0;
        foreach ($aValues as $aVal) {
            if ($aux == 5) {
                $tot_deb += $aVal;
            } elseif ($aux == 6) {
                $tot_cre += $aVal;
            }
            $aux++;
        }
        $cont++;
    }

    $tipo = '';
    if ($tot_cre > $tot_deb) {
        $tipo = 'DB';
    } elseif ($tot_deb > $tot_cre) {
        $tipo = 'CR';
    }

    $totalCampo = abs(round($tot_cre - $tot_deb, 6));

    if ($mone_cod != $mone_base) {
        $totalCampo = $totalCampo / $coti;
    }

    $oReturn->assign("val_cta", "value", number_format(round($totalCampo, 2), 2, '.', ','));
    $oReturn->assign("valor", "value", number_format(round($tot_deb, 2), 2, '.', ','));
    $oReturn->assign("crdb", "value", $tipo);

    // ---------------------------------------------------------------------------------
    // Metodo pra configurar el tipo de cambio de la factura
    // ---------------------------------------------------------------------------------

    if ($mone_cod != $mone_base) {

        $tot_deb_ad = 0;
        $tot_cre_ad = 0;
        foreach ($aDataGrid as $aValues) {
            $fila_ingresada = $aValues['Fila'];
            $aux = 0;
            if ($fila_ingresada < 2) {
                foreach ($aValues as $aVal) {
                    if ($aux == 5) {
                        $tot_deb_ad += $aVal;
                    } elseif ($aux == 6) {
                        $tot_cre_ad += $aVal;
                    }
                    $aux++;
                }
            }
        }

        $totalCampo = abs(round($tot_cre - $tot_deb, 2));
        $totalCampoAd = abs(round($tot_cre_ad - $tot_deb_ad, 2));
        $cotizacion_fact_ori = $aForm["cotizacion_fact_ori"];
        if ($mone_cod != $mone_base) {
            $totalCampo = $totalCampo / $cotizacion_fact_ori;
            $oReturn->assign("val_cta", "value", number_format(round($totalCampo, 2), 2, '.', ','));

            $cuenta_utilidad = $_SESSION['CuentaUtilidad'];
            if ($cuenta_utilidad == 'S') {
                $tot_cre_ = abs($tot_cre_ad);
                $tot_deb_ = abs($tot_deb_ad);

                if ($tot_cre_ > 0 && $tot_deb_ > 0) {
                    // var_dump('dentro de');
                    if ($totalCampoAd > 0) {
                        $totalCampoSinAbs = $tot_cre_ad - $tot_deb_ad;

                        // -----------------------------------------------------------------------------------
                        // Verificamos si existe utilidado perdida en el tipo de cambio
                        // -----------------------------------------------------------------------------------

                        if ($totalCampoSinAbs < 0) {
                            // UTILIDAD
                            //INGRESA DEBITO
                            $sql_cuen_utilidad = "SELECT pcon_cta_utic from saepcon where pcon_cod_empr = $idempresa ";
                            $cuen_utilidad = consulta_string_func($sql_cuen_utilidad, 'pcon_cta_utic', $oIfx, '');

                            // INGRESO DEBITO
                            $sql_cuen_deb = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_utilidad';";
                            $cuen_nom_cuen_deb = consulta_string_func($sql_cuen_deb, 'cuen_nom_cuen', $oIfx, 0);
                            /*
                        $oReturn->assign("cod_cta", "value", $cuen_utilidad);
                        $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_deb);
                        $oReturn->assign("detalla_diario", "value", 'CUENTA UTILIDAD');
                        // CR => Credito || DB => Debito
                        $oReturn->assign("crdb", "value", 'DB');
                        //$oReturn->assign("val_cta", "value", $diferencia_utilidad_mext);
                        $oReturn->script("anadir_dasi();");
                        */


                            // --------------------------------------------------------------------
                            // INGRESO DEL DIARIO
                            // --------------------------------------------------------------------

                            $aDataDiar = $_SESSION['aDataGirdDiar'];

                            $aLabelDiar = array(
                                'Fila',
                                'Cuenta',
                                'Nombre',
                                'Documento',
                                'Cotizacion',
                                'Debito Moneda Local',
                                'Credito Moneda Local',
                                'Debito Moneda Ext',
                                'Credito Moneda Ext',
                                'Modificar',
                                'Eliminar',
                                'Beneficiario',
                                'Cuenta Bancaria',
                                'Cheque',
                                'Fecha Venc',
                                'Formato Cheque',
                                'Codigo Ctab',
                                'Detalle',
                                'Centro Costo',
                                'Centro Actividad'
                            );

                            // DIARIO
                            $contd = count($aDataDiar);
                            $coti = $aForm["cotizacion"];

                            $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
                            $aDataDiar[$contd][$aLabelDiar[1]] = $cuen_utilidad;
                            $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom_cuen_deb;
                            $aDataDiar[$contd][$aLabelDiar[3]] = '';
                            $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

                            // moneda extra
                            $totalValor = abs($totalCampoSinAbs);
                            $aDataDiar[$contd][$aLabelDiar[5]] = 0;
                            $aDataDiar[$contd][$aLabelDiar[6]] = $totalValor;
                            $aDataDiar[$contd][$aLabelDiar[7]] = 0;
                            $aDataDiar[$contd][$aLabelDiar[8]] = 0;

                            $vacio = '-1';
                            $aDataDiar[$contd][$aLabelDiar[9]] = '';
                            $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_dir(' . $vacio . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
                                                                alt="Eliminar"
                                                                align="bottom" />';
                            $aDataDiar[$contd][$aLabelDiar[11]] = '';
                            $aDataDiar[$contd][$aLabelDiar[12]] = '';
                            $aDataDiar[$contd][$aLabelDiar[13]] = '';
                            $aDataDiar[$contd][$aLabelDiar[14]] = '';
                            $aDataDiar[$contd][$aLabelDiar[15]] = '';
                            $aDataDiar[$contd][$aLabelDiar[16]] = '';
                            $aDataDiar[$contd][$aLabelDiar[17]] = 'CUENTA UTILIDAD';
                            $aDataDiar[$contd][$aLabelDiar[18]] = '';
                            $aDataDiar[$contd][$aLabelDiar[19]] = '';

                            // DIARIO
                            $sHtml = '';
                            $_SESSION['aDataGirdDiar'] = $aDataDiar;
                            $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
                            $oReturn->assign("divDiario", "innerHTML", $sHtml);

                            // --------------------------------------------------------------------
                            // FIN INGRESO DEL DIARIO
                            // --------------------------------------------------------------------


                            //
                        } else if ($totalCampoSinAbs > 0) {
                            // PERDIDA
                            //INGRESA CREDITO
                            $sql_cuen_perdida = "SELECT pcon_cta_pedc from saepcon where pcon_cod_empr = $idempresa ";
                            $cuen_perdida = consulta_string_func($sql_cuen_perdida, 'pcon_cta_pedc', $oIfx, '');
                            //$diferencia_utilidad_mext = round($diferencia_utilidad / $coti, 2);


                            // INGRESO CREDITO
                            $sql_cuen_cre = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_perdida';";
                            $cuen_nom_cuen_cre = consulta_string_func($sql_cuen_cre, 'cuen_nom_cuen', $oIfx, 0);
                            /*
                        $oReturn->assign("cod_cta", "value", $cuen_perdida);
                        $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_cre);
                        $oReturn->assign("detalla_diario", "value", 'CUENTA PERDIDA');
                        // CR => Credito || DB => Debito
                        $oReturn->assign("crdb", "value", 'CR');
                        //$oReturn->assign("val_cta", "value", $diferencia_utilidad_mext);
                        $oReturn->script("anadir_dasi();");
                        */

                            // --------------------------------------------------------------------
                            // INGRESO DEL DIARIO
                            // --------------------------------------------------------------------

                            $aDataDiar = $_SESSION['aDataGirdDiar'];

                            $aLabelDiar = array(
                                'Fila',
                                'Cuenta',
                                'Nombre',
                                'Documento',
                                'Cotizacion',
                                'Debito Moneda Local',
                                'Credito Moneda Local',
                                'Debito Moneda Ext',
                                'Credito Moneda Ext',
                                'Modificar',
                                'Eliminar',
                                'Beneficiario',
                                'Cuenta Bancaria',
                                'Cheque',
                                'Fecha Venc',
                                'Formato Cheque',
                                'Codigo Ctab',
                                'Detalle',
                                'Centro Costo',
                                'Centro Actividad'
                            );

                            // DIARIO
                            $contd = count($aDataDiar);
                            $coti = $aForm["cotizacion"];

                            $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
                            $aDataDiar[$contd][$aLabelDiar[1]] = $cuen_perdida;
                            $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom_cuen_cre;
                            $aDataDiar[$contd][$aLabelDiar[3]] = '';
                            $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

                            // moneda extra
                            $totalValor = abs($totalCampoSinAbs);
                            $aDataDiar[$contd][$aLabelDiar[5]] = $totalValor;
                            $aDataDiar[$contd][$aLabelDiar[6]] = 0;
                            $aDataDiar[$contd][$aLabelDiar[7]] = 0;
                            $aDataDiar[$contd][$aLabelDiar[8]] = 0;

                            $vacio = '-1';
                            $aDataDiar[$contd][$aLabelDiar[9]] = '';
                            $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
                                                                title = "Presione aqui para Eliminar"
                                                                style="cursor: hand !important; cursor: pointer !important;"
                                                                onclick="javascript:xajax_elimina_detalle_dir(' . $vacio . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
                                                                alt="Eliminar"
                                                                align="bottom" />';
                            $aDataDiar[$contd][$aLabelDiar[11]] = '';
                            $aDataDiar[$contd][$aLabelDiar[12]] = '';
                            $aDataDiar[$contd][$aLabelDiar[13]] = '';
                            $aDataDiar[$contd][$aLabelDiar[14]] = '';
                            $aDataDiar[$contd][$aLabelDiar[15]] = '';
                            $aDataDiar[$contd][$aLabelDiar[16]] = '';
                            $aDataDiar[$contd][$aLabelDiar[17]] = 'CUENTA PERDIDA';
                            $aDataDiar[$contd][$aLabelDiar[18]] = '';
                            $aDataDiar[$contd][$aLabelDiar[19]] = '';

                            // DIARIO
                            $sHtml = '';
                            $_SESSION['aDataGirdDiar'] = $aDataDiar;
                            $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
                            $oReturn->assign("divDiario", "innerHTML", $sHtml);

                            // --------------------------------------------------------------------
                            // FIN INGRESO DEL DIARIO
                            // --------------------------------------------------------------------


                        }

                        // -----------------------------------------------------------------------------------
                        // FIN Verificamos si existe utilidado perdida en el tipo de cambio
                        // -----------------------------------------------------------------------------------
                        $_SESSION['CuentaUtilidad'] = 'N';
                    }
                }
            }
        }
    }
    // ---------------------------------------------------------------------------------
    // FIN Metodo pra configurar el tipo de cambio de la factura
    // ---------------------------------------------------------------------------------


    return $oReturn;
}

// CHEQUE
function reporte_cheque($sAccion = 'nuevo', $aForm = '', $idempresa, $idsucursal, $clpv_nom, $val_cheq, $fecha, $cliente = '')
{
    //  Definiciones
    global $DSN_Ifx, $DSN;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;

    $fu = new Formulario;
    $fu->DSN = $DSN;

    $oReturn = new xajaxResponse();

    if (!$cliente) {
        $cliente = 0;
    }

    $sql = "select clpv_cod_cact from saeclpv where clpv_cod_clpv=$cliente and clpv_cod_empr='$idempresa'";
    $clpv_cod_cact = consulta_string($sql, 'clpv_cod_cact', $oIfx, '');

    $cta = $aForm['cta_cheq'];

    $aDataGrid = $_SESSION['aDataGirdDir'];
    if (count($aDataGrid) > 0) {
        foreach ($aDataGrid as $aValues) {
            $aux = 0;
            foreach ($aValues as $aVal) {
                if ($aux == 1) {
                    // CLPV COD
                    $clpv_cod = $aVal;
                    $sql = "select  clpv_cod_cact, clpv_nom_clpv from saeclpv where clpv_cod_clpv = $clpv_cod and clpv_cod_empr = $idempresa ";
                    $act_cod = consulta_string_func($sql, 'clpv_cod_cact', $oIfx, '');
                }
                $aux++;
            }
        } // fin foreach

    }

    switch ($sAccion) {
        case 'nuevo':
            // CHEQUE
            $fu->AgregarCampoLista('cta_cheq', 'Cuenta|left', true, 'auto');
            $fu->AgregarComandoAlCambiarValor('cta_cheq', 'cargar_cuenta();');
            $sql = "select mone_des_mone, ctab_cod_ctab, ctab_cod_cuen, banc_nom_banc, ctab_num_ctab, cuen_nom_cuen
									from saectab , saebanc,  saecuen, saemone where

								cuen_cod_empr = banc_cod_empr and 
								ctab_cod_cuen= cuen_cod_cuen and 
								mone_cod_empr=cuen_cod_empr and
								cuen_cod_mone=mone_cod_mone and
								banc_cod_banc = ctab_cod_banc and
                                    banc_cod_empr = $idempresa and
                               --    banc_cod_sucu = $idsucursal and
                                    ctab_cod_empr = $idempresa and
                                --    ctab_cod_sucu = $idsucursal and
                                    ctab_tip_ctab = 'C' ";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $nom = $oIfx->f('ctab_cod_cuen') . ' - ' . $oIfx->f('cuen_nom_cuen') . '- ' . $oIfx->f('mone_des_mone');
                        $fu->AgregarOpcionCampoLista('cta_cheq', $nom, $oIfx->f('ctab_cod_ctab'));
                    } while ($oIfx->SiguienteRegistro());
                }
            }

            $fu->AgregarCampoTexto('cheque', 'N.- Cheque o Transferencia|left', true, '', 200, 10);
            $fu->AgregarComandoAlCambiarValor('cheque', 'controlCheque();');

            $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, $clpv_nom, 230, 150);
            $fu->AgregarCampoTexto('ctab_cheq', 'Cuenta Bancaria|left', false, '', 150, 150);
            $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, $fecha);
            $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, 'auto');
            $fu->AgregarCampoTexto('val_cheq', 'Valor|left', true, $val_cheq, 100, 150);

            // CENTRO DE ACTIVIDAD
            $ifu->AgregarCampoListaSQL('actividad_cheq', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 300, 150);
            $ifu->cCampos["actividad_cheq"]->xValor = $clpv_cod_cact;

            break;
        case 'cuenta':
            // CHEQUE
            $fu->AgregarCampoLista('cta_cheq', 'Cuenta|left', true, 'auto');
            $fu->AgregarComandoAlCambiarValor('cta_cheq', 'cargar_cuenta();');

            $sql = "select mone_des_mone, ctab_cod_ctab, ctab_cod_cuen, banc_nom_banc, ctab_num_ctab
									from saectab , saebanc,  saecuen, saemone where

								cuen_cod_empr = banc_cod_empr and 
								ctab_cod_cuen= cuen_cod_cuen and 
								mone_cod_empr=cuen_cod_empr and
								cuen_cod_mone=mone_cod_mone and
								banc_cod_banc = ctab_cod_banc and
                                    banc_cod_empr = $idempresa and
                               --    banc_cod_sucu = $idsucursal and
                                    ctab_cod_empr = $idempresa and
                                --    ctab_cod_sucu = $idsucursal and
                                    ctab_tip_ctab = 'C' ";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $nom = $oIfx->f('ctab_cod_cuen') . ' - ' . $oIfx->f('banc_nom_banc') . ' - ' . $oIfx->f('ctab_num_ctab') . ' - ' . $oIfx->f('mone_des_mone');
                        $fu->AgregarOpcionCampoLista('cta_cheq', $nom, $oIfx->f('ctab_cod_ctab'));
                    } while ($oIfx->SiguienteRegistro());
                }
            }


            // DATSO
            $sql = "select ctab_num_ctab, ctab_num_cheq, ctab_for_cheq from saectab where 
                                        ctab_cod_ctab = $cta and 
                                        ctab_cod_empr = $idempresa and
                                        ctab_cod_sucu = $idsucursal";
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $ctab_num = $oIfx->f('ctab_num_ctab');
                        $cheq_num = $oIfx->f('ctab_num_cheq') * 1;
                        $cheq_ftrn = $oIfx->f('ctab_for_cheq');
                    } while ($oIfx->SiguienteRegistro());
                }
            }

            $cheq_num = secuencial(2, '', $cheq_num, 10);

            $fu->AgregarCampoTexto('cheque', 'N.- Cheque o Transferencia|left', true, $cheq_num, 200, 15);
            $fu->AgregarComandoAlCambiarValor('cheque', 'controlCheque();');

            $fu->AgregarCampoTexto('ben_cheq', 'Beneficiario|left', false, $clpv_nom, 230, 150);
            $fu->AgregarCampoTexto('ctab_cheq', 'Cuenta Bancaria|left', false, $ctab_num, 150, 150);
            $fu->AgregarCampoFecha('fec_cheq', 'Fecha Vencimiento|left', true, $fecha);
            $ifu->AgregarCampoListaSQL('form_cheq', 'Formato Cheque|left', "select ftrn_cod_ftrn, ftrn_des_ftrn 
                                                                                        from saeftrn where
                                                                                        ftrn_cod_empr = $idempresa and
                                                                                        ftrn_cod_modu = 5 and
                                                                                        ftrn_tip_movi = 'EG' ", true, 'auto');
            $fu->AgregarCampoTexto('val_cheq', 'Valor|left', true, $val_cheq, 100, 150);

            $fu->cCampos["cta_cheq"]->xValor = $cta;
            $ifu->cCampos["form_cheq"]->xValor = $cheq_ftrn;

            // CENTRO DE ACTIVIDAD
            $ifu->AgregarCampoListaSQL('actividad_cheq', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact from saecact where
																								cact_cod_empr = $idempresa order by 2 ", false, 300, 150);
            $ifu->cCampos["actividad_cheq"]->xValor = $clpv_cod_cact;


            break;
    }

    $sHtml .= '<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:98%;">';
    $sHtml .= '<table align="center" cellpadding="0" cellspacing="2" width="100%" border="0">';
    $sHtml .= '<tr>
                   <td colspan="4" class="tituloCab" height="20px" align="center">CHEQUE</td>
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">' . $fu->ObjetoHtmlLBL('cta_cheq') . '</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>' . $fu->ObjetoHtml('cta_cheq') . '</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">' . $fu->ObjetoHtmlLBL('ben_cheq') . '</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>' . $fu->ObjetoHtml('ben_cheq') . '</td>
                                    <td class="labelFrm">' . $ifu->ObjetoHtmlLBL('form_cheq') . '</td>
                                    <td>' . $ifu->ObjetoHtml('form_cheq') . '</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">' . $fu->ObjetoHtmlLBL('cheque') . '</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>' . $fu->ObjetoHtml('cheque') . '</td>
                                    <td class="labelFrm">' . $fu->ObjetoHtmlLBL('ctab_cheq') . '</td>
                                    <td>' . $fu->ObjetoHtml('ctab_cheq') . '</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">' . $fu->ObjetoHtmlLBL('fec_cheq') . '</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>' . $fu->ObjetoHtml('fec_cheq') . '</td>
                                    <td class="labelFrm">' . $fu->ObjetoHtmlLBL('val_cheq') . '</td>
                                    <td>' . $fu->ObjetoHtml('val_cheq') . '</td>
                                </tr>
                            </table>
                        </td>                            
               </tr>';
    $sHtml .= '<tr>
                        <td class="labelFrm">' . $ifu->ObjetoHtmlLBL('actividad_cheq') . '</td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>' . $ifu->ObjetoHtml('actividad_cheq') . '</td>
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
    $sHtml .= '</table></fieldset>';


    $oReturn->assign("divFormularioDetalle", "innerHTML", $sHtml);
    $oReturn->assign("actividad_cheq", "value", $clpv_cod_cact);

    return $oReturn;
}

// DIARIO  CHEQUE
function agrega_modifica_grid_dia_cheque($nTipo = 0, $aForm = '', $idempresa = '', $idsucursal, $detalle, $mone_cod, $coti, $coti_ext)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $aDataDiar = $_SESSION['aDataGirdDiar'];

    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad'
    );

    $oReturn = new xajaxResponse();

    // VARIABLES
    $cta_cheq = $aForm["cta_cheq"];
    $sql = "select ctab_num_ctab, ctab_num_cheq, ctab_cod_cuen from saectab where 
                    ctab_cod_ctab = $cta_cheq and 
                    ctab_cod_empr = $idempresa and
                    ctab_cod_sucu = $idsucursal ";
    $cod_cta = consulta_string_func($sql, 'ctab_cod_cuen', $oIfx, '');

    $sql = "select  cuen_nom_cuen  from saecuen where
                cuen_cod_empr  = $idempresa and
                cuen_cod_cuen  = '$cod_cta' ";
    $nom_cta = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
    $val_cta = str_replace(",", "", $aForm['val_cheq']);
    $ben_cheq = $aForm["ben_cheq"];
    $form_cheq = $aForm["form_cheq"];
    $cheque = $aForm["cheque"];
    $cta_banc = $aForm["ctab_cheq"];
    $fec_cheq = $aForm["fec_cheq"];
    $act_cod = $aForm["actividad_cheq"];

    $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

    if ($mone_cod == $mone_base) {
        $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
        $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

        $sql = "select tcam_val_tcam from saetcam where
                mone_cod_empr = $idempresa and
                tcam_cod_mone = $mone_extr and
                tcam_fec_tcam in (
                                    select max(tcam_fec_tcam)  from saetcam where
                                            mone_cod_empr = $idempresa and
                                            tcam_cod_mone = $mone_extr
                                )  ";

        $coti = $coti_ext; //consulta_string($sql, 'tcam_val_tcam', $oIfx, 0);
    }

    if ($nTipo == 0) {
        // DIARIO
        $cred = $val_cta;
        $deb = 0;

        $contd = count($aDataDiar);
        $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
        $aDataDiar[$contd][$aLabelDiar[1]] = $cod_cta;
        $aDataDiar[$contd][$aLabelDiar[2]] = $nom_cta;
        $aDataDiar[$contd][$aLabelDiar[3]] = '';
        $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

        if ($mone_cod == $mone_base) {
            // moneda local
            $cre_tmp = 0;
            $deb_tmp = 0;
            if ($coti > 0) {
                $cre_tmp = round(($cred / $coti), 2);
            }

            if ($coti > 0) {
                $deb_tmp = round(($deb / $coti), 2);
            }

            $aDataDiar[$contd][$aLabelDiar[5]] = $deb;
            $aDataDiar[$contd][$aLabelDiar[6]] = $cred;
            $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
            $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
        } else {
            // moneda extra
            $aDataDiar[$contd][$aLabelDiar[5]] = $deb * $coti;
            $aDataDiar[$contd][$aLabelDiar[6]] = $cred * $coti;
            $aDataDiar[$contd][$aLabelDiar[7]] = $deb;
            $aDataDiar[$contd][$aLabelDiar[8]] = $cred;
        }

        $vacio = '-1';

        $aDataDiar[$contd][$aLabelDiar[9]] = '';
        $aDataDiar[$contd][$aLabelDiar[10]] = '<img src="' . $_COOKIE['JIREH_IMAGENES'] . 'iconos/delete_1.png"
															title = "Presione aqui para Eliminar"
															style="cursor: hand !important; cursor: pointer !important;"
															onclick="javascript:xajax_elimina_detalle_dir(' . $vacio . ', ' . $idempresa . ', ' . $idsucursal . ', ' . $contd . ', -1 );"
															alt="Eliminar"
															align="bottom" />';
        $aDataDiar[$contd][$aLabelDiar[11]] = $ben_cheq;
        $aDataDiar[$contd][$aLabelDiar[12]] = $cta_banc;
        $aDataDiar[$contd][$aLabelDiar[13]] = $cheque;
        $aDataDiar[$contd][$aLabelDiar[14]] = $fec_cheq;
        $aDataDiar[$contd][$aLabelDiar[15]] = $form_cheq;
        $aDataDiar[$contd][$aLabelDiar[16]] = $cta_cheq;
        $aDataDiar[$contd][$aLabelDiar[17]] = $detalle;
        $aDataDiar[$contd][$aLabelDiar[18]] = '';
        $aDataDiar[$contd][$aLabelDiar[19]] = $act_cod;


        // --------------------------------------------------------------------------
        // CUENTAS ADICIONALES PERU
        // --------------------------------------------------------------------------
        $empr_cod_pais = $_SESSION['U_PAIS_COD'];
        $sql_codInter_pais = "SELECT pais_codigo_inter from saepais where pais_cod_pais = $empr_cod_pais;";
        $codigo_pais = consulta_string_func($sql_codInter_pais, 'pais_codigo_inter', $oIfx, 0);

        $sql_pcon = "SELECT pcon_cue_niif from saepcon WHERE pcon_cod_empr = $idempresa;";
        $pcon_cue_niif = consulta_string_func($sql_pcon, 'pcon_cue_niif', $oIfx, 0);

        if ($codigo_pais == 51 && $pcon_cue_niif == 'S') {
            // Cuando es Peru baja dos cuentas adicionales: cuan_ana_deb y cuen_anal_cre
            $sql_cuen = "SELECT cuen_ana_deb, cuen_ana_cre from saecuen where cuen_cod_cuen = '$cod_cta';";
            $cuen_ana_deb = consulta_string_func($sql_cuen, 'cuen_ana_deb', $oIfx, 0);
            $cuen_ana_cre = consulta_string_func($sql_cuen, 'cuen_ana_cre', $oIfx, 0);

            $existe_cuenta = 'N';
            foreach ($aDataDiar as $key => $value) {
                if ($value['Cuenta'] == $cuen_ana_deb || $value['Cuenta'] == $cuen_ana_cre) {
                    $existe_cuenta = 'S';
                }
            }
            if ($existe_cuenta == 'N') {
                // --------------------------------------
                // DEBITO
                // --------------------------------------

                $sql_cuen_deb = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_ana_deb';";
                $cuen_nom_cuen_deb = consulta_string_func($sql_cuen_deb, 'cuen_nom_cuen', $oIfx, 0);
                $oReturn->assign("cod_cta", "value", $cuen_ana_deb);
                $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_deb);
                $oReturn->assign("detalla_diario", "value", 'CUENTA ADICIONAL DEBITO');
                // CR => Credito || DB => Debito
                $oReturn->assign("crdb", "value", 'DB');
                $oReturn->assign("val_cta", "value", $val_cta);
                $oReturn->script("anadir_dasi();");

                // --------------------------------------
                // CREDITO
                // --------------------------------------


                $sql_cuen_cre = "SELECT cuen_nom_cuen from saecuen where cuen_cod_cuen = '$cuen_ana_cre';";
                $cuen_nom_cuen_cre = consulta_string_func($sql_cuen_cre, 'cuen_nom_cuen', $oIfx, 0);
                $oReturn->assign("cod_cta", "value", $cuen_ana_cre);
                $oReturn->assign("nom_cta", "value", $cuen_nom_cuen_cre);
                $oReturn->assign("detalla_diario", "value", 'CUENTA ADICIONAL CREDITO');
                // CR => Credito || DB => Debito
                $oReturn->assign("crdb", "value", 'CR');
                $oReturn->assign("val_cta", "value", $val_cta);
                $oReturn->script("anadir_dasi();");
            }
        }

        // --------------------------------------------------------------------------
        // FIN CUENTAS ADICIONALES PERU
        // --------------------------------------------------------------------------




    }

    // DIARIO
    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataDiar;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario", "innerHTML", $sHtml);

    $oReturn->assign("cod_cta", "value", '');
    $oReturn->assign("nom_cta", "value", '');
    $oReturn->assign("val_cta", "value", '');

    // TOTAL DIARIO
    $oReturn->script("total_diario();");
    $oReturn->script("cerrarModalch()");
    $oReturn->script("cerrar_ventana();");

    $_SESSION['CuentaUtilidad'] = 'S';


    return $oReturn;
}

function cargar_coti($aForm = '')
{
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    //variables del formulario
    $idempresa = $aForm['empresa'];
    $mone_cod = $aForm['moneda'];

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

function reporte_credito($aForm = '')
{
    //Definiciones
    global $DSN, $DSN_Ifx;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

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
        if ($oCon->Query($sql)) {
            if ($oCon->NumFilas() > 0) {
                do {
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

                    $sHtml .= '<tr>';
                    $sHtml .= '<td>' . $ruc . '</td>';
                    $sHtml .= '<td>' . $nombre . '</td>';
                    $sHtml .= '<td align="right">' . $total . '</td>';
                    $sHtml .= '<td align="center">
									<div class="btn btn-success btn-sm" onclick="seleccionaPrestamo(' . $id . ', ' . $id_clpv . ');">
										<span class="glyphicon glyphicon-ok-sign"></span>
									</div>
								</td>';
                    $sHtml .= '</tr>';
                } while ($oCon->SiguienteRegistro());
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

function checkPrestamo($id, $clpv)
{
    //Definiciones
    global $DSN, $DSN_Ifx;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

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

        $aLabelGrid = array('Fila', 'Cliente', 'Tipo', 'Factura', 'Fec. Vence', 'Detalle', 'Cotizacion', 'Debito', 'Credito', 'Modificar', 'Eliminar');

        $aLabelDiar = array(
            'Fila',
            'Cuenta',
            'Nombre',
            'Documento',
            'Cotizacion',
            'Debito',
            'Credito',
            'Modificar',
            'Eliminar',
            'Beneficiario',
            'Cuenta Bancaria',
            'Cheque',
            'Fecha Venc',
            'Formato Cheque',
            'Codigo Ctab',
            'Detalle'
        );

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
        if ($oCon->Query($sql)) {
            if ($oCon->NumFilas() > 0) {
                $i = 1;
                do {
                    $id = $oCon->f('id');
                    $fecha = $oCon->f('fecha');
                    $cuota = $oCon->f('cuota');
                    $interes = $oCon->f('nombre');
                    $amortizacion = $oCon->f('ruc');
                    $saldo = $oCon->f('ingresos');

                    $fact_num = '000' . $i;
                    $fec_venc = $fecha;

                    //directorio
                    $cont = count($aDataGrid);
                    $aDataGrid[$cont][$aLabelGrid[0]] = floatval($cont);
                    $aDataGrid[$cont][$aLabelGrid[1]] = $clpv;
                    $aDataGrid[$cont][$aLabelGrid[2]] = $tran_cod;
                    $aDataGrid[$cont][$aLabelGrid[3]] = $fact_num;
                    $aDataGrid[$cont][$aLabelGrid[4]] = $fec_venc;
                    $aDataGrid[$cont][$aLabelGrid[5]] = $det_dir;
                    $aDataGrid[$cont][$aLabelGrid[6]] = 1;
                    $aDataGrid[$cont][$aLabelGrid[7]] = $cuota;
                    $aDataGrid[$cont][$aLabelGrid[8]] = 0;
                    $aDataGrid[$cont][$aLabelGrid[9]] = '';
                    $aDataGrid[$cont][$aLabelGrid[10]] = '';


                    // diario
                    $contd = count($aDataDiar);
                    $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
                    $aDataDiar[$contd][$aLabelDiar[1]] = $clpv_cuen;
                    $aDataDiar[$contd][$aLabelDiar[2]] = $cuen_nom;
                    $aDataDiar[$contd][$aLabelDiar[3]] = $doc;
                    $aDataDiar[$contd][$aLabelDiar[4]] = 1;
                    $aDataDiar[$contd][$aLabelDiar[5]] = $cuota;
                    $aDataDiar[$contd][$aLabelDiar[6]] = 0;
                    $aDataDiar[$contd][$aLabelDiar[7]] = '';
                    $aDataDiar[$contd][$aLabelDiar[8]] = '';
                    $aDataDiar[$contd][$aLabelDiar[9]] = '';
                    $aDataDiar[$contd][$aLabelDiar[10]] = '';
                    $aDataDiar[$contd][$aLabelDiar[11]] = '';
                    $aDataDiar[$contd][$aLabelDiar[12]] = '';
                    $aDataDiar[$contd][$aLabelDiar[13]] = '';
                    $aDataDiar[$contd][$aLabelDiar[14]] = '';
                    $aDataDiar[$contd][$aLabelDiar[15]] = $det_dir;

                    $i++;
                } while ($oCon->SiguienteRegistro());

                // directorio
                $_SESSION['aDataGirdDir'] = $aDataGrid;
                $sHtml = mostrar_grid_dir($idempresa, $idsucursal);
                $oReturn->assign("divDir", "innerHTML", $sHtml);

                // diario
                $sHtml = '';
                $_SESSION['aDataGirdDiar'] = $aDataDiar;
                $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
                $oReturn->assign("divDiario", "innerHTML", $sHtml);

                $oReturn->assign("cliente_nombre", "value", $clpv_nom_clpv);

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

function parametrosPrestamo($aForm = '')
{
    //Definiciones
    global $DSN, $DSN_Ifx;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;

    $oReturn = new xajaxResponse();

    $empresa = $aForm['empresa'];

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
        if ($oCon->Query($sql)) {
            if ($oCon->NumFilas() > 0) {
                $i = 1;
                do {
                    $id = $oCon->f('id');
                    $nombre = $oCon->f('nombre');
                    $cuenta_contable = $oCon->f('cuenta_contable');

                    $ifu->AgregarCampoTexto('cuenta_' . $id, 'Cuenta|left', false, '', 150, 100);
                    $ifu->AgregarComandoAlEscribir('cuenta_' . $id, 'ventanaCuentasContables(event, ' . $id . ');');

                    $sHtml .= '<tr>';
                    $sHtml .= '<td>' . $i++ . '</td>';
                    $sHtml .= '<td>' . $nombre . '</td>';
                    $sHtml .= '<td>' . $ifu->ObjetoHtml('cuenta_' . $id) . '</td>';
                    $sHtml .= '</tr>';
                } while ($oCon->SiguienteRegistro());
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
function cargar_lista_tran($aForm = '', $op)
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    //variables del formulario
    $empresa = $aForm['empresa'];
    $sucursal = $aForm['sucursal'];
    $modulo = null;

    if ($op == 'CL') {
        $modulo = 3;
    } elseif ($op == 'PV') {
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
                $detalle = $oIfx->f('tran_cod_tran') . ' || ' . $oIfx->f('tran_des_tran') . ' || ' . $oIfx->f('trans_tip_tran');
                $oReturn->script(('anadir_elemento_tran(' . $i++ . ',\'' . $oIfx->f('tran_cod_tran') . '\',  \'' . $detalle . '\' )'));
            } while ($oIfx->SiguienteRegistro());
        }
    }
    $oIfx->Free();

    // TRANSACCION POR DEFECTO
    $sql = "select pccp_aut_pago from saepccp where pccp_cod_empr = $empresa ";
    $tran_cod_tran = consulta_string_func($sql, 'pccp_aut_pago', $oIfx, 0);
    $oReturn->assign('tran', 'value', $tran_cod_tran);

    return $oReturn;
}

// SUBCLIENTE
function cargar_lista_subcliente($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    //variables de session
    $idempresa = $_SESSION['U_EMPRESA'];

    //variables del formulario
    $empresa = $aForm['empresa'];
    $cliente = $aForm['clpv_cod'];

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
function controlPeriodoIfx($aForm = '')
{
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    //variables del formulario
    $empresa = $aForm['empresa'];

    try {

        //control periodo
        $mesForm = substr($aForm['fecha'], 5, 2);
        $anioForm = substr($aForm['fecha'], 0, 4);

        $controlEjercicio = controlEjercicio($empresa, $anioForm);

        if ($controlEjercicio > 0) {

            $controlPeriodo = controlPeriodo($empresa, $anioForm, $mesForm);

            if ($controlPeriodo == 'C') {
                $oReturn->assign('fecha', 'value', date('d-m-Y'));
                // Cambio realizado por adrian
                $oReturn->alert('Mes Cerrado Consulte con el Administrador y Seleccione nuevamente Fecha Registro Contable');
            }
        } else {
            $oReturn->alert('No existe Ejercicio, Consulte con el Administrador...');
            $oReturn->assign('fecha', 'value', '');
        }
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}

// VALOR RETENIDO
function calculaValorRetenido($aForm = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oReturn = new xajaxResponse();

    //variables del formulario
    $porc_ret = $aForm['ret_porc'];
    $base_ret = str_replace(",", "", $aForm['ret_base']);

    if ($porc_ret > 0 && $base_ret > 0) {
        $val_ret = round(($base_ret * $porc_ret / 100), 2);
    }

    $oReturn->assign("ret_val", "value", $val_ret);

    return $oReturn;
}


//Nomina
function nomina($aForm = '')
{
    //Definiciones
    global $DSN, $DSN_Ifx;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }


    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;

    $oReturn = new xajaxResponse();

    $empresa = $aForm['empresa'];
    $diaHoy = date("Y-m-d");

    try {

        $ifu->AgregarCampoListaSQL('anio', 'A&ntilde;o|left', "select    DATE_PART('year',  ejer_fec_inil) as anio,
                                                                            DATE_PART('year',  ejer_fec_inil) as anio  from saeejer where
                                                                            ejer_cod_empr = $empresa
                                                                            order by 1 desc ", false, 170, 100);

        $ifu->AgregarCampoListaSQL('mes', 'Mes|left', "select   prdo_num_prdo,  prdo_nom_prdo from saeprdo where
                                                                            prdo_cod_ejer = 1 ", false, 170, 100);

        $ifu->AgregarCampoListaSQL('tipo_doc_n', 'Documento|left', "select tidu_cod_tidu, 
																		tidu_des_tidu
																		from saetidu where
																		tidu_cod_empr = $empresa and
																		tidu_cod_modu = 5 and
																		tidu_tip_tidu = 'EG' ", false, 170, 150);

        $sql = "select tidu_cod_tidu, 
				tidu_des_tidu
				from saetidu where
				tidu_cod_empr = $empresa and
				tidu_cod_modu = 5 and
				tidu_tip_tidu = 'EG' and
				tidu_def_tidu = 'D' ";
        $tidu = consulta_string_func($sql, 'tidu_cod_tidu', $oIfx, '');
        $ifu->cCampos["tipo_doc_n"]->xValor = $tidu;

        $ifu->AgregarCampoListaSQL('actividad_n', 'Centro Actividad|left', "select cact_cod_cact , cact_nom_cact ||  ' - ' || cact_cod_cact 
																			from saecact 
																			where cact_cod_empr = $empresa and
																			cact_tip_movi = 'E'
																			order by 2 ", false, 170, 150);

        $ifu->AgregarCampoLista('fp_n', 'Forma Pago|left', false, 170, 100);
        $ifu->AgregarOpcionCampoLista('fp_n', 'CHEQUE', 'C');
        $ifu->AgregarOpcionCampoLista('fp_n', 'EFECTIVO', 'E');
        $ifu->AgregarOpcionCampoLista('fp_n', 'TRANSFERENCIA', 'T');

        $ifu->cCampos["fp_n"]->xValor = 'C';

        $ifu->AgregarCampoListaSQL('depar', 'Departamento|left', "select  estr_cod_estr, estr_des_estr
																					from saeestr where
																					estr_cod_empr  = $empresa  and
																					estr_cod_test  = 'D'
																					order by 1 ", false, 170, 100);
        $ifu->AgregarCampoLista('tipo', 'Tipo |left', false, 170, 100);
        $ifu->AgregarOpcionCampoLista('tipo', 'Sueldo ', 1);
        $ifu->AgregarOpcionCampoLista('tipo', 'Anticipo', 2);
        $ifu->AgregarOpcionCampoLista('tipo', 'Provision', 3);

        $ifu->AgregarCampoLista('banco', 'Banco|LEFT', false, 170, 100);
        $sql = "select banc_cod_banc, banc_nom_banc, ctab_num_ctab, ctab_cod_cuen
				from saebanc, saectab
				where  banc_cod_empr = ctab_cod_empr and
				banc_cod_banc = ctab_cod_banc and
				banc_cod_empr = $empresa";
        if ($oIfx->Query($sql)) {
            if ($oIfx->NumFilas() > 0) {
                do {
                    $banc_cod_banc = $oIfx->f('banc_cod_banc');
                    $banc_nom_banc = $oIfx->f('banc_nom_banc');
                    $ctab_num_ctab = $oIfx->f('ctab_num_ctab');
                    $ctab_cod_cuen = $oIfx->f('ctab_cod_cuen');
                    $ifu->AgregarOpcionCampoLista('banco', 'BA: ' . $banc_nom_banc . ' - #: ' . $ctab_num_ctab . ' - CC: ' . $ctab_cod_cuen, $banc_cod_banc);
                } while ($oIfx->SiguienteRegistro());
            }
        }
        $oIfx->Free();

        $ifu->cCampos["anio"]->xValor = date("Y");
        $ifu->cCampos["mes"]->xValor = date("m");

        $sHtml .= '<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content" id="miModal">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">NOMINA EMPLEADOS</h4>
							<table class="table table-striped table-condensed" style="width: 100%; margin-bottom: 0px;" align="center">
								<tr>
								   
									<td>' . $ifu->ObjetoHtmlLBL('anio') . '</td>
									<td>' . $ifu->ObjetoHtml('anio') . '</td>
									<td>' . $ifu->ObjetoHtmlLBL('mes') . '</td>
									<td>' . $ifu->ObjetoHtml('mes') . '</td>
									<td>' . $ifu->ObjetoHtmlLBL('tipo_doc_n') . '</td>
									<td>' . $ifu->ObjetoHtml('tipo_doc_n') . '</td>
								</tr>
								<tr>
									<td>' . $ifu->ObjetoHtmlLBL('tipo') . '</td>
									<td>' . $ifu->ObjetoHtml('tipo') . '</td>
									<td>' . $ifu->ObjetoHtmlLBL('actividad_n') . '</td>
									<td>' . $ifu->ObjetoHtml('actividad_n') . '</td>
									<td>' . $ifu->ObjetoHtmlLBL('banco') . '</td>
									<td>' . $ifu->ObjetoHtml('banco') . '</td>
								</tr>
								<tr>
									<td>' . $ifu->ObjetoHtmlLBL('fp_n') . '</td>
									<td>' . $ifu->ObjetoHtml('fp_n') . '</td>
									<td>' . $ifu->ObjetoHtmlLBL('depar') . '</td>
									<td>' . $ifu->ObjetoHtml('depar') . '</td>
									<td colspan="2">
										Fecha Registro Contable 
										<input type="date" name="fecha_n" step="1" value="' . $diaHoy . '" onchange="controlPeriodoIfx()">
									</td>
								</tr>
								<tr>
									<td colspan="6" align="center">
										<div class="btn btn-primary btn-sm" onclick="buscar_nomina();">
											<span class=" glyphicon glyphicon-search"></span>
											Consultar
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="empleados_nomina">
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" onClick="procesar_cheques_nomina()">Generar Cheques</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>';

        $oReturn->assign("miModal", "innerHTML", $sHtml);
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }


    return $oReturn;
}

function buscar_nomina($aForm = "")
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;

    $oReturn = new xajaxResponse();


    //      VARIABLES
    $id_empresa = $aForm['empresa'];
    $id_sucursal = $aForm['sucursal'];
    $id_anio = $aForm['anio'];
    $anio_amte = $id_anio;
    $anio_amte--;
    $id_mes = $aForm['mes'];
    $id_fp = $aForm['fp_n'];
    $id_banco = $aForm['banco'];
    $id_depar = $aForm['depar'];

    $proyecto = $aForm['proyecto'];
    $tipo = $aForm['tipo'];
    $rubro = $aForm['rubro'];
    $banco = $aForm['banco'];
    unset($_SESSION['U_ARRAY_EMPL']);
    if ($id_mes < 10) {
        $pago_per_pago = $id_anio . '0' . $id_mes;
    } else {
        $pago_per_pago = $id_anio . '' . $id_mes;
    }

    //cheque
    $sql = "select asto, cheque, empleado,
				ejer, prdo
				from comercial.empl_cheque
				where anio = '$id_anio' and
				mes = '$id_mes' and
				empresa = $id_empresa";
    if ($oCon->Query($sql)) {
        if ($oCon->NumFilas() > 0) {
            unset($arrayAstoEmpl);
            unset($arrayAstoCheque);
            do {
                $asto = $oCon->f('asto');
                $ejer = $oCon->f('ejer');
                $prdo = $oCon->f('prdo');

                $htmlAsto = '<a href="#" onclick="vista_previa_diario(' . $id_sucursal . ', 0, \'' . $asto . '\', ' . $ejer . ', \'' . $prdo . '\')">' . $asto . '</a>';

                $arrayAstoEmpl[$oCon->f('empleado')] = $htmlAsto;
                $arrayAstoCheque[$oCon->f('empleado')] = $oCon->f('cheque');
            } while ($oCon->SiguienteRegistro());
        }
    }
    $oCon->Free();

    //anticipo empleado
    $sql = "select pago_cod_empl, pago_val_pago
				from saepago
				where pago_cod_empr = $id_empresa and
				pago_per_pago = '$pago_per_pago' and
				pago_cod_rubr = 'RANTI' and
				pago_val_pago > 0";
    //$oReturn->alert($sql);
    if ($oIfx->Query($sql)) {
        if ($oIfx->NumFilas() > 0) {
            unset($arrayCtrlPago);
            do {
                $arrayCtrlPago[$oIfx->f('pago_cod_empl')] = $oIfx->f('pago_val_pago');
            } while ($oIfx->SiguienteRegistro());
        }
    }
    $oIfx->Free();

    //anticipo empleado
    $sql = "select anti_cod_empl, anti_val_anti
				from saeanti
				where anti_cod_empr = $id_empresa and
				DATE_PART('year', anti_fec_anti) = $id_anio and
				DATE_PART('month', anti_fec_anti) = $id_mes";
    if ($oIfx->Query($sql)) {
        if ($oIfx->NumFilas() > 0) {
            unset($arrayAnticipo);
            do {
                $arrayAnticipo[$oIfx->f('anti_cod_empl')] = $oIfx->f('anti_val_anti');
            } while ($oIfx->SiguienteRegistro());
        }
    }
    $oIfx->Free();

    if ($tipo == 1) {
        $sql_pro = '';
        if (!empty($proyecto)) {
            $sql = "select estr_cod_estr from saeestr where
								estr_cod_empr = $id_empresa and
								estr_cod_gpro = '$proyecto' ";
            $tmp_estr = '';
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $var = $oIfx->f('estr_cod_estr');
                        //$tmp_estr  .= "'.$oIfx->f('estr_cod_estr').',";
                        $tmp_estr .= "'" . $var . "',";
                    } while ($oIfx->SiguienteRegistro());
                }
            }

            //$estr_cod = consulta_string_func($sql, 'estr_cod_estr', $oIfx, '');

            if (!empty($tmp_estr)) {
                $tmp = substr($tmp_estr, 0, -1);

                $sql_pro = " and pago_cod_empl in ( select  esem_cod_empl from saeestr, saeesem where
																	estr_cod_estr = esem_cod_estr and
																	estr_cod_empr = $id_empresa and
																	estr_cod_padr  in (  $tmp )
																	group by 1 ) ";
            }
        }



        /*$sql_depar = '';
                if(!empty($id_depar)){
                    $sql_depar = " and e.empl_cod_empl in (  select esem_cod_empl from saeesem where
                                                                esem_cod_empr = $id_empresa and
                                                                esem_cod_estr like  '$id_depar%' ) ";
                }
                */

        $array_sucu = $_SESSION['U_ARRAY_DEPAR'];
        $tmp_sucu = '';
        $sql_depar = '';
        if (count($array_sucu) > 0) {
            foreach ($array_sucu as $val) {
                $sucu_cod = $val[0];
                $check = $aForm[$sucu_cod . '_c'];
                if (!empty($check)) {
                    //$tmp_sucu .= $sucu_cod.',';
                    $tmp_sucu .= "'" . $sucu_cod . "',";
                    // '%'|| saedpag.dpag_num_preimp ||'%'
                }
            }

            //$sql_depar = ' and fact_cod_sucu in ( '.substr($tmp_sucu, 0, -1).' )';

            if (!empty($tmp_sucu)) {
                $tmp = substr($tmp_sucu, 0, -1);
                $sql_depar = " and e.empl_cod_empl in (  select  esem_cod_empl from saeestr, saeesem where
																	estr_cod_estr = esem_cod_estr and
																	estr_cod_empr = $id_empresa and
																	estr_cod_padr  in (  $tmp  )
																	group by 1 ) ";
            }
            //$oReturn->alert($sql_depar);
        }


        $sql_fp = '';
        if (!empty($id_fp)) {
            $sql_fp = " and empl_cod_tpag = '$id_fp' ";
        }

        $sql_banc = '';
        if (!empty($id_banco)) {
            $sql_banc = " and empl_cod_banc = '$id_banco' ";
        }

        // TIPO CUENTA
        $sql = "select tcta_cod_tcta, tcta_des_tcta from saetcta ";
        unset($array_tipo);
        $array_tipo = array_dato($oIfx, $sql, 'tcta_cod_tcta', 'tcta_des_tcta');

        // INGRESOS
        $sql = "select sum(pago_val_pago) as valor, 'I' as tipo, pago_cod_empl from saepago where
							SUBSTR(cast(pago_per_pago as text), 0, 5) = '$id_anio' and
							SUBSTR(cast(pago_per_pago as text), 5, 2) = 'id_mes' and
							pago_cod_empr               = $id_empresa and
							pago_cod_rubr in ( select rubr_cod_rubr from saerubr where
													rubr_cod_empr = $id_empresa and
													rubr_cod_trub = 'I' and
													rubr_rol_desp = '1') 
							group by 2,3 ";
        unset($array_ing);
        $array_ing = array_dato($oIfx, $sql, 'pago_cod_empl', 'valor');

        // DESCUENTOS
        $sql = "select sum(pago_val_pago) as valor, 'I' as tipo, pago_cod_empl from saepago where
							SUBSTR(cast(pago_per_pago as text), 0, 5) = '$id_anio' and
							SUBSTR(cast(pago_per_pago as text), 5, 2) = 'id_mes' and
							pago_cod_empr               = $id_empresa and
							pago_cod_rubr in ( select rubr_cod_rubr from saerubr where
													rubr_cod_empr = $id_empresa and
													rubr_cod_trub = 'D' and
													rubr_rol_desp = '1') 
							group by 2,3 ";
        unset($array_egre);
        $array_egre = array_dato($oIfx, $sql, 'pago_cod_empl', 'valor');

        //anti

        // EMPLEADOS
        $sql = "select pago_cod_empl ,  empl_ape_nomb, 
							empl_cod_tpag, empl_cod_banc,
							empl_cod_tcta, empl_num_ctas, empl_tip_tide,
							empl_mai_empl
							from saepago p, saeempl e where 
							e.empl_cod_empl = p.pago_cod_empl and
							e.empl_cod_empr = $id_empresa and
							p.pago_cod_empr = $id_empresa and
							e.empl_cod_eemp='A' and
							SUBSTR(cast(pago_per_pago as text), 0, 5) = '$id_anio' and
							SUBSTR(cast(pago_per_pago as text), 5, 2) = '$id_mes'
							$sql_fp  $sql_depar $sql_pro
							group by 1,2,3,4,5,6,7, 8
							order by 2 ";
        //	echo $sql;exit;
        //$oReturn->alert($sql);

        unset($array_empl);
        if ($oIfx->Query($sql)) {
            if ($oIfx->NumFilas() > 0) {
                do {
                    $empl_cod = $oIfx->f('pago_cod_empl');
                    $empl_nom = $oIfx->f('empl_ape_nomb');
                    $empl_tpag = $oIfx->f('empl_cod_tpag');
                    $empl_banc = $oIfx->f('empl_cod_banc');
                    $tipo_cta = $array_tipo[$oIfx->f('empl_cod_tcta')];
                    $num_cta = $oIfx->f('empl_num_ctas');
                    $cod_cta = $oIfx->f('empl_cod_tcta');
                    $empl_tip = $oIfx->f('empl_tip_tide');
                    $empl_emai = $oIfx->f('empl_mai_empl');

                    $array_empl[] = array($empl_cod, $empl_nom, $empl_tpag, $empl_banc, $tipo_cta, $num_cta, $cod_cta, $empl_tip, $empl_emai);
                } while ($oIfx->SiguienteRegistro());
            }
        }
        $oIfx->Free();

        //$table_op .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:80%;">';
        //$table_op .='<legend class="Titulo">LISTADO DE EMPLEADOS</legend>';
        $table_op .= '	<table class="table table-striped table-condensed table-hover" style="width: 100%; margin-bottom: 0px;" align="center">';
        $table_op .= '<thead>
							 <tr class="info">
									<td class="diagrama" align="center">N</td>
									<td class="diagrama" align="center">Codigo</td>
									<td class="diagrama" align="center">Nombres</td>
									<td class="diagrama" align="center">Correo</td>
									<td class="diagrama" align="center">Tipo</td>
									<td class="diagrama" align="center">Cuenta</td>  
									<td class="diagrama" align="center">Valor</td>
									<td class="diagrama" align="center">Diario</td>
									<td class="diagrama" align="center">Cheque</td>
									<td class="diagrama"  align="center"><input type="checkbox" onclick="marcar(this);"></td>
							</tr>
							</thead>';
        //$oReturn->alert('Buscando...');
        if (count($array_empl) > 0) {
            $i = 1;
            $total = 0;
            unset($array);
            foreach ($array_empl as $val) {
                $empl_cod = $val[0];
                $empl_nom = $val[1];
                $empl_tpag = $val[2];
                $empl_banc = $val[3];
                $tipo_cta = $val[4];
                $num_cta = $val[5];
                $cod_cta = $val[6];
                $empl_tip = $val[7];
                $empl_emai = $val[8];

                $ingreso = vacios($array_ing[$empl_cod], 0);
                $egreso = vacios($array_egre[$empl_cod], 0);
                $sueldo = 0;
                $sueldo = $ingreso - $egreso;
                $sueldo = round($sueldo, 2);

                if ($sueldo > 0) {
                    $anticipo = 0;
                    $ctrl = '';
                    $ctrl = $arrayCtrlPago[$empl_cod];
                    if (empty($ctrl)) {

                        $anticipo = $arrayAnticipo[$empl_cod];

                        if ($anticipo > 0) {
                            $sueldo -= $anticipo;
                        }
                    }
                    if ($sueldo > 0) {
                        $count = substr_count($sueldo, '.');

                        $ifu->AgregarCampoCheck($empl_cod, '', false, 'N');

                        $array[] = array($empl_cod, $empl_nom, $tipo_cta, $num_cta, $sueldo, $empl_banc, $cod_cta, $empl_tip, $empl_emai);

                        if ($sClass == 'off')
                            $sClass = 'on';
                        else
                            $sClass = 'off';
                        $table_op .= '<tr  class="warning">';
                        $table_op .= '<td align="right" >' . $i . '</td>';
                        $table_op .= '<td align="right" >' . $empl_cod . '</td>';
                        $table_op .= '<td align="left"  >' . $empl_nom . '</td>';
                        $table_op .= '<td align="left"  >' . $empl_emai . '</td>';
                        $table_op .= '<td align="left"  >' . $tipo_cta . '</td>';
                        $table_op .= '<td align="left"  >' . $num_cta . '</td>';
                        $table_op .= '<td align="right" >' . $sueldo . '</td>';
                        $table_op .= '<td>' . $arrayAstoEmpl[$empl_cod] . '</td>';
                        $table_op .= '<td>' . $arrayAstoCheque[$empl_cod] . '</td>';
                        $table_op .= '<td align="right" >' . $ifu->ObjetoHtml($empl_cod) . '</td>';
                        $table_op .= '</tr>';

                        $i++;
                        $total += $sueldo;
                    }
                }
            }

            if ($sClass == 'off')
                $sClass = 'on';
            else
                $sClass = 'off';
            $table_op .= '<tr class="info">';
            $table_op .= '<td align="right" ></td>';
            $table_op .= '<td align="right" ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  >TOTAL:</td>';
            $table_op .= '<td align="right" class="fecha_letra" >' . $total . '</td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '</tr>';
        }

        $table_op .= '</table>';
    }


    if ($tipo == 2) {
        $sql_pro = '';
        if (!empty($proyecto)) {
            $sql = "select estr_cod_estr from saeestr where
							estr_cod_empr = $id_empresa and
							estr_cod_gpro = '$proyecto' ";
            $tmp_estr = '';
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $var = $oIfx->f('estr_cod_estr');
                        //$tmp_estr  .= "'.$oIfx->f('estr_cod_estr').',";
                        $tmp_estr .= "'" . $var . "',";
                    } while ($oIfx->SiguienteRegistro());
                }
            }
            $oIfx->Free();

            if (!empty($tmp_estr)) {
                $tmp = substr($tmp_estr, 0, -1);

                $sql_pro = " and anti_cod_empl in ( select  esem_cod_empl from saeestr, saeesem where
															estr_cod_estr = esem_cod_estr and
															estr_cod_empr = $id_empresa and
															estr_cod_padr  in (  $tmp )
															group by 1 ) ";
            }
        }
        $array_sucu = $_SESSION['U_ARRAY_DEPAR'];
        $tmp_sucu = '';
        $sql_depar = '';
        if (count($array_sucu) > 0) {
            foreach ($array_sucu as $val) {
                $sucu_cod = $val[0];
                $check = $aForm[$sucu_cod . '_c'];
                if (!empty($check)) {
                    //$tmp_sucu .= $sucu_cod.',';
                    $tmp_sucu .= "'" . $sucu_cod . "',";
                    // '%'|| saedpag.dpag_num_preimp ||'%'
                }
            }

            //$sql_depar = ' and fact_cod_sucu in ( '.substr($tmp_sucu, 0, -1).' )';

            if (!empty($tmp_sucu)) {
                $tmp = substr($tmp_sucu, 0, -1);
                $sql_depar = " and e.empl_cod_empl in (  select  esem_cod_empl from saeestr, saeesem where
																	estr_cod_estr = esem_cod_estr and
																	estr_cod_empr = $id_empresa and
																	estr_cod_padr  in (  $tmp  )
																	group by 1 ) ";
            }
            //$oReturn->alert($sql_depar);
        }


        $sql_fp = '';
        if (!empty($id_fp)) {
            $sql_fp = " and empl_cod_tpag = '$id_fp' ";
        }

        $sql_banc = '';
        if (!empty($id_banco)) {
            $sql_banc = " and empl_cod_banc = '$id_banco' ";
        }
        $sql = "select anti_cod_empl,anti_val_anti ,  empl_ape_nomb, 
							empl_cod_tpag, empl_cod_banc,
							empl_cod_tcta, empl_num_ctas, empl_tip_tide,
							empl_mai_empl
							from saeanti a, saeempl e where 
							e.empl_cod_empl = a.anti_cod_empl and
							e.empl_cod_empr = $id_empresa and
							a.anti_cod_empr = $id_empresa and
							DATE_PART('year', a.anti_fec_anti) = $id_anio and
							DATE_PART('month', a.anti_fec_anti) = $id_mes
							$sql_fp  $sql_depar $sql_pro
							group by 1,2,3,4,5,6,7, 8, 9
							order by 2 ";
        //$oReturn->alert($sql);
        unset($array_empl);
        if ($oIfx->Query($sql)) {
            if ($oIfx->NumFilas() > 0) {
                do {
                    $empl_cod = $oIfx->f('anti_cod_empl');
                    $empl_nom = $oIfx->f('empl_ape_nomb');
                    $empl_tpag = $oIfx->f('empl_cod_tpag');
                    $empl_banc = $oIfx->f('empl_cod_banc');
                    $tipo_cta = $array_tipo[$oIfx->f('empl_cod_tcta')];
                    $num_cta = $oIfx->f('empl_num_ctas');
                    $cod_cta = $oIfx->f('empl_cod_tcta');
                    $empl_tip = $oIfx->f('empl_tip_tide');
                    $empl_emai = $oIfx->f('empl_mai_empl');
                    $anti_val_anti = $oIfx->f('anti_val_anti');

                    $array_empl[] = array($empl_cod, $empl_nom, $empl_tpag, $empl_banc, $tipo_cta, $num_cta, $cod_cta, $empl_tip, $empl_emai, $anti_val_anti);
                } while ($oIfx->SiguienteRegistro());
            }
        }
        $oIfx->Free();

        //$table_op .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:80%;">';
        //$table_op .='<legend class="Titulo">LISTADO DE EMPLEADOS</legend>';
        $table_op .= '<table class="table table-striped table-condensed table-hover" style="width: 100%; margin-bottom: 0px;" align="center">';
        $table_op .= '<thead>
							 <tr class="info">
									<td class="diagrama" align="center">N</td>
									<td class="diagrama" align="center">Codigo</td>
									<td class="diagrama" align="center">Nombres</td>
									<td class="diagrama" align="center">Correo</td>
									<td class="diagrama" align="center">Tipo</td>
									<td class="diagrama" align="center">Cuenta</td>  
									<td class="diagrama" align="center">Valor</td>
									<td class="diagrama" align="center">Diario</td>
									<td class="diagrama" align="center">Cheque</td>
									<td class="diagrama"  align="center"><input type="checkbox" onclick="marcar(this);"></td>
							</tr>
							</thead>';
        //$oReturn->alert('Buscando...');
        if (count($array_empl) > 0) {
            $i = 1;
            $total = 0;
            unset($array);
            foreach ($array_empl as $val) {
                $empl_cod = $val[0];
                $empl_nom = $val[1];
                $empl_tpag = $val[2];
                $empl_banc = $val[3];
                $tipo_cta = $val[4];
                $num_cta = $val[5];
                $cod_cta = $val[6];
                $empl_tip = $val[7];
                $empl_emai = $val[8];
                $anti_val_anti = $val[9];

                $sueldo = 0;
                $sueldo = $anti_val_anti;

                if ($sueldo > 0) {

                    $count = substr_count($sueldo, '.');

                    $ifu->AgregarCampoCheck($empl_cod, '', false, 'N');

                    $array[] = array($empl_cod, $empl_nom, $tipo_cta, $num_cta, $sueldo, $empl_banc, $cod_cta, $empl_tip, $empl_emai);

                    if ($sClass == 'off')
                        $sClass = 'on';
                    else
                        $sClass = 'off';
                    $table_op .= '<tr class="warning">';
                    $table_op .= '<td align="right" >' . $i . '</td>';
                    $table_op .= '<td align="right" >' . $empl_cod . '</td>';
                    $table_op .= '<td align="left"  >' . $empl_nom . '</td>';
                    $table_op .= '<td align="left"  >' . $empl_emai . '</td>';
                    $table_op .= '<td align="left"  >' . $tipo_cta . '</td>';
                    $table_op .= '<td align="left"  >' . $num_cta . '</td>';
                    $table_op .= '<td align="right" >' . $sueldo . '</td>';
                    $table_op .= '<td>' . $arrayAstoEmpl[$empl_cod] . '</td>';
                    $table_op .= '<td>' . $arrayAstoCheque[$empl_cod] . '</td>';
                    $table_op .= '<td align="center" >' . $ifu->ObjetoHtml($empl_cod) . '</td>';
                    $table_op .= '</tr>';

                    $i++;
                    $total += $sueldo;
                }
            }

            if ($sClass == 'off')
                $sClass = 'on';
            else
                $sClass = 'off';

            $table_op .= '<tr class="info">';
            $table_op .= '<td align="right" ></td>';
            $table_op .= '<td align="right" ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  >TOTAL:</td>';
            $table_op .= '<td align="right" class="fecha_letra" >' . $total . '</td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '</tr>';
        }

        $table_op .= '</table>';
    }



    if ($tipo == 3) {
        $fecha1 = '12/01/' . $anio_amte;
        $fecha2 = '11/30/' . $id_anio;
        $sql_pro = '';
        if (!empty($proyecto)) {
            $sql = "select estr_cod_estr from saeestr where
							estr_cod_empr = $id_empresa and
							estr_cod_gpro = '$proyecto' ";
            $tmp_estr = '';
            if ($oIfx->Query($sql)) {
                if ($oIfx->NumFilas() > 0) {
                    do {
                        $var = $oIfx->f('estr_cod_estr');
                        //$tmp_estr  .= "'.$oIfx->f('estr_cod_estr').',";
                        $tmp_estr .= "'" . $var . "',";
                    } while ($oIfx->SiguienteRegistro());
                }
            }
            $oIfx->Free();

            if (!empty($tmp_estr)) {
                $tmp = substr($tmp_estr, 0, -1);

                $sql_pro = " and pemp_cod_empl in ( select  esem_cod_empl from saeestr, saeesem where
															estr_cod_estr = esem_cod_estr and
															estr_cod_empr = $id_empresa and
															estr_cod_padr  in (  $tmp )
															group by 1 ) ";
            }
        }
        $array_sucu = $_SESSION['U_ARRAY_DEPAR'];
        $tmp_sucu = '';
        $sql_depar = '';
        if (count($array_sucu) > 0) {
            foreach ($array_sucu as $val) {
                $sucu_cod = $val[0];
                $check = $aForm[$sucu_cod . '_c'];
                if (!empty($check)) {
                    //$tmp_sucu .= $sucu_cod.',';
                    $tmp_sucu .= "'" . $sucu_cod . "',";
                    // '%'|| saedpag.dpag_num_preimp ||'%'
                }
            }

            //$sql_depar = ' and fact_cod_sucu in ( '.substr($tmp_sucu, 0, -1).' )';

            if (!empty($tmp_sucu)) {
                $tmp = substr($tmp_sucu, 0, -1);
                $sql_depar = " and e.empl_cod_empl in (  select  esem_cod_empl from saeestr, saeesem where
																	estr_cod_estr = esem_cod_estr and
																	estr_cod_empr = $id_empresa and
																	estr_cod_padr  in (  $tmp  )
																	group by 1 ) ";
            }
            //$oReturn->alert($sql_depar);
        }


        $sql_fp = '';
        if (!empty($id_fp)) {
            $sql_fp = " and empl_cod_tpag = '$id_fp' ";
        }

        $sql_banc = '';
        if (!empty($id_banco)) {
            $sql_banc = " and empl_cod_banc = '$id_banco' ";
        }
        $sql = "SELECT
						pemp_cod_empl,
						sum(pemp_val_mese) as pemp_val_mese,
						empl_ape_nomb,
						empl_cod_tpag,
						empl_cod_banc,
						empl_cod_tcta,
						empl_num_ctas,
						empl_tip_tide,
						empl_mai_empl
					FROM
						saepemp p,
						saeempl e
					WHERE
						e.empl_cod_empl = p.pemp_cod_empl
					AND e.empl_cod_empr = $id_empresa
					AND p.pemp_cod_empr = $id_empresa
					AND p.pemp_fec_real BETWEEN  '$fecha1' and '$fecha2'
					AND p.pemp_cod_pnom='$rubro'
					$sql_fp  $sql_depar $sql_pro
					
					GROUP BY
						pemp_cod_empl,
						empl_ape_nomb,
						empl_cod_tpag,
						empl_cod_banc,
						empl_cod_tcta,
						empl_num_ctas,
						empl_tip_tide,
						empl_mai_empl";

        //echo $sql;Exit;
        unset($array_empl);
        if ($oIfx->Query($sql)) {
            if ($oIfx->NumFilas() > 0) {
                do {
                    $empl_cod = $oIfx->f('pemp_cod_empl');
                    $empl_nom = $oIfx->f('empl_ape_nomb');
                    $empl_tpag = $oIfx->f('empl_cod_tpag');
                    $empl_banc = $oIfx->f('empl_cod_banc');
                    $tipo_cta = $array_tipo[$oIfx->f('empl_cod_tcta')];
                    $num_cta = $oIfx->f('empl_num_ctas');
                    $cod_cta = $oIfx->f('empl_cod_tcta');
                    $empl_tip = $oIfx->f('empl_tip_tide');
                    $empl_emai = $oIfx->f('empl_mai_empl');
                    $pemp_val_mese = $oIfx->f('pemp_val_mese');

                    $array_empl[] = array($empl_cod, $empl_nom, $empl_tpag, $empl_banc, $tipo_cta, $num_cta, $cod_cta, $empl_tip, $empl_emai, $pemp_val_mese);
                } while ($oIfx->SiguienteRegistro());
            }
        }
        $oIfx->Free();

        //$table_op .='<fieldset style="border:#999999 1px solid; padding:2px; text-align:center; width:80%;">';
        //$table_op .='<legend class="Titulo">LISTADO DE EMPLEADOS</legend>';
        $table_op .= '<table class="table table-striped table-condensed table-hover" style="width: 100%; margin-bottom: 0px;" align="center">';
        $table_op .= '<thead>
							 <tr class="info">
									<td class="diagrama" align="center">N</td>
									<td class="diagrama" align="center">Codigo</td>
									<td class="diagrama" align="center">Nombres</td>
									<td class="diagrama" align="center">Correo</td>
									<td class="diagrama" align="center">Tipo</td>
									<td class="diagrama" align="center">Cuenta</td>  
									<td class="diagrama" align="center">Valor</td>
									<td class="diagrama" align="center">Diario</td>
									<td class="diagrama" align="center">Cheque</td>
									<td class="diagrama"  align="center"><input type="checkbox" onclick="marcar(this);"></td>
							</tr>
							</thead>';
        //$oReturn->alert('Buscando...');
        if (count($array_empl) > 0) {
            $i = 1;
            $total = 0;
            unset($array);
            foreach ($array_empl as $val) {
                $empl_cod = $val[0];
                $empl_nom = $val[1];
                $empl_tpag = $val[2];
                $empl_banc = $val[3];
                $tipo_cta = $val[4];
                $num_cta = $val[5];
                $cod_cta = $val[6];
                $empl_tip = $val[7];
                $empl_emai = $val[8];
                $pemp_val_mese = $val[9];

                $sueldo = 0;
                $sueldo = $pemp_val_mese;

                if ($sueldo > 0) {

                    $count = substr_count($sueldo, '.');

                    $ifu->AgregarCampoCheck($empl_cod, '', false, 'N');

                    $array[] = array($empl_cod, $empl_nom, $tipo_cta, $num_cta, $sueldo, $empl_banc, $cod_cta, $empl_tip, $empl_emai);

                    if ($sClass == 'off')
                        $sClass = 'on';
                    else
                        $sClass = 'off';
                    $table_op .= '<tr class="warning">';
                    $table_op .= '<td align="right" >' . $i . '</td>';
                    $table_op .= '<td align="right" >' . $empl_cod . '</td>';
                    $table_op .= '<td align="left"  >' . $empl_nom . '</td>';
                    $table_op .= '<td align="left"  >' . $empl_emai . '</td>';
                    $table_op .= '<td align="left"  >' . $tipo_cta . '</td>';
                    $table_op .= '<td align="left"  >' . $num_cta . '</td>';
                    $table_op .= '<td align="right" >' . $sueldo . '</td>';
                    $table_op .= '<td>' . $arrayAstoEmpl[$empl_cod] . '</td>';
                    $table_op .= '<td>' . $arrayAstoCheque[$empl_cod] . '</td>';
                    $table_op .= '<td align="right" >' . $ifu->ObjetoHtml($empl_cod) . '</td>';
                    $table_op .= '</tr>';

                    $i++;
                    $total += $sueldo;
                }
            }

            if ($sClass == 'off')
                $sClass = 'on';
            else
                $sClass = 'off';
            $table_op .= '<tr class="info">';
            $table_op .= '<td align="right" ></td>';
            $table_op .= '<td align="right" ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '<td align="left"  >TOTAL:</td>';
            $table_op .= '<td align="right" class="fecha_letra" >' . $total . '</td>';
            $table_op .= '<td align="left"  ></td>';
            $table_op .= '</tr>';
        }

        $table_op .= '</table>';
    }


    $_SESSION['U_ARRAY_EMPL'] = $array;
    $oReturn->assign("empleados_nomina", "innerHTML", $table_op);
    // $oReturn->script('cargar_scroll();');
    return $oReturn;
}

function procesar_cheques_nomina($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oReturn = new xajaxResponse();

    //      VARIABLES
    $user_web = $_SESSION['U_ID'];
    $user_ifx = $_SESSION['U_USER_INFORMIX'];
    $empleados = $_SESSION['U_ARRAY_EMPL'];

    $idempresa = $aForm['empresa'];
    $idsucursal = $aForm['sucursal'];
    $tidu_cod = $aForm['tipo_doc_n'];
    // $fecha_mov    = $aForm['fecha_n'];
    // $fechaMysql    = $aForm['fecha_n'];
    $fecha_mov = $aForm['fecha'];
    $fechaMysql = $aForm['fecha'];
    $form_cod = $aForm['formato'];
    $banco = $aForm['banco'];
    $anio = $aForm['anio'];
    $mes = $aForm['mes'];
    $act_cod = $aForm['actividad_n'];
    $ccosn_cod = '';
    $time = date("Y-m-d H:i:s");
    $cotiza = 1;

    if (count($empleados) > 0) {

        //      TRANSACCIONALIDAD IFX
        try {
            // commit
            $oIfx->QueryT('BEGIN WORK;');

            //MAYORIZACION
            $class = new mayorizacion_class();
            unset($array);
            foreach ($empleados as $arreglo) {
                $empl_cod = $arreglo[0];
                $empl_nom = $arreglo[1];
                $tipo_cta = $arreglo[2];
                $num_cta = $arreglo[3];
                $sueldo = $arreglo[4];
                $empl_banc = $arreglo[5];
                $cod_cta = $arreglo[6];
                $empl_tip = $arreglo[7];
                $empl_emai = $arreglo[8];

                $check = $aForm[$empl_cod];

                if (!empty($check)) {

                    $sql = "select empl_ape_nomb from saeempl where empl_cod_empl = '$empl_cod'";
                    $clpv_nom = consulta_string_func($sql, 'empl_ape_nomb', $oIfx, '');

                    $detalleAsto = 'PAGO NOMINA ' . $anio . ' - ' . $mes . ' - ' . $clpv_nom;

                    $array = $class->secu_asto($oIfx, $idempresa, $idsucursal, 5, $fecha_mov, $user_ifx, $tidu_cod);
                    foreach ($array as $val) {
                        $secu_asto = $val[0];
                        $secu_dia = $val[1];
                        $tidu = $val[2];
                        $idejer = $val[3];
                        $idprdo = $val[4];
                        $moneda = $val[5];
                        $tcambio = $val[6];
                        $empleado = $val[7];
                        $usua_nom = $val[8];
                    } // fin foreach

                    $class->saeasto(
                        $oIfx,
                        $secu_asto,
                        $idempresa,
                        $idsucursal,
                        $idejer,
                        $idprdo,
                        $moneda,
                        $user_ifx,
                        '',
                        $clpv_nom,
                        0,
                        $fecha_mov,
                        $detalleAsto,
                        $secu_dia,
                        $fecha_mov,
                        $tidu,
                        $usua_nom,
                        $user_web,
                        5
                    );

                    //ctab cod
                    $sql = "select ctab_cod_ctab from saectab where ctab_cod_banc = $banco and ctab_cod_empr = $idempresa";
                    $ctab_cod_ctab = consulta_string_func($sql, 'ctab_cod_ctab', $oIfx, '');

                    //banco
                    $sql = "select banc_nom_banc from saebanc where banc_cod_banc = $banco and banc_cod_empr = $idempresa";
                    $banc_nom_banc = consulta_string_func($sql, 'banc_nom_banc', $oIfx, '');

                    //cheque
                    $num_cheq = '';

                    $sql = "select ctab_num_cheq, ctab_num_ctab, ctab_cod_cuen
									from saectab
									where ctab_cod_empr = $idempresa and
									ctab_cod_ctab = $ctab_cod_ctab";
                    if ($oIfx->Query($sql)) {
                        if ($oIfx->NumFilas() > 0) {
                            $num_cheq = $oIfx->f('ctab_num_cheq');
                            $cta_cheq = $oIfx->f('ctab_num_ctab');
                            $ctab_cod_cuen = $oIfx->f('ctab_cod_cuen');
                        }
                    }
                    $oIfx->Free();

                    //$num_cheq = $num_cheq + 1;
                    $num_cheq = secuencial_pedido(2, '0', $num_cheq, 9);

                    $sql = "insert into saedchc ( dchc_cod_ctab,   dchc_cod_asto ,
														  asto_cod_empr,   asto_cod_sucu ,
														  asto_cod_ejer,   asto_num_prdo ,
														  dchc_num_dchc,   dchc_val_dchc ,
														  dchc_cta_dchc,   dchc_fec_dchc ,
														  dchc_benf_dchc,  dchc_cod_cuen ,
														  dchc_nom_banc ,  dchc_con_fila )
												values ( $ctab_cod_ctab,   '$secu_asto',
														 $idempresa,       $idsucursal,
														 $idejer,          $idprdo,
														 '$num_cheq',      $sueldo,
														 '$cta_cheq',      '$fecha_mov',
														 '$clpv_nom',      '$ctab_cod_cuen',
														 '$banc_nom_banc',        2) ";
                    $oIfx->QueryT($sql);

                    // UPDATE CHEQUE
                    $sql = "update saectab set ctab_num_cheq = '$num_cheq' where
										ctab_cod_empr = $idempresa and
										ctab_cod_sucu = $idsucursal and
										ctab_cod_ctab = $ctab_cod_ctab ";
                    $oIfx->QueryT($sql);

                    for ($i = 0; $i <= 1; $i++) {
                        if ($i == 0) {
                            $sql = "select estr_cod_padr
											from saeesem, saeestr
											where esem_cod_estr = estr_cod_estr and
											esem_cod_empr = estr_cod_empr and
											esem_cod_empl = '$empl_cod' and 
											esem_cod_empr = $idempresa and
											esem_est_esem = 'I'";
                            $estr_cod_padr = consulta_string_func($sql, 'estr_cod_padr', $oIfx, '');

                            $sql = "select estr_cod_cuen from saeestr where estr_cod_estr = '$estr_cod_padr' and estr_cod_empr = $idempresa";
                            $cta_cod = consulta_string_func($sql, 'estr_cod_cuen', $oIfx, '');

                            $debito = $sueldo;
                            $credito = 0;
                        } else {
                            //cta banco
                            $cta_cod = $ctab_cod_cuen;
                            $debito = 0;
                            $credito = $sueldo;
                        }

                        $class->saedasi(
                            $oIfx,
                            $idempresa,
                            $idsucursal,
                            $cta_cod,
                            $idprdo,
                            $idejer,
                            $ccosn_cod,
                            $debito,
                            $credito,
                            $debito,
                            $credito,
                            $cotiza,
                            $detalle_dasi,
                            '',
                            '',
                            $user_web,
                            $secu_asto,
                            $dasi_cod_ret,
                            $dasi_dir,
                            $dasi_cta_ret,
                            $opBand,
                            $opBacn,
                            $opFlch,
                            $num_cheq,
                            $act_cod
                        );
                    }

                    $sql = "update saeasto set asto_est_asto = 'MY', 
									asto_vat_asto = $sueldo  where
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

                    $sql = "insert into empl_cheque(empresa, empleado, anio, mes, asto, cheque, fecha, ejer, prdo, user_web, fecha_server)
												values($idempresa, '$empl_cod', '$anio', '$mes', '$secu_asto', '$num_cheq', '$fechaMysql', $idejer, '$idprdo', $user_web, '$time')";
                    $oCon->QueryT($sql);
                }
            }

            $oIfx->QueryT('COMMIT WORK;');
            $oReturn->alert('Ingresado Correctamente...');
            $oReturn->script('buscar_nomina();');
        } catch (Exception $e) {
            // rollback
            $oIfx->QueryT('ROLLBACK WORK;');
            $oReturn->alert($e->getMessage());
            $oReturn->assign("ctrl", "value", 1);

            $oReturn->script('habilitar_boton();');
        }
    } else {
        $oReturn->alert('Por favor ingrese un Ingreso....');
        $oReturn->script('habilitar_boton();');
    }

    return $oReturn;
}


function secuencial_pedido($op, $serie, $as_codigo_pedido, $ceros_sql)
{
    //string
    $ls_codigo;
    $ceros;
    $ls_codigos;

    //integer
    $li_codigo;
    $ceros1;
    $ll_numeros;
    $ll_codigo;

    if (isset($as_codigo_pedido) or $as_codigo_pedido == '') {
        $li_codigo = ($as_codigo_pedido);

        $li_codigo = 0;
    } else {
        $li_codigo = $as_codigo_pedido;
    }

    $li_codigo = $as_codigo_pedido;

    $li_codigo = $li_codigo + 1;
    $ll_numeros = strlen(($li_codigo));
    $ceros = cero_mas('0', $ceros_sql);
    $ceros1 = strlen($ceros);
    $ll_codigo = $ceros1 - $ll_numeros;

    switch ($op) {
        case 1:
            // secuencial user
            $ls_codigos = $serie . '-' . (cero_mas('0', $ll_codigo)) . ($li_codigo);
            break;
        case 2:
            // secuencial normal
            $ls_codigos = (cero_mas('0', $ll_codigo)) . ($li_codigo);
            break;
    }

    return $ls_codigos;
}


function cero_mas($caracter, $num)
{
    if ($num > 0) {
        for ($i = 1; $i <= $num; $i++) {
            $arreglo[$i] = $caracter;
        }

        while (list($i, $Valor) = each($arreglo)) {
            $cadena .= $Valor;
        }
    } else {
        $cadena = '';
    }

    return $cadena;
}


function controlCheque($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oCon = new Dbo();
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    $idempresa = $_SESSION['U_EMPRESA'];

    $cta_cheq = $aForm['cheque'];
    $cheque = $aForm['cheque'];

    if (!empty($cheque)) {
        try {

            $sql = "select count(*) as control
					from saedchc
					where 
					dchc_cod_ctab = '$cta_cheq' and
					dchc_num_dchc = '$cheque' and
					asto_cod_empr = $idempresa";
            $control = consulta_string_func($sql, 'control', $oIfx, '');

            if ($control > 0) {
                $oReturn->alert("Numero de Cheque ya utilizado..!");
                $oReturn->assign("cheque", "value", "");
            }
        } catch (Exception $e) {
            $oReturn->alert($e->getMessage());
        }
    }
    return $oReturn;
}

// PRESTAMOS EMPLEADOS
function formulario_prestamo($idempresa = '', $idsucursal = '', $empl_cod, $detalle)
{
    //  Definiciones
    global $DSN_Ifx, $DSN;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;

    $fu = new Formulario;
    $fu->DSN = $DSN;

    $oReturn = new xajaxResponse();

    $sAccion = 'nuevo';
    //	echo $empl_cod;exit;
    switch ($sAccion) {
        case 'nuevo':
            $ifu->AgregarCampoFecha('fecha_pres', 'Fecha|left', true, date('Y') . '/' . date('m') . '/' . date('d'));
            $ifu->AgregarCampoListaSQL('empleado_pres', 'Empleado|left', "select empl_cod_empl, empl_ape_nomb, * from saeempl where
																						empl_cod_empr = $idempresa and
																					
																						empl_cod_empl= '$empl_cod'
																						order by 3 ", true, 200, 200);
            $ifu->AgregarCampoNumerico('codigo_pres', 'Codigo|left', true, 0, 80, 150);
            $ifu->AgregarCampoTexto('detalle_pres', 'Concepto|left', true, $detalle, 400, 200);


            $ifu->AgregarCampoListaSQL('tipo_pres', 'Tipo Prestamos|left', "SELECT tpre_cod_tpre, tpre_des_tpre from saetpre where tpre_cod_empr = $idempresa ", true, 200, 150);
            $ifu->AgregarCampoNumerico('monto', 'Monto|left', true, '', 70, 150);
            $ifu->AgregarCampoNumerico('plazo', 'Plazo (Meses)|left', true, '', 70, 150);
            $ifu->AgregarCampoNumerico('interes', 'Tasa Interes|left', true, '', 70, 150);

            $anio = date("Y");
            $mes = date("m");

            $ifu->AgregarCampoListaSQL('mes_pres', 'Mes Pago|left', "select prdo_num_prdo, prdo_nom_prdo from saeprdo where prdo_cod_empr = $idempresa and  DATE_PART('year', prdo_fec_ini)=$anio group by 1,2 order by 1  ", true, 100, 150);
            $ifu->AgregarCampoListaSQL('anio_pres', 'Anio Pago|left', "select DATE_PART('year', ejer_fec_inil) as id_anio, DATE_PART('year', ejer_fec_inil) as id_anio  from saeejer where ejer_cod_empr = $idempresa  order by 1 desc ", true, 100, 150);


            $ifu->cCampos["anio_pres"]->xValor = $anio;
            $ifu->cCampos["mes_pres"]->xValor = $mes;
            $ifu->cCampos["empleado_pres"]->xValor = $empl_cod;

            break;
    }

    //tipo de pago del departamento
    // tipos de pago
    unset($array_tipo_pagos);
    $sql = "select * from saeppag";
    if ($oIfx->Query($sql)) {
        if ($oIfx->NumFilas() > 0) {
            do {
                $array_tipo_pagos[$oIfx->f('ppag_cod_ppag')] = $oIfx->f('ppag_des_ppag');
            } while ($oIfx->SiguienteRegistro());
        }
    }
    //cargo
    $sql = "select esem_cod_estr from saeesem where esem_fec_sali is null and esem_cod_empl='$empl_cod' and esem_cod_empr='$idempresa'";
    $esem_cod_estr = consulta_string($sql, 'esem_cod_estr', $oIfx, 0);
    //departamento
    $sql = "select estr_cod_padr from saeestr where estr_cod_estr ='$esem_cod_estr' and estr_cod_empr='$idempresa'";
    $estr_cod_padr = consulta_string($sql, 'estr_cod_padr', $oIfx, 0);


    //datos del detartamento
    $sql = "select estr_cod_ppag, estr_des_estr from saeestr where estr_cod_estr ='$estr_cod_padr' and estr_cod_empr='$idempresa'";
    $estr_cod_ppag = consulta_string($sql, 'estr_cod_ppag', $oIfx, 0);
    $estr_des_estr = consulta_string($sql, 'estr_des_estr', $oIfx, 0);

    $sHtml .= '<table class="table table-striped table-condensed" style="margin-bottom: 0px; width: 95%" align="center">
					<tr>
						<td>
							<div class="btn btn-primary btn-sm" onclick="genera_formulario();">
                                <span class="glyphicon glyphicon-file"></span>
                                Nuevo
                            </div>
							<div class="btn btn-primary btn-sm" onclick="guardar_prestamo();">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                                Guardar
                            </div>
							<div class="btn btn-primary btn-sm" onclick="vista_previa();">
                                <span class="glyphicon glyphicon-print"></span>
                                Imprimir
                            </div>
						</td>
						<td align="right">
							<div class="btn btn-danger btn-sm" onclick="cancelar_pedido();">
                                <span class="glyphicon glyphicon-remove"></span>
                                Cancelar
                            </div>
						</td>
					</tr>
                  </table>';
    $sHtml .= '<table border ="0" class="table table-striped table-condensed" style="margin-bottom: 0px; width: 95%" align="center">';
    $sHtml .= '<tr>
                       <td class="bg-primary" align="center" colspan="4">PRESTAMOS</td>
                   </tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('fecha_pres') . '</td>
						<td colspan="1"><input type="date" id="fecha_pres" name="fecha_pres" value="' . date('Y-m-d') . '" ></td>
						<td>Departamento:</td>
						<td>' . $estr_des_estr . '</td>
					</tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('empleado_pres') . '</td>
						<td colspan="1">' . $ifu->ObjetoHtml('empleado_pres') . '</td>
						<td>Forma Pago:</td>
						<td>' . $array_tipo_pagos[$estr_cod_ppag] . '</td>
                   </tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('detalle_pres') . '</td>
						<td colspan="4">' . $ifu->ObjetoHtml('detalle_pres') . '</td>
                   </tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('tipo_pres') . '</td>
						<td>' . $ifu->ObjetoHtml('tipo_pres') . '</td>     
						<td>' . $ifu->ObjetoHtmlLBL('monto') . '</td>
						<td>' . $ifu->ObjetoHtml('monto') . '</td>     
                   </tr>';
    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('plazo') . '</td>
						<td>' . $ifu->ObjetoHtml('plazo') . '</td>     
						<td>' . $ifu->ObjetoHtmlLBL('interes') . '</td>
						<td>' . $ifu->ObjetoHtml('interes') . '
                        <input name="montototalp" type="hidden" id="montototalp" value="0">
                        </td>     
                   </tr>';

    $sHtml .= '<tr>
						<td>' . $ifu->ObjetoHtmlLBL('anio_pres') . '</td>
						<td>' . $ifu->ObjetoHtml('anio_pres') . '</td>     
						<td colspan="2">
							<table style="width:100%">
								<tr>
									<td>' . $ifu->ObjetoHtmlLBL('mes_pres') . '</td>
									<td>' . $ifu->ObjetoHtml('mes_pres') . '</td>';
    if ($estr_cod_ppag == 2) {
        $sHtml .= '<td>* Quincena <select id="dia_pres" name="dia_pres">
								<option value="1">PRIMERA</option>
								<option value="2">SEGUNDA</option>
							</select>
						</td>
					</tr>
				</table>
			</td>
			</tr>';
    }
    if ($estr_cod_ppag == 3) {
        $sHtml .= '<td>* Semana del: <select id="dia_pres" name="dia_pres">
								<option value="07">7</option>
								<option value="14">14</option>
								<option value="21">21</option>
								<option value="28">28</option>
							</select>
						</td>
					</tr>
					</table>
					</td>
					</tr>';
    }
    $sHtml .= '<tr>
                        <td align="center" colspan="4">
							<div class="btn btn-primary btn-sm" onclick="generarTablaAmortizacion();">
								<span class="glyphicon glyphicon-list-alt"></span>
								Generar
							</div>
						</td>
				</tr>';


    $sHtml .= '</table>';




    $oReturn->assign("divFormularioDetalle", "innerHTML", $sHtml);

    return $oReturn;
}


function generarTablaAmortizacion($aForm = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx, $DSN;

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    unset($_SESSION['ARRAY_TABLA_AMORTIZACION']);
    $idempresa = $_SESSION['U_EMPRESA'];

    $montoInicial = $aForm['monto'];
    $monto = $aForm['monto'];
    $plazo = $aForm['plazo'];
    $interes = $aForm['interes'];
    $fecha = $aForm['fecha'];
    $empleado_pres = $aForm['empleado_pres'];
    $detalle_pres = $aForm['detalle_pres'];
    $anio_pres = $aForm['anio_pres'];
    $fecha_pres = $aForm['fecha_pres'];
    $mes_pres = $aForm['mes_pres'] - 1;
    $mes_pres2 = $aForm['mes_pres'];
    $sql = "select mes from comercial.mes where codigo = '$mes_pres2'	";
    $mes_pres2 = consulta_string($sql, 'mes', $oCon, '');
    $sql = "select empl_cod_empl, empl_ape_nomb, * from saeempl where
					empl_cod_empr = $idempresa and
					empl_cod_eemp = 'A' and empl_cod_empl='$empleado_pres'
					order by 3";

    $nombre = consulta_string($sql, 'empl_ape_nomb', $oIfx, '');
    if (!empty($interes)) {
        $interes = ($interes / 100) / 12;
    }

    if ($interes == 0) {
        $cuota = round(($monto / $plazo), 2);
    } else {
        $cuota = ($monto * $interes * (pow((1 + $interes), ($plazo)))) / ((pow((1 + $interes), ($plazo))) - 1);
    }




    try {
        $sHtml .= '<table class="table table-bordered table-hover table-striped table-condensed" style="width: 80%; margin-bottom: 1px; border:1px solid black; border-radius: 5px; margin-top:10px" align="center">';
        $sHtml .= '<tr>';
        $sHtml .= '<td style="width:100%;font-size:15px; text-align: center; border-right:0px solid; border-bottom:1px solid " colspan="6" align="center">TABLA DE AMORTIZACION</td>';
        $sHtml .= '</tr>';
        $sHtml .= '<tr >';
        $sHtml .= '<td  style="width:5%;font-size:12px; text-align: left; border-right:1px solid; border-bottom:1px solid ">No.</td>';
        $sHtml .= '<td  style="width:15%;font-size:12px; text-align: left; border-right:1px solid; border-bottom:1px solid ">FECHA</td>';
        $sHtml .= '<td  style="width:15%;font-size:12px; text-align: left; border-right:1px solid; border-bottom:1px solid ">CUOTA</td>';
        $sHtml .= '<td  style="width:15%;font-size:12px; text-align: left; border-right:1px solid; border-bottom:1px solid ">INTERES</td>';
        $sHtml .= '<td  style="width:15%;font-size:12px; text-align: left; border-right:1px solid; border-bottom:1px solid ">AMORTIZACION</td>';
        $sHtml .= '<td  style="width:15%;font-size:12px; text-align: left; border-right:0px solid; border-bottom:1px solid ">SALDO</td>';
        $sHtml .= '</tr>';
        unset($array);
        $totalInteres = 0;
        for ($i = 1; $i <= $plazo; $i++) {

            /*$nuevafecha = strtotime('+30 day', strtotime($fecha)) ;
                $nuevafecha = date ('Y/m/d', $nuevafecha);
                */

            $day = date("d", mktime(0, 0, 0, $mes_pres + 1 + $i, 0, $anio_pres));
            $nuevafecha = date('Y/m/d', mktime(0, 0, 0, ($mes_pres + $i), $day, $anio_pres));

            $interesCalculado = $monto * $interes;
            $amortizacion = $cuota - $interesCalculado;

            $sHtml .= '<tr>';
            $sHtml .= '<td style="width:5%;font-size:12px;  text-align: right; border-right:1px solid; border-bottom:1px solid " align="right">' . $i . '</td>';
            $sHtml .= '<td style="width:15%;font-size:12px; text-align: left; border-right:1px solid; border-bottom:1px solid " align="left">' . $nuevafecha . '</td>';
            $sHtml .= '<td style="width:15%;font-size:12px; text-align: right; border-right:1px solid; border-bottom:1px solid " align="right">' . number_format($cuota, 2, '.', ',') . '</td>';
            $sHtml .= '<td style="width:15%;font-size:12px; text-align: right; border-right:1px solid; border-bottom:1px solid "align="right">' . number_format($interesCalculado, 2, '.', ',') . '</td>';
            $sHtml .= '<td style="width:15%;font-size:12px; text-align: right; border-right:1px solid; border-bottom:1px solid " align="right">' . number_format($amortizacion, 2, '.', ',') . '</td>';

            $monto = $monto - ($cuota - ($monto * $interes));

            $array[] = array($i, $cuota, $interesCalculado, $amortizacion, $monto, $nuevafecha);

            $fecha = $nuevafecha;

            $sHtml .= '<td style="width:15%;font-size:12px; text-align: right; border-right:0px solid; border-bottom:1px solid " align="right">' . number_format($monto, 2, '.', ',') . '</td>';
            $sHtml .= '</tr>';



            $totalInteres += $interesCalculado;
        }

        $granTotal = $montoInicial + $totalInteres;

        $sHtml .= '<tr>';
        $sHtml .= '<td colspan="6" class="bg-danger fecha_letra" align="right">Cuota Fija: ' . number_format($cuota, 2, '.', ',') . '</td>';
        $sHtml .= '</tr>';
        $sHtml .= '<tr>';
        $sHtml .= '<td colspan="6" class="bg-danger fecha_letra" align="right">Interes Total: ' . number_format($totalInteres, 2, '.', ',') . '</td>';
        $sHtml .= '</tr>';
        $sHtml .= '<tr>';
        $sHtml .= '<td colspan="6" class="bg-danger fecha_letra" align="right">Total A Pagar: ' . number_format($granTotal, 2, '.', ',') . '</td>';
        $sHtml .= '</tr>';
        $sHtml .= '</table>';

        $_SESSION['ARRAY_TABLA_AMORTIZACION'] = $array;

        $sql = "select empr_ruc_empr, empr_dir_empr, empr_nom_empr, empr_path_logo from saeempr where empr_cod_empr = $idempresa ";
        if ($oIfx->Query($sql)) {
            $empr_ruc = $oIfx->f('empr_ruc_empr');
            $empr_dir = $oIfx->f('empr_dir_empr');
            $empr_nom = $oIfx->f('empr_nom_empr');
            $empr_path_logo = $oIfx->f('empr_path_logo');
            $empr_nom .= ' ';
        }
        $html = '<table border="0" style="width: 100%; margin-left:50px; margin-top:30px">
				<tr>
				    <td style="font-size:18px; text-align: left"><img src="' . $empr_path_logo . '" width="80""><br></td>
				</tr>
				<tr>
					<td style="width: 100%; font-size:18px; text-align: center"><strong>' . $empr_nom . '</strong></td>
				</tr>
				<tr>
					<td  style="width: 100%; font-size:14px; text-align: center"><strong>DIRECCION:' . $empr_dir . '</strong></td>
				</tr>
				<tr>
					<td style="width: 100%; font-size:14px; text-align: center"><strong>RUC:' . $empr_ruc . '</strong><br><br></td>
				</tr>
				<tr>
					<td style="width: 100%; font-size:14px; text-align: left"><strong>EMPLEADO:</strong>' . $empleado_pres . ' ' . $nombre . '</td>
				</tr>
				<tr>
					<td style="width: 100%; font-size:14px; text-align: left"><strong>CONCEPTO:</strong>' . $detalle_pres . '</td>
				</tr>
				<tr>
					<td style="width: 100%; font-size:14px; text-align: left"><strong>FECHA PRESTAMO:</strong>' . $fecha_pres . '</td>
				</tr>
				<tr>
					<td style="width: 100%; font-size:14px; text-align: left"><strong>MES INICIA PAGO:</strong> ' . $mes_pres2 . '</td>
				</tr>
				</table>';
        $html2 .= '<table style="width:100%; margin-top: 100px" align="center" >
					
					<tr>
						<td style="width:10%"></td>
				    <td style="width:10%; font-size:12px; text-align: center;border-top : 2px solid black;">Ingresado por:<br>' . $usuario . '</td>
						<td style="width:10%;"></td>
						<td style="width:10%;font-size:12px; text-align: center;border-top : 2px solid black;">Aprobado por</td> 
						<td style="width:10%;"></td>	
						<td style="width:10%; font-size:12px; text-align: center;border-top : 2px solid black;">Revisado por:</td> 
						<td style="width:10%;"></td>
						<td style="width:10%; font-size:12px; text-align: center;border-top : 2px solid black;">Recibí Conforme</td> 
						<td style="width:10%;"></td>
					</tr> 
					
					
			</table>';
        $_SESSION['pdf'] = $html . $sHtml . $html2;

        $oReturn->assign("divTablaAmortizacion", "innerHTML", $sHtml);
        $oReturn->assign("cuota", "value", $cuota);
        $oReturn->assign("interesTotal", "value", $totalInteres);
        $oReturn->assign("total", "value", $granTotal);
        $oReturn->assign("montototalp", "value", number_format($granTotal, 2, '.', ','));
    } catch (Exception $e) {
        // rollback
        $oReturn->alert($e->getMessage());
    }


    return $oReturn;
}

function guardar_prestamo($id_empresa, $id_sucursal, $aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oReturn = new xajaxResponse();

    //variables de session
    $user_web = $_SESSION['U_ID'];
    $user_ifx = $_SESSION['U_USER_INFORMIX'];
    $array = $_SESSION['ARRAY_TABLA_AMORTIZACION'];

    //variables de formulario
    $monto = $aForm['monto'];
    $plazo = $aForm['plazo'];
    $interes = $aForm['interes'];
    $fecha = $aForm['fecha'];
    $anio_pres = $aForm['anio_pres'];
    $mes_pres = $aForm['mes_pres'];
    $empleado_pres = $aForm['empleado_pres'];
    $tipo_pres = $aForm['tipo_pres'];
    $fecha_pres = fecha_informix_func($aForm['fecha_pres']);
    $detalle_pres = $aForm['detalle_pres'];
    $id_empresa = $_SESSION['U_EMPRESA'];
    unset($_SESSION['RRHH_EMPL_CAB_PRES']);
    unset($_SESSION['RRHH_EMPL_CAB_PRES_SERIAL']);

    if (count($array) > 0) {
        // TRANSACCIONALIDAD IFX
        try {
            // commit
            $oIfx->QueryT('BEGIN WORK;');

            $sql = "select max(pret_pre_impr) as cont from saepret ";
            $cod_pret = consulta_string_func($sql, 'cont', $oIfx, 0);
            $cod_pret = $cod_pret + 1;

            $serial = '0101000' . $cod_pret;

            // pret_cod_asto
            $sql = "insert into saepret (pret_cod_pret, 	pret_pre_impr, 		pret_cod_empl,		pret_cod_tpre,
										 pret_cod_tcuo,		pret_fec_pret,		pret_mot_pret, 		pret_num_cuot, 
										 pret_tas_pret,		pret_con_pret,      pret_cod_empr )
								values ( '$serial',    		$cod_pret,			'$empleado_pres',	$tipo_pres,
										 'P',				'$fecha_pres',		 $monto,				$plazo,
										 $interes,			'$detalle_pres',    $id_empresa )";
            $_SESSION['RRHH_EMPL_CAB_PRES'] = $sql;
            $_SESSION['RRHH_EMPL_CAB_PRES_SERIAL'] = $serial;
            $oIfx->QueryT($sql);

            foreach ($array as $val) {
                $i = $val[0];
                $cuota = $val[1];
                $interesCalculado = $val[2];
                $amortizacion = $val[3];
                $monto = $val[4];
                $nuevafecha = fecha_informix_func($val[5]);

                $sql = "insert into saecuot ( cuot_num_cuot,		cuot_cod_pret,		cuot_mot_capi,		
											  cuot_est_cuot,		cuot_mot_inte,		cuot_fec_venc) 
									values ( $i,					'$serial',		    $cuota,
											 '0',					$interesCalculado,	'$nuevafecha' ) ";
                $oIfx->QueryT($sql);
            }


            $oIfx->QueryT('COMMIT WORK;');
            $oReturn->alert('Ingresado Correctamente...');

            $oReturn->script('generar_dasi();');
        } catch (Exception $e) {
            // rollback
            $oIfx->QueryT('ROLLBACK WORK;');
            $oReturn->alert($e->getMessage());
            $oReturn->assign("ctrl", "value", 1);
        }
    } else {
        $oReturn->alert('Por favor realice un Diario Contable....');
    }

    return $oReturn;
}


function agrega_modifica_grid_dia_empl($nTipo = 0, $aForm = '', $idempresa = '', $idsucursal, $detalle, $mone_cod, $coti)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $aDataDiar = $_SESSION['aDataGirdDiar'];

    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad'
    );

    $oReturn = new xajaxResponse();

    // VARIABLES
    $empl_cod = $aForm["empleado_pres"];
    $tipo_presta = $aForm["tipo_pres"];

    $sql = "select esem_cod_estr  from saeesem where
					esem_cod_empr = $idempresa and
					esem_cod_empl = '$empl_cod' ";
    $esem_cod_estr = consulta_string_func($sql, 'esem_cod_estr', $oIfx, '');

    $sql = "select estr_cod_padr from saeestr where 
				estr_cod_empr = $idempresa and
				estr_cod_estr = '$esem_cod_estr' ";
    $estr_cod_padr = consulta_string_func($sql, 'estr_cod_padr', $oIfx, '');

    $sql = "SELECT tpre_cod_tpre, tpre_des_tpre,  tpre_cod_rubr,  *  from saetpre where tpre_cod_empr = $idempresa ";
    $tpre_cod_rubr = consulta_string_func($sql, 'tpre_cod_rubr', $oIfx, '');

    $sql = "select  cxru_cod_cuen from saecxru where
				cxru_cod_empr = $idempresa and
				cxru_cod_rubr = '$tpre_cod_rubr'  and
				cxru_cod_estr = '$estr_cod_padr' ";
    $cod_cta = consulta_string_func($sql, 'cxru_cod_cuen', $oIfx, '');

    $sql = "select  cuen_nom_cuen  from saecuen where
                cuen_cod_empr  = $idempresa and
                cuen_cod_cuen  = '$cod_cta' ";
    $nom_cta = consulta_string_func($sql, 'cuen_nom_cuen', $oIfx, '');
    $val_cta = $aForm["montototalp"];

    $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

    if ($mone_cod == $mone_base) {
        $sql = "select pcon_seg_mone from saepcon where pcon_cod_empr = $idempresa ";
        $mone_extr = consulta_string_func($sql, 'pcon_seg_mone', $oIfx, '');

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

    if ($nTipo == 0) {
        // DIARIO
        $cred = 0;
        $deb = $val_cta;

        $contd = count($aDataDiar);
        $aDataDiar[$contd][$aLabelDiar[0]] = floatval($contd);
        $aDataDiar[$contd][$aLabelDiar[1]] = $cod_cta;
        $aDataDiar[$contd][$aLabelDiar[2]] = $nom_cta;
        $aDataDiar[$contd][$aLabelDiar[3]] = '';
        $aDataDiar[$contd][$aLabelDiar[4]] = $coti;

        if ($mone_cod == $mone_base) {
            // moneda local
            $cre_tmp = 0;
            $deb_tmp = 0;
            if ($coti > 0) {
                $cre_tmp = round(($cred / $coti), 2);
            }

            if ($coti > 0) {
                $deb_tmp = round(($deb / $coti), 2);
            }

            $aDataDiar[$contd][$aLabelDiar[5]] = $deb;
            $aDataDiar[$contd][$aLabelDiar[6]] = $cred;
            $aDataDiar[$contd][$aLabelDiar[7]] = $deb_tmp;
            $aDataDiar[$contd][$aLabelDiar[8]] = $cre_tmp;
        } else {
            // moneda extra
            $aDataDiar[$contd][$aLabelDiar[5]] = $deb * $coti;
            $aDataDiar[$contd][$aLabelDiar[6]] = $cred * $coti;
            $aDataDiar[$contd][$aLabelDiar[7]] = $deb;
            $aDataDiar[$contd][$aLabelDiar[8]] = $cred;
        }

        $aDataDiar[$contd][$aLabelDiar[9]] = '';
        $aDataDiar[$contd][$aLabelDiar[10]] = '';
        $aDataDiar[$contd][$aLabelDiar[11]] = '';
        $aDataDiar[$contd][$aLabelDiar[12]] = '';
        $aDataDiar[$contd][$aLabelDiar[13]] = '';
        $aDataDiar[$contd][$aLabelDiar[14]] = '';
        $aDataDiar[$contd][$aLabelDiar[15]] = '';
        $aDataDiar[$contd][$aLabelDiar[16]] = '';
        $aDataDiar[$contd][$aLabelDiar[17]] = $detalle;
        $aDataDiar[$contd][$aLabelDiar[18]] = '';
        $aDataDiar[$contd][$aLabelDiar[19]] = '';
    }

    // DIARIO
    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataDiar;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario", "innerHTML", $sHtml);

    // TOTAL DIARIO
    $oReturn->script("total_diario();");

    $oReturn->script("cerrar_ventana();");
    return $oReturn;
}



function modal_cheque($fecha, $array, $bandera = false)
{
    global $DSN, $DSN_Ifx;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo;
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();


    $oReturn = new xajaxResponse();

    $array = $array[0] . ',' . $array[1] . ',' . $array[2] . ',' . $array[3] . ',' . $array[4] . ',' . $array[5] . ',' . $array[6] . ',' . $array[7] . ',' . $array[8];

    $sesion = session_id();
    $frame = '<iframe src="../comprob_egreso/cheque.php?sesionId=' . $sesion . '&mOp=true&mVer=false&fecha=' . $fecha . '&array=' . $array . '" frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%"></iframe>';



    $modal = '<div id="mostrarmodal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">CHEQUE</h4>
                        </div>
                        <div class="modal-body">';
    $modal .= $frame;
    $modal .= '          </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
             </div>';

    $oReturn->assign("divFormularioCheque", "innerHTML", $modal);

    /*
    $cod_modu3 = $_SESSION['codModu3'];
    if($cod_modu3 == 'FONDOS'){
        $oReturn->script("anadir_dasi();");
    }
    */
    $oReturn->script("abre_modalch();");
    //unset($_SESSION['codModu3']);
    return $oReturn;
}



// MODIFICAR VALOR
function form_modificar_valor($id, $idempresa, $idsucursal, $aForm = '')
{

    global $DSN, $DSN_Ifx;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $fu = new Formulario();
    $fu->DSN = $DSN;

    $oReturn = new xajaxResponse();

    $mone_cod = $aForm['moneda'];
    $sql = "select pcon_mon_base from saepcon where pcon_cod_empr = $idempresa ";
    $mone_base = consulta_string_func($sql, 'pcon_mon_base', $oIfx, '');

    $aDataGrid = $_SESSION['aDataGirdDiar'];

    $opcion = 0;
    $title = '';
    if ($mone_cod != $mone_base) {
        // MONEDA LOCAL
        $debito = $aDataGrid[$id]['Debito Moneda Local'];
        $credito = $aDataGrid[$id]['Credito Moneda Local'];
        $opcion = 1;
        $title = 'MONEDA LOCAL';
    } else {
        // MONEDA EXTRANJERA
        $debito = $aDataGrid[$id]['Debito Moneda Ext'];
        $credito = $aDataGrid[$id]['Credito Moneda Ext'];
        $opcion = 2;
        $title = 'MONEDA EXTRANJERA';
    }

    $fu->AgregarCampoNumerico('debito_mod', 'Debito|left', false, $debito, 100, 100);
    $fu->AgregarCampoNumerico('credito_mod', 'Credito|left', false, $credito, 100, 100);

    $sHtml .= '<table class="table table-striped table-condensed" style="width: 90%; margin-bottom: 0px;" align="center">';
    $sHtml .= '<tr height="20">';
    $sHtml .= '<td>' . $fu->ObjetoHtmlLBL('debito_mod') . '</td>';
    $sHtml .= '<td>' . $fu->ObjetoHtml('debito_mod') . '</td>';
    $sHtml .= '</tr>';
    $sHtml .= '<tr height="20">';
    $sHtml .= '<td>' . $fu->ObjetoHtmlLBL('credito_mod') . '</td>';
    $sHtml .= '<td>' . $fu->ObjetoHtml('credito_mod') . '</td>';
    $sHtml .= '</tr>';
    $sHtml .= '</table>';

    $modal = '<div id="mostrarmodal" class="modal fade" role="dialog" >
                <div class="modal-dialog modal-lg" style="width: 400px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">' . $title . '</h4>
                        </div>
                        <div class="modal-body">';
    $modal .= $sHtml;
    $modal .= '          </div>
                        <div class="modal-footer">
							<div class="btn btn-primary btn-sm" onClick="javascript:procesar( ' . $id . ', ' . $opcion . '  )" >
								<span class="glyphicon glyphicon-cog"></span>
								Procesar
							</div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
             </div>';

    $oReturn->assign("miModal_Diario", "innerHTML", $modal);
    $oReturn->script("abre_modal();");

    return $oReturn;
}


function modificar_valor($id, $opcion, $aForm = '')
{
    global $DSN, $DSN_Ifx;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    $aDataGrid = $_SESSION['aDataGirdDiar'];
    $aLabelDiar = array(
        'Fila',
        'Cuenta',
        'Nombre',
        'Documento',
        'Cotizacion',
        'Debito Moneda Local',
        'Credito Moneda Local',
        'Debito Moneda Ext',
        'Credito Moneda Ext',
        'Modificar',
        'Eliminar',
        'Beneficiario',
        'Cuenta Bancaria',
        'Cheque',
        'Fecha Venc',
        'Formato Cheque',
        'Codigo Ctab',
        'Detalle',
        'Centro Costo',
        'Centro Actividad'
    );

    $idempresa = $aForm['empresa'];
    $idsucursal = $aForm['sucursal'];
    $credito = $aForm['credito_mod'];
    $debito = $aForm['debito_mod'];

    if ($opcion == 1) {
        // MONEDA LOCAL
        $aDataGrid[$id][$aLabelDiar[5]] = $debito;
        $aDataGrid[$id][$aLabelDiar[6]] = $credito;
    } else {
        // MONEDA EXTRANJERA
        $aDataGrid[$id][$aLabelDiar[7]] = $debito;
        $aDataGrid[$id][$aLabelDiar[8]] = $credito;
    }

    $sHtml = '';
    $_SESSION['aDataGirdDiar'] = $aDataGrid;
    $sHtml = mostrar_grid_dia($idempresa, $idsucursal);
    $oReturn->assign("divDiario", "innerHTML", $sHtml);

    // TOTAL DIARIO
    $oReturn->script("total_diario();");

    return $oReturn;
}



// DIGITO DOCUMENTO
function documento_digito($aForm = '')
{
    $oReturn = new xajaxResponse();

    $docu = $aForm['documento'];
    $len = strlen($docu);
    $ceros = cero_mas('0', abs(10 - $len));
    $docu = $ceros . $docu;

    $oReturn->assign("documento", "value", $docu);

    return $oReturn;
}

function genera_pdf_doc($idempresa, $idsucursal, $asto_cod, $ejer_cod, $prdo_cod, $formato)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $DSN_Ifx;

    $oIfxA = new Dbo();
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();
    unset($_SESSION['pdf']);
    $oReturn = new xajaxResponse();

    $tipo = $aForm['documento'];


    $sql = "select asto_cod_modu, asto_tipo_mov, asto_cod_tidu from saeasto where asto_cod_asto='$asto_cod' and asto_cod_ejer=$ejer_cod";
    $tipomov = consulta_string($sql, 'asto_tipo_mov', $oIfx, '');
    $codmodu = consulta_string($sql, 'asto_cod_modu', $oIfx, '');
    $codtidu = consulta_string($sql, 'asto_cod_tidu', $oIfx, '');

    if (empty($tipomov)) {
        $sqlti = "select tidu_tip_tidu from saetidu where tidu_cod_tidu='$codtidu'";
        $tipomov = consulta_string($sqlti, 'tidu_tip_tidu', $oIfx, '');
    }

    if ($tipomov == 'DI') {
        $sql = "select ftrn_ubi_web from saeftrn where ftrn_tip_movi='$tipomov'  and ftrn_cod_ftrn=$formato and ftrn_ubi_web is not null";
        $ubi = consulta_string($sql, 'ftrn_ubi_web', $oIfx, '');
        if (empty($ubi)) {
            $ubi = 'Include/Formatos/comercial/diario.php';
        }
        include_once('../../' . $ubi . '');
        $diario = formato_diario($idempresa, $idsucursal, $asto_cod, $ejer_cod, $prdo_cod);
    } elseif ($tipomov == 'EG') {
        $sql = "select ftrn_ubi_web from saeftrn where ftrn_tip_movi='$tipomov'  and ftrn_cod_ftrn=$formato and ftrn_ubi_web is not null";
        $ubi = consulta_string($sql, 'ftrn_ubi_web', $oIfx, '');
        if (empty($ubi)) {
            $ubi = 'Include/Formatos/comercial/egreso.php';
        }
        include_once('../../' . $ubi . '');

        $diario = formato_egreso($idempresa, $idsucursal, $asto_cod, $ejer_cod, $prdo_cod);
    } elseif ($tipomov == 'IN') {
        $sql = "select ftrn_ubi_web from saeftrn where ftrn_tip_movi='$tipomov'  and ftrn_cod_ftrn=$formato and ftrn_ubi_web is not null";
        $ubi = consulta_string($sql, 'ftrn_ubi_web', $oIfx, '');
        if (empty($ubi)) {
            $ubi = 'Include/Formatos/comercial/ingreso.php';
        }
        include_once('../../' . $ubi . '');
        $diario = formato_ingreso($idempresa, $idsucursal, $asto_cod, $ejer_cod, $prdo_cod);
    }
    $_SESSION['pdf'] = $diario;

    $oReturn->script('generar_pdf()');
    return $oReturn;
}
///// GRIF FORMAS DE PAGO Anticipos
//



function ftrn_tip_movi($aForm = '')
{
    global $DSN_Ifx;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    $idempresa = $_SESSION['U_EMPRESA'];

    $formato = $aForm['formato'];
    $sql = "select ftrn_des_ftrn from saeftrn where 
				ftrn_cod_empr = $idempresa and
				ftrn_cod_ftrn = $formato  ";
    // $oReturn->alert($sql);
    $ftrn_tip_movi = consulta_string_func($sql, 'ftrn_des_ftrn', $oIfx, '');

    $oReturn->assign("ftrn_tip_movi", "value", $ftrn_tip_movi);

    return $oReturn;
}




// --------------------------------------------------------------------------------------
// Modal ordenes de compra del cliente proveedor
// --------------------------------------------------------------------------------------

function cargarModalOc($aForm = '', $cont)
{
    global $DSN, $DSN_Ifx;
    session_start();

    $oIfx = new Dbo();
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oIfxA = new Dbo();
    $oIfxA->DSN = $DSN_Ifx;
    $oIfxA->Conectar();


    $fu = new Formulario;
    $fu->DSN = $DSN;

    $empresa = $aForm['empresa'];
    $sucursal = $aForm['sucursal'];
    $clpv_cod = $aForm['cliente'];

    $anio = substr($aForm['fecha'], 0, 4);
    $idprdo = (substr($aForm['fecha'], 5, 2)) * 1;
    $fecha_ejer = $anio . '-12-31';
    $sql_ejercicio = "SELECT ejer_cod_ejer from saeejer where ejer_fec_finl = '$fecha_ejer' and ejer_cod_empr = $empresa ";
    $idejer = consulta_string($sql_ejercicio, 'ejer_cod_ejer', $oIfx, 1);


    $oReturn = new xajaxResponse();
    $sHtml .= '<div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">ORDENES DE COMPRA DEL CLIENTE/PROVEEDOR</h4>
                        </div>
                        <div class="modal-body">';




    $query_data_oc = "SELECT mi.minv_fmov,     mi.minv_cod_clpv,
                mi.minv_fac_prov, mi.minv_cod_tran, 
                ( select tran_des_tran  from saetran where 
                    tran_cod_tran = mi.minv_cod_tran and
                    tran_cod_empr = $empresa and 
                    tran_cod_modu = 10 ) as tran,
                mi.minv_num_sec, mi.minv_tot_minv, mi.minv_num_comp, 
                mi.minv_est_minv, mi.minv_comp_cont, mi.minv_tran_minv,
                mi.minv_num_prdo, mi.minv_cod_ejer, mi.minv_ser_docu
                from saeminv mi where
                -- mi.minv_fmov between '$fecha_inicio'and '$fecha_fin' and
                mi.minv_cod_empr = $empresa and
                mi.minv_cod_sucu = $sucursal and
                mi.minv_est_minv <> '0'
                and mi.minv_cod_tran like 'OCO%'
                and minv_cod_clpv = $clpv_cod
                order by mi.minv_cod_tran
                ";

    if ($oIfx->Query($query_data_oc)) {
        if ($oIfx->NumFilas() > 0) {

            $sHtml .= '<table id="tbclientes" class="table table-bordered table-hover table-striped table-condensed" style="margin-top: 30px">
                                <thead>
                                    <tr>
                                        <th colspan="30"><h6>LISTA DE ORDENES DE COMPRA DEL PROVEEDOR: ' . $nombre_proveedor . '</h6></th>
                                    </tr>
                                    <tr >
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">No.</td>
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">FECHA</td>
                                        <td class="success" style="width: 5.3%; color: #00859B; font-weight: bold">TRANSACCION</td>
                                        <td class="success" style="width: 3.2%; color: #00859B; font-weight: bold">SECUENCIAL</td>
                                        <td class="success" style="width: 0.2%; color: #00859B; font-weight: bold">ESTABLECIMIENTO</td>
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">FACTURA</td>
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">ORDEN COMPRA</td>
                                        <td class="success" style="width: 2.5%; color: #00859B; font-weight: bold">CLIENTE/PROVEEDOR</td>
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">TOTAL CANTIDAD</td>
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">TOTAL COSTO</td>
                                        <td class="success" style="width: 1%; color: #00859B; font-weight: bold">ESTADO</td>
                                        <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">VISUALIZAR_MOV.</td>
                                    </tr>
                                </thead>
                            <tbody>
                    ';
            $i = 1;

            do {
                $minv_fmov = ($oIfx->f('minv_fmov'));
                $minv_cod_clpv = $oIfx->f('minv_cod_clpv');
                $minv_fac_prov = $oIfx->f('minv_fac_prov');
                $minv_cod_tran = $oIfx->f('minv_cod_tran');
                $minv_secu = $oIfx->f('minv_num_sec');
                $minv_tot = $oIfx->f('minv_tot_minv');
                $minv_cod = $oIfx->f('minv_num_comp');
                $tran_nom = $oIfx->f('tran');
                $minv_est_minv = $oIfx->f('minv_est_minv');
                $minv_est_minv = $oIfx->f('minv_est_minv');
                $minv_num_prdo = $oIfx->f('minv_num_prdo');
                $minv_cod_ejer = $oIfx->f('minv_cod_ejer');
                $asto_cod_asto = $oIfx->f('minv_comp_cont');
                $minv_ser_docu = $oIfx->f('minv_ser_docu');


                $valida_oc_ingresada = "SELECT 
                                            COUNT(*) as contador_dir
                                        FROM 
                                            saedir 
                                        where 
                                            asto_cod_ejer = $idejer 
                                            and dir_cod_cli = $clpv_cod 
                                            and dire_cod_empr = $empresa 
                                            and dire_cod_sucu = $sucursal 
                                            and dir_num_fact = '$minv_secu'
                                            and dir_cod_tran like 'ANT%'";
                $contador_dir = consulta_string($valida_oc_ingresada, 'contador_dir', $oIfxA, 0);



                if (empty($asto_cod_asto)) {
                    $asto_cod_asto = $oIfx->f('minv_tran_minv');
                }

                //query nombre del proveedor
                if (empty($minv_cod_clpv)) {
                    $minv_cod_clpv = 0;
                }

                $sql = "select clpv_nom_clpv from saeclpv where clpv_cod_empr = $empresa and clpv_cod_clpv = $minv_cod_clpv";
                $clpv_nom_clpv = consulta_string($sql, 'clpv_nom_clpv', $oIfxA, '');

                $sql_mov = "SELECT sum(dmov_can_dmov) as cantidad FROM saedmov WHERE dmov_num_comp = $minv_cod; ";
                $total_cantidad = number_format(consulta_string($sql_mov, 'cantidad', $oIfxA, 0), 0);

                //NUMNERO SOLCITUD DE COMPRA
                $sqlcomp = "select d.dmov_cod_pedi, m.minv_cod_pedi from saedmov d, saeminv m where m.minv_num_comp=d.dmov_num_comp and m.minv_num_comp=$minv_cod and m.minv_cod_clpv=$minv_cod_clpv";
                $numsol = intval(consulta_string($sqlcomp, 'dmov_cod_pedi', $oIfxA, 0));
                $orden = '';
                if (empty($numsol)) {
                    $numsol = intval(consulta_string($sqlcomp, 'minv_cod_pedi', $oIfxA, 0));
                }
                if ($numsol == 0) {
                    $numsol = '<span><code>SIN CODIGO</code></span>';
                } else {
                    $sqlsol = "select pedi_carea_pedi from saepedi where pedi_cod_pedi=$numsol";
                    $numsol = consulta_string($sqlsol, 'pedi_carea_pedi', $oIfxA, '');
                    //reporte_orden_compra_cre($serial, 1);
                    $doc = 'ordencompra' . $minv_cod_clpv . $numsol . '.pdf';
                    $ruta2 = "../../Include/archivos/orden_compras/$doc";
                    if (file_exists($ruta2)) {
                        $orden = '<a href="' . $ruta2 . '" target="_blank"><div align="center"> <div class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"><span></div> </div></a>';
                    } else {
                        $orden = '<strong><code>NO GENERADA</code></strong>';
                    }
                }

                $granCantidadTotal += $total_cantidad;

                $total = $dmov_can_dmov * $dmov_cun_dmov;

                $anio = substr($minv_fmov, 0, 4);
                $fecha_ejer = $anio . '-12-31';
                $sql_ejer = "select ejer_cod_ejer from saeejer where ejer_fec_finl = '$fecha_ejer' and ejer_cod_empr = $empresa";
                $idejer = consulta_string($sql_ejer, 'ejer_cod_ejer', $oIfxA, 1);
                $idprdo = (substr($minv_fmov, 5, 2)) * 1;

                if ($sClass == 'off')
                    $sClass = 'on';
                else
                    $sClass = 'off';
                $sHtml .= '<tr height="20" class="' . $sClass . '"
                            onMouseOver="javascript:this.className=\'link\';"
                            onMouseOut="javascript:this.className=\'' . $sClass . '\';">';
                $sHtml .= '<td align="center">' . $i++ . '</td>';
                $sHtml .= '<td align="left">' . $minv_fmov . '</td>';
                $sHtml .= '<td align="left">' . $minv_cod_tran . ' | ' . $tran_nom . ' <br><code>' . $minv_cod . '</code> </td>';
                $sHtml .= '<td align="left">' . $minv_secu . ' | <a href="#" onclick="seleccionaItem(' . $empresa . ', ' . $sucursal . ', ' . $idejer . ', ' . $idprdo . ', \'' . $asto_cod_asto . '\');">' . $asto_cod_asto . '</a></td>';
                $sHtml .= '<td align="left">' . $minv_ser_docu . '</td>';
                $sHtml .= '<td align="left">' . $minv_fac_prov . '</td>';
                $sHtml .= '<td align="left">' . $numsol . ' | ' . $orden . '</td>';
                $sHtml .= '<td align="left">' . $clpv_nom_clpv . '</td>';
                $sHtml .= '<td align="right">' . $total_cantidad . '</td>';
                $sHtml .= '<td align="right">' . number_format($minv_tot, 2) . '</td>';
                $sHtml .= '<td align="right">' . $minv_est_minv . '</td>';





                $sHtml .= '<td style="width: 1%;">
                                <div class="btn btn-success btn-sm" onclick="vista_previa_(\'' . $minv_cod . '\',  \'' . $empresa . '\',  \'' . $sucursal . '\')">
                                    <span class="glyphicon glyphicon-print"><span>
                                </div>';
                if ($contador_dir > 0) {
                    $sHtml .= '<br><label style="color: red">OC ya seleccionada en anticipo</label>';
                } else {
                    $sHtml .= ' <div class="btn btn-primary btn-sm" onclick="seleccionar_oc(\'' . $minv_cod . '\',  \'' . $minv_secu . '\')">
                                    <span class="glyphicon glyphicon-check"><span>
                                </div>';
                }

                $sHtml .= '</td>';
                $i++;
                $granTotal += $minv_tot;
            } while ($oIfx->SiguienteRegistro());
            $sHtml .= "</tbody></table>";
        } else {
            $sHtml = '<span>Sin Datos para mostrar...</span>';
        }
    }
    $oIfx->Free();







    $sHtml .= '             </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>';









    $oReturn->assign("modalOcClpv", "innerHTML", $sHtml);

    return $oReturn;
}

// --------------------------------------------------------------------------------------
// Modal ordenes de compra del cliente proveedor
// --------------------------------------------------------------------------------------





//----------------------------------------------------
// FUNCIONES ADJUNTOS SUEJO4667						//
//----------------------------------------------------

function modal_adjuntos($aForm = '')
{

    //Definiciones
    global $DSN_Ifx, $DSN;

    session_start();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oReturn = new xajaxResponse();

    $ifu = new Formulario;
    $ifu->DSN = $DSN_Ifx;
    //variables de session
    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];

    //variables del formulario
    $idContrato = $aForm['idContrato'];
    $latitud = $aForm['latitud'];
    $longitud = $aForm['longuitud'];
    $abonadoContrato = $aForm['abonadoContrato'];

    try {

        /*  //adjuntos
        $n = 1;
        $sql = "select adjunto 
                    from isp.int_adjuntos 
                    where id_clpv = $id_clpv and
                    id_contrato = $id_contrato and
                    id = $idComprobante";
        if ($oCon->Query($sql)) {
            if ($oCon->NumFilas() > 0) {
                $sHtmlAdjuntos .= '<table class="table table-striped table-bordered table-hover table-condensed" style="width: 100%; margin:0px;">
                <tr><td COLSPAN="2" class="bg-primary">IMAGENES GUARDADAS</td></tr>
                <tr class="info">
                    <td >NUMERO</td>
                    <td >IMAGEN</td>
                </tr>';
                do {
                    $adj = $oCon->f('adjunto');
                    $sHtmlAdjuntos .= '<tr>
                    <td>' . $n . '</td>
                    <td style="cursor:pointer;" onclick="descargar_adjunto(\'' . $adj . '\')"><img src="' . path(DIR_INCLUDE) . 'clases/formulario/plugins/reloj/' . substr($adj, 3) . '" width="50"/></td>
                </tr>';
                    $n++;
                } while ($oCon->SiguienteRegistro());
                $sHtmlAdjuntos .= '</table>';
            }
        }
        $oCon->free();
    */

        $today = date("Y-m-d");
        $sHtml = '<div class="modal-dialog" role="document" style="width: 100%;">
                    <div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
                            <h5 class="text-primary">Adjuntos</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
								
							</div>
						<div class="modal-body" id="classModalBody">
                       
                     


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="thumbnail">
                            <div class="caption">
                                <div class="row">

								<table style="width:100%">
									<tr>
										<td>
											<div class="col-md-12">
												<label for="files">Titulo</label>
												<input type="text" name="titulo_archivo" id="titulo_archivo" class="form-control">
											</div>
										</td>
										<td>
											<div class="col-md-12">
													<div class="input-group-btn">
														<label for="files">Seleecionar archivos</label>
														<input type="file" class="btn btn-primary" name="archivo" id="archivo" multiple accept="image/*,.pdf">
													</div>
											</div>
										</td>
										<td>
											<div class="col-md-12">
												<button type="button" id="btn_adj_2" class="btn btn-primary" onclick="guardarAdjuntos()" style="display:block; float:rigth">
												<i class="glyphicon glyphicon-plus"></i> Agregar</button>
											</div>  
										</td>
									</tr>
								</table>


                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="upload-msg-archivo"></div>
                                    </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12" id="tableAdjuntos" style="max-height: 250px; overflow-y: scroll; margin:10px;">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>   
                </div>
            </div>
			';


        //$sHtml = $sHtmlAdjuntos;




        $sHtml .= '</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						</div>
					
				</div>';
        $oReturn->script("verAdj(0)");
        $oReturn->assign("miModal", "innerHTML", $sHtml);
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}


function guardarAdjuntos($aForm = '')
{
    session_start();
    global $DSN, $DSN_Ifx;

    $oCon = new Dbo();
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    //variables de session
    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];
    $usuario_web = $_SESSION['U_ID'];

    //variables del formulario
    $id_contrato = $aForm['idContrato'];
    $id_clpv = $aForm['clpv_cod'];
    $fecha = date("Y-m-d");
    $fechaServer = date("Y-m-d H:i:s");
    $id_instalacion = $aForm['inst_clpv_id'];
    $archivos = $_SESSION["archivos"];
    $titulo_adj = $aForm['titulo_archivo'];

    $fecha = date("Y-m-d");
    $fechaServer = date("Y-m-d H:i:s");
    $id_instalacion = 0;
    $archivos = $_SESSION["archivos"];

    if (isset($archivos)) {

        try {

            for ($i = 0; $i <= count($archivos); $i++) {

                if (!empty($archivos[$i])) {
                    $adjunto = $archivos[$i];

                    $oCon->QueryT('BEGIN;');


                    $array_prod_serie = $_SESSION['PROD_TRANSFE'];


                    $sql = "INSERT INTO comercial.adjuntos (id_empresa, id_sucursal, ruta, id_clpv, user_web, fecha_server, estado,titulo)
                                                                values($idempresa, $idsucursal, '$adjunto', $id_clpv, $usuario_web, '$fechaServer','PE','$titulo_adj')";
                    $oCon->QueryT($sql);
                    $oCon->QueryT('COMMIT;');
                }
            }

            $num_archivos = count($archivos);

            $oReturn->script("Swal.fire({
                                    type: 'success',
                                    title: 'Exito',
                                    text: 'Se han subido de manera exitosa $num_archivos archivos.'
                                })");

            unset($_SESSION["archivos"]);
            $oReturn->script('verAdj(' . $id_instalacion . ');');
        } catch (Exception $e) {
            $oCon->QueryT('ROLLBACK;');
            $oReturn->alert($e->getMessage());
        }
    } else {
        $oReturn->alert('No existen adjuntos para insertar');
    }

    return $oReturn;
}

function verAdj($aForm = '')
{

    //Definiciones
    global $DSN_Ifx, $DSN;
    session_start();

    $oCon = new Dbo;
    $oCon->DSN = $DSN;
    $oCon->Conectar();

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    //variables de session
    $idempresa = $_SESSION['U_EMPRESA'];
    $idsucursal = $_SESSION['U_SUCURSAL'];
    $id_clpv = $aForm['clpv_cod'];


    try {

        $sHtml .= '';
        $sHtml .= '<table class="table table-condensed table-striped table-bordered table-hover" style="width: 98%;" id="tableAdj">';
        $sHtml .= '<thead><tr>';
        $sHtml .= '<td colspan="2"><h5>ADJUNTOS <small>Reporte Informacion</small></h5></td>';
        $sHtml .= '</tr>';
        $sHtml .= '<tr>';
        $sHtml .= '<td>No.</td>';
        $sHtml .= '<td>Adjunto</td>';
        $sHtml .= '</tr></thead><tbody>';


        $array_prod_serie = $_SESSION['PROD_TRANSFE'];


        $sql = "SELECT ruta from comercial.adjuntos where id_clpv = '$id_clpv' and estado='PE' ";
        //echo $sql;exit;
        $adjuntos = '';
        if ($oCon->Query($sql)) {
            if ($oCon->NumFilas() > 0) {
                do {
                    $adjunto = $oCon->f('ruta');

                    $adjuntos .= $adjunto . ":";
                } while ($oCon->SiguienteRegistro());
            }
        }
        $oCon->Free();


        $data_adjuntos = explode(":", $adjuntos);

        for ($i = 0; $i < count($data_adjuntos); $i++) {
            $num = $i + 1;

            if (!empty($data_adjuntos[$i])) {
                $sHtml .= '<tr>
												<td>' . $num . '</td>
												<td><a href="#" onclick="dowloand(\'' . $data_adjuntos[$i] . '\')">' . $data_adjuntos[$i] . '</a></td>
												</tr>';
            }
        }

        $sHtml .= '</tbody></table>';

        $oReturn->assign("tableAdjuntos", "innerHTML", $sHtml);
        $oReturn->script('initTable(\'tableAdj\');');
    } catch (Exception $e) {

        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}




// --------------------------------------------------------------------
// LETRAS DE CAMBIO AD
// --------------------------------------------------------------------

function abre_modal_canje($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    $empresa = $aForm['empresa'];
    $sucursal = $aForm['sucursal'];
    $val_cta = $aForm['val_cta'];
    $val_cta = str_replace(',', '', $val_cta);

    try {


        $sql = "SELECT 
                        tran_cod_tran, 
                        tran_cod_tran || ' - ' || tran_des_tran || ' - ' || trans_tip_tran AS tran_des_tran 
                    from saetran where
                        tran_cod_empr = $empresa and
                        tran_cod_sucu = $sucursal and
                        tran_cod_modu = 4 order by 2
                ";
        $lista_tran = lista_boostrap_func($oIfx, $sql, $a, 'tran_cod_tran', 'tran_des_tran');

        $html_area_prod = '';
        $html_area_prod .= '

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label for="empresa">* Fecha Canje Letras:</label>
                                            <input type="date" class="form-control input-sm" placeholder="Descripcion Variable" id="fecha_cuota_letrac" name="fecha_cuota_letrac" value="' . date('Y-m-d') . '" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="empresa">* Tipo:</label>
                                            <select id="tipo_letrac" name="tipo_letrac" class="form-control input-sm">
                                                <option value="0">Seleccione una opcion..</option>
                                                ' . $lista_tran . '
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="empresa">* Dias Cuota:</label>
                                            <input type="number" class="form-control input-sm" placeholder="Descripcion Variable" id="dias_cuota_letrac" name="dias_cuota_letrac" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="empresa">* Cuotas:</label>
                                            <input type="number" class="form-control input-sm" placeholder="Descripcion Variable" id="cuota_letrac" name="cuota_letrac" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="empresa">* Monto:</label>
                                            <input type="number" class="form-control input-sm" placeholder="Descripcion Variable" id="monto_letrac" name="monto_letrac" value="' . $val_cta . '" readonly />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div style="text-align: center">
                                    <div id ="imagen1" class="btn btn-primary btn-sm" onclick="procesar_letras();" style="margin-top: 20px">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>
                                        Procesar
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-12"> 
                                    <div id="div_data_letras" name="div_data_letras"></div>
                                </div>

                            </div>

                            ';



        $modal = '<div id="mostrarModalLera" class="modal fade" role="dialog">
                 <div class="modal-dialog modal-lg" style="width:1100px;">
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title"><b>CANJE DE LETRAS</b></h4>
                         </div>
                         <div class="modal-body">';
        $modal .= $html_area_prod;
        $modal .= '          </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                         </div>
                     </div>
                 </div>
              </div>';

        $oReturn->assign("divFormularioModalLetra", "innerHTML", $modal);
        $oReturn->script("abre_modal_letra();");


        //
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}

function procesar_letras($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    $empresa = $aForm['empresa'];
    $sucursal = $aForm['sucursal'];

    $fecha_cuota_letrac = $aForm['fecha_cuota_letrac'];
    $dias_cuota_letrac = $aForm['dias_cuota_letrac'];
    $cuota_letrac = $aForm['cuota_letrac'];
    $monto_letrac = $aForm['monto_letrac'];

    try {


        $sHtml = '';
        $sHtml .= '
                    <table id="tbclientes" class="table table-bordered table-hover table-striped table-condensed" style="margin-top: 30px">
                        <thead>
                            <tr >
                                <td class="success" style="width: 1.5%; color: #00859B; font-weight: bold">N.-</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Fecha</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Dias Cuota</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Fecha Final</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Porcentaje</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Valor</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Serie Doc.</td>
                                <td class="success" style="width: 4.5%; color: #00859B; font-weight: bold">Nro Documento</td>
                            </tr>
                        </thead>
                        <tbody>';




        $fecha_dias = $fecha_cuota_letrac;
        $porcentaje_cuotas = round(100 / $cuota_letrac, 2);
        $valor_cuota = round($monto_letrac / $cuota_letrac, 2);

        $suma_dias = 0;
        $suma_porcentaje = 0;
        $suma_valor_pagar = 0;

        $suma_porcentaje2 = 0;
        $suma_valor_pagar2 = 0;

        for ($x = 1; $x <= $cuota_letrac; $x++) {

            $suma_dias += $dias_cuota_letrac;
            $suma_porcentaje += $porcentaje_cuotas;
            $suma_valor_pagar += $valor_cuota;

            if ($x == $cuota_letrac) {
                if ($suma_porcentaje > 100) {
                    $diferencia = $suma_porcentaje - 100;
                    $porcentaje_cuotas = round($porcentaje_cuotas - $diferencia, 2);
                } else if ($suma_porcentaje < 100) {
                    $diferencia = 100 - $suma_porcentaje;
                    $porcentaje_cuotas = round($porcentaje_cuotas + $diferencia, 2);
                }

                if ($suma_valor_pagar > $monto_letrac) {
                    $diferencia_val = $suma_valor_pagar - $monto_letrac;
                    $valor_cuota = round($valor_cuota - $diferencia_val, 2);
                } else if ($suma_valor_pagar < $monto_letrac) {
                    $diferencia_val = $monto_letrac - $suma_valor_pagar;
                    $valor_cuota = round($valor_cuota + $diferencia_val, 2);
                }
            }


            $suma_porcentaje2 += $porcentaje_cuotas;
            $suma_valor_pagar2 += $valor_cuota;


            $fecha_dias = date("Y-m-d", strtotime($fecha_dias . "+ $dias_cuota_letrac days"));

            /*
            $sHtml .= '<tr>
                                       <td style="width: 1.5%;">' . $x . '</td> 
                                       <td style="width: 1.5%;">' . $fecha_cuota_letrac . '</td>
                                       <td style="width: 1.5%;">' . $dias_cuota_letrac . '</td>
                                       <td style="width: 1.5%;">' . $fecha_dias . '</td>
                                       <td style="width: 1.5%;">' . $porcentaje_cuotas . '%</td>
                                       <td style="width: 1.5%;">' . $valor_cuota . '</td>
                                       <td style="width: 1.5%;">
                                            <input type="number" id="serie_letrac_' . $x . '" name="serie_letrac_' . $x . '" class="form-control input-sm" onchange="validar_ceros_serie(' . $x . ')" />
                                       </td>
                                       <td style="width: 1.5%;">
                                            <input type="number" id="documento_letrac_' . $x . '" name="documento_letrac_' . $x . '" class="form-control input-sm" onchange="validar_ceros(' . $x . ')" />
                                       </td>

                                   </tr>';
                                   */
            $sHtml .= '<tr>
                                       <td style="width: 1.5%;">' . $x . '</td> 
                                       <td style="width: 1.5%;">' . $fecha_cuota_letrac . '</td>
                                       <td style="width: 1.5%;">' . $dias_cuota_letrac . '</td>
                                       <td style="width: 1.5%;">
                                            <input type="date" id="fecha_fin_' . $x . '" name="fecha_fin_' . $x . '" class="form-control input-sm" value="' . $fecha_dias . '" onchange="recalcular_valor_total(' . $x . ')" />
                                       </td>
                                       <td style="width: 1.5%;">
                                            <input type="number" id="porcentaje_cuota_' . $x . '" name="porcentaje_cuota_' . $x . '" class="form-control input-sm" value="' . $porcentaje_cuotas . '" readonly />
                                       </td>
                                       <td style="width: 1.5%;">
                                            <input type="number" id="valor_cuota_' . $x . '" name="valor_cuota_' . $x . '" class="form-control input-sm" value="' . $valor_cuota . '" onchange="recalcular_valor_total(' . $x . ')" />
                                       </td>
                                       <td style="width: 1.5%;">
                                            <input type="text" id="serie_letrac_' . $x . '" name="serie_letrac_' . $x . '" class="form-control input-sm" onchange="validar_ceros_serie(' . $x . ')" />
                                       </td>
                                       <td style="width: 1.5%;">
                                            <input type="number" id="documento_letrac_' . $x . '" name="documento_letrac_' . $x . '" class="form-control input-sm" onchange="validar_ceros(' . $x . ')" />
                                       </td>
                                       
                                   </tr>';
        }





        $sHtml .= '         <tr>
                                <td style="width: 1.5%; font-size: 15px">TOTALES</td> 
                                <td style="width: 1.5%; font-size: 15px"></td>
                                <td style="width: 1.5%; font-size: 15px">' . $suma_dias . '</td>
                                <td style="width: 1.5%; font-size: 15px"></td>
                                <td style="width: 1.5%; font-size: 15px"><div id="div_totales_cuota1" name="div_totales_cuota1">' . $suma_porcentaje2 . '%</div></td>
                                <td style="width: 1.5%; font-size: 15px"><div id="div_totales_cuota2" name="div_totales_cuota2">' . $suma_valor_pagar2 . '</div></td>
                                <td style="width: 1.5%; font-size: 15px"></td>
                                <td style="width: 1.5%; font-size: 15px"></td>
                                <input type="number" id="dias_cuotas_fp_input" name="dias_cuotas_fp_input" value="' . $dias_cuotas_fp . '" style="display: none" />
                                <input type="number" id="cuotas_fp_input" name="cuotas_fp_input" value="' . $cuotas_fp . '" style="display: none" />
                                <input type="date" id="fecha_inicio_input" name="fecha_inicio_input" value="' . $fecha_inicio . '" style="display: none" />
                                <input type="number" id="valor_input" name="valor_input" value="' . $valor . '" style="display: none" />
                                
                            </tr>';




        $sHtml .= '
                    </tbody>
                </table>
            ';


        $sHtml .= '

                        <div style="text-align: center">
                            <div id ="imagen1" class="btn btn-success btn-sm" onclick="agregar_canje_letra();" style="margin-top: 20px">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                                Agregar Canje Letra
                            </div>
                        </div>

                    ';


        $oReturn->assign("div_data_letras", "innerHTML", $sHtml);


        //
    } catch (Exception $e) {
        $oReturn->alert($e->getMessage());
    }

    return $oReturn;
}

function agregar_canje_letra($aForm = '')
{
    //Definiciones
    global $DSN_Ifx, $DSN;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $oIfx = new Dbo;
    $oIfx->DSN = $DSN_Ifx;
    $oIfx->Conectar();

    $oReturn = new xajaxResponse();

    $empresa = $aForm['empresa'];
    $sucursal = $aForm['sucursal'];

    $fecha_cuota_letrac = $aForm['fecha_cuota_letrac'];
    $tipo_letrac = $aForm['tipo_letrac'];
    $dias_cuota_letrac = $aForm['dias_cuota_letrac'];
    $cuota_letrac = $aForm['cuota_letrac'];
    $monto_letrac = $aForm['monto_letrac'];

    try {



        $sql_tran = "SELECT tran_cod_cuen, trans_tip_tran
                    from saetran where
                        tran_cod_empr = $empresa and
                        tran_cod_sucu = $sucursal and
                        tran_cod_tran = '$tipo_letrac' and
                        tran_cod_modu = 4
                ";

        $tran_cod_cuen = '';
        $trans_tip_tran = '';
        if ($oIfx->Query($sql_tran)) {
            if ($oIfx->NumFilas() > 0) {
                do {
                    $tran_cod_cuen = $oIfx->f('tran_cod_cuen');
                    $trans_tip_tran = $oIfx->f('trans_tip_tran');
                } while ($oIfx->SiguienteRegistro());
            }
        }
        $oIfx->Free();

        if (empty($tran_cod_cuen)) {
            throw new Exception('Transaccion no tiene cuenta contable. Configure la cuenta en: Configuracion/Cuentas por Pagar/Mestro de Transaccion');
        }

        $sql_nombre_cuenta = "SELECT cuen_nom_cuen FROM saecuen where cuen_cod_cuen = '$tran_cod_cuen' and cuen_cod_empr = $empresa";
        $cuen_nom_cuen = consulta_string_func($sql_nombre_cuenta, 'cuen_nom_cuen', $oIfx, '');

        $fecha_dias = $fecha_cuota_letrac;
        $porcentaje_cuotas = round(100 / $cuota_letrac, 2);
        $valor_cuota = round($monto_letrac / $cuota_letrac, 2);

        $suma_dias = 0;
        $suma_porcentaje = 0;
        $suma_valor_pagar = 0;

        $suma_porcentaje2 = 0;
        $suma_valor_pagar2 = 0;

        for ($x = 1; $x <= $cuota_letrac; $x++) {

            $suma_dias += $dias_cuota_letrac;
            $suma_porcentaje += $porcentaje_cuotas;
            $suma_valor_pagar += $valor_cuota;

            if ($x == $cuota_letrac) {
                if ($suma_porcentaje > 100) {
                    $diferencia = $suma_porcentaje - 100;
                    $porcentaje_cuotas = round($porcentaje_cuotas - $diferencia, 2);
                } else if ($suma_porcentaje < 100) {
                    $diferencia = 100 - $suma_porcentaje;
                    $porcentaje_cuotas = round($porcentaje_cuotas + $diferencia, 2);
                }

                if ($suma_valor_pagar > $monto_letrac) {
                    $diferencia_val = $suma_valor_pagar - $monto_letrac;
                    $valor_cuota = round($valor_cuota - $diferencia_val, 2);
                } else if ($suma_valor_pagar < $monto_letrac) {
                    $diferencia_val = $monto_letrac - $suma_valor_pagar;
                    $valor_cuota = round($valor_cuota + $diferencia_val, 2);
                }
            }

            $suma_porcentaje2 += $porcentaje_cuotas;
            $suma_valor_pagar2 += $valor_cuota;

            $fecha_dias = date("Y-m-d", strtotime($fecha_dias . "+ $dias_cuota_letrac days"));

            $numero_factura = $aForm['serie_letrac_' . $x] . '-' . $aForm['documento_letrac_' . $x];
            $valor_cuota = $aForm['valor_cuota_' . $x];

            $oReturn->assign("tran", "value", $tipo_letrac);
            $oReturn->assign("det_dir", "value", 'CANJE DE LETRAS');
            $oReturn->assign("factura", "value", $numero_factura);
            $oReturn->assign("fact_valor", "value", $valor_cuota);

            $oReturn->script("anadir_dir();");

            /*
            $sHtml .= '<tr>
                                       <td style="width: 1.5%;">' . $x . '</td> 
                                       <td style="width: 1.5%;">' . $fecha_cuota_letrac . '</td>
                                       <td style="width: 1.5%;">' . $dias_cuota_letrac . '</td>
                                       <td style="width: 1.5%;">' . $fecha_dias . '</td>
                                       <td style="width: 1.5%;">' . $porcentaje_cuotas . '%</td>
                                       <td style="width: 1.5%;">' . $valor_cuota . '</td>

                                   </tr>';
                                   */
        }


        /*
        $oReturn->assign("cod_cta", "value", $tran_cod_cuen);
        $oReturn->assign("nom_cta", "value", $cuen_nom_cuen);
        $oReturn->assign("detalla_diario", "value", 'CANJE DE LETRAS');
        $oReturn->assign("crdb", "value", $trans_tip_tran);
        $oReturn->assign("val_cta", "value", $monto_letrac);
        $oReturn->script("anadir_dasi();");
        */

        $oReturn->script("cierra_modal_letra();");

        $oReturn->script("Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Letras de cambio agregadas correctamente...!',
                                showConfirmButton: true,
                                confirmButtonText: 'Aceptar',
                                timer: 2000
                            })");


        //
    } catch (Exception $e) {
        $oReturn->script("Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: '" . $e->getMessage() . "',
                                showConfirmButton: true,
                                confirmButtonText: 'Aceptar',
                                timer: 20000
                            })");
    }

    return $oReturn;
}


// --------------------------------------------------------------------
// FIN LETRAS DE CAMBIO AD
// --------------------------------------------------------------------




/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/* PROCESO DE REQUEST DE LAS FUNCIONES MEDIANTE AJAX NO MODIFICAR */
$xajax->processRequest();
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
