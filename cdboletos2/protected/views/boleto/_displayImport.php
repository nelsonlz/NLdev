<?php



$aDados = $_POST['Dados'];
$aClientes = unserialize($_POST['clientes']);
$aContas = unserialize($_POST['contas']);
$empresa_id = $_POST['empresa_id'];
$Contratante_id = $_POST['contratante_id'];
$filial_id = $_POST['filial_id'];



if($_POST['opc']== 1){
    
    $aContas =  unserialize($_POST['contas']);

    $aCod = '<div id="tbImportBeletoHead" style="display:table;box-shadow: 0 0.3em 0.2em; z-index:99;">';
    $aCod .= '<div style="float:left; width:80px;text-align:center;" >Boleto</div>';
    $aCod .= '<div style="float:left; width:130px;  text-align:center;">Cliente</div>';
    $aCod .= '<div style="float:left; width:170px;  text-align:center;">Conta</div>';
    $aCod .= '<div style="float:left; width:100px;  text-align:center; ">Vencimento</div>';
    $aCod .= '<div style="float:left; width:90px;  text-align:center; ">Emissão</div>';
    $aCod .= '<div style="float:left; width:120px;  text-align:center; ">Valor Boleto</div>';
    $aCod .= '<div style="float:left; width:120px;  text-align:center; ">Valor Bruto</div>';
    $aCod .= '</div>';
    $aCod .= '<div id="tbImportBoleto" style="height:500px; overflow: auto; box-shadow:0 0.2em 0.2em black">';
    for($nI = 0; $nI <= count($aDados); $nI++ ){
            if(!$aDados[$nI])
                            continue;
            $tmp = explode(",",$aDados[$nI]);

                     $aCliente =$aClientes[$tmp[1]];
            $aConta = $aContas[$tmp[2]];
            if($nI  % 2 == 0)
                            $aCod .= '<div class="tlinha" style="height:22px;  border-bottom:solid 1px black; padding:5px; background-color:#D1D3D4">';
            else
                            $aCod .= '<div class="tlinha" style="height:22px;  border-bottom:solid 1px black; padding:5px;">';
            $aCod .= '<div style="float:left;width:80px;text-align:center; font-size:12px; color:blue;" ><b>'.$tmp[0].'</b></div>';
            $aCod .= '<div style="float:left;width:120px;text-align:center;font-size:12px;">'.substr($aCliente,0,16).'...</div>';
            $aCod .= '<div style="float:left;width:170px;text-align:center;font-size:12px;"><b>'.$aConta.'</b></div>';
            $tData = explode('-',str_replace('"',"",$tmp[3]));
            $aData =$tData[2]."-".$tData[1]."-".$tData[0];
            stripslashes($aData);
            $aCod .= '<div style="float:left;width:100px;text-align:center; font-size:12px; color:green;" >'.$aData.'</div>';
            $tData = explode('-',str_replace('"',"",$tmp[4]));
            $aData = $tData[2]."-".$tData[1]."-".$tData[0];
            stripslashes($aData);
            $aCod .= '<div style="float:left;width:95px;text-align:center; font-size:12px;" >'.$aData.'</div>';
            $aCod .= '<div style="float:left;width:120px;text-align:center; font-size:12px;" >'.$tmp[6].'</div>';
            $aCod .= '<div style="float:left;width:100px;text-align:center; font-size:12px;" >'.$tmp[7].'</div>';
            $aCod .= '</div>';
    }
}
if($_POST['opc'] == 2){
    
    $tmp = explode("\n",$aDados);
    $con = mysql_connect('localhost', 'root', 'master').
    mysql_select_db('CdBoletoNovo',$con);
    
    $aCod = "";
    
    
    for($i = 0; $i <= count($tmp)-1; $i++){
        
        $col = explode(",", $tmp[$i]);
        
        if($aClientes[$col[1]][0] != null && $aContas[$col[2]] != null)
        {
            
            $query = "select ID from CdBoletoNovo.Cd_Boleto WHERE 
                                                                                                            ID = ".$col[0]." AND 
                                                                                                            Contratante_id = ".$Contratante_id." AND
                                                                                                            Empresa_id = ".$empresa_id." AND 
                                                                                                            Filial_id = ".$filial_id." AND
                                                                                                            Cliente_id = ".$col[1]." AND 
                                                                                                            Conta_id = ".$col[2]." LIMIT 1 ";
            $result = mysql_query($query);
            $aux = mysql_fetch_array($result);
            
            if(!$aux){
             mysql_free_result($result);
             
             $Link = $Contratante_id.'|'.$empresa_id.'|'.$filial_id.'|'.$col[0].'|'.$col[2];
             $cript = md5($Link);
             
            $query = "INSERT INTO CdBoletoNovo.Cd_Boleto (ID, 
                                                                                                  Contratante_id,
                                                                                                  Empresa_id, 
                                                                                                  Filial_id, 
                                                                                                  Cliente_id, 
                                                                                                  Conta_id, 
                                                                                                  Vencimento,
                                                                                                  Emissao, 
                                                                                                  Consulta, 
                                                                                                  ValorNominal, 
                                                                                                  ValorPago, 
                                                                                                  Desconto, 
                                                                                                  Detalhe, 
                                                                                                  EnvioEmail,
                                                                                                  DataPagamento, 
                                                                                                  aLink) 
                                                                                                VALUES (
                                                                                                ".$col[0].", 
                                                                                                ".$Contratante_id.", 
                                                                                                ".$empresa_id.", 
                                                                                                ".$filial_id.", 
                                                                                                ".$col[1].", 
                                                                                                ".$col[2].", 
                                                                                                ".$col[3].", 
                                                                                                ".$col[4].", 
                                                                                                NULL,
                                                                                                ".$col[6].",  
                                                                                                NULL,
                                                                                                NULL,
                                                                                                ".$col[8].", 
                                                                                                NULL,
                                                                                                NULL,
                                                                                                '".$cript."')";
            
                    $result = mysql_query($query);
                    if($result){
                        $aCod .= "Boleto ".$col[0]." importado com sucesso! <br>";
                    }
                    else
                        $aCod .="".$query."<br>";
                    
        }else{
                  $aCod .= "Boleto ".$col[0]." Ja existe para esta conta ".$col[2]." e cliente ".$aClientes[$col[1]][0]."<br>";
                  
        }
            
        }
        else
            $aCod .= '<br>erro';
        
        
        
        mysql_free_result($result);
    }
    mysql_close($con);  
}


echo $aCod;
?>

