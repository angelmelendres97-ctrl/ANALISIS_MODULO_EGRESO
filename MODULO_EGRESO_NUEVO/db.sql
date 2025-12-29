//CONSULTA PARA TRAER LAS FACTURAS DEL PROVEEDOR

SELECT
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