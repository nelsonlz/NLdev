<?php

//$this->layout = null;

?>



<script type="text/javascript">
    
    
    
    function trigger_click(){
        $('#mprint').trigger('click');
    }
</script>

<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'title',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Print',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Print Results',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#containerBoleto',        //the element to be printed.
          'exceptions' => array(       //the element/s which will be ignored
              '.summary',
              '.search-form'
          ),
          'publishCss' => true,       //publish the CSS for the whole page?
      ));
?>

<?php

Yii::app()->clientScript->registerScript('esconde_print', "
    $('#mprint').hide();
");


$this->menu=array(
array('label' => 'Imprimir Boleto','icon'=>'print', 'url' => '#','active'=>true, 'linkOptions'=>array('onclick'=>'javascript: trigger_click()')),
);
?>

<?php

    $aConta = Conta::model()->findByPk($model->Conta_id);
    $aBanco = Banco::model()->findByPk($aConta->Banco_id);
    $aCliente = Cliente::model()->findByPk($model->Cliente_id);
    $aEmpresa = Empresa::model()->findByPk($model->Empresa_id);
    
    if($model->Filial_id > 0){
        $aFilial = Filial::model()->findByPk($model->Filial_id);
    }
        
        ?>

<!--Cria Array que armazena dados fundamentais para confeção do boleto-->
<?php 

        $valor_cobrado = $model->ValorNominal;
        $valor_cobrado = (float)str_replace(",", ".",$valor_cobrado);
        $percent       = ((float)str_replace(",", ".",$aConta->Juros))/100;  //Percentual que vai ser cobrado dos juros
        $juros         =  (($valor_cobrado *  $percent)/30);  //Valor do Juros Diario
        $juros         = str_replace(",", ".",$juros); //trocar o "." por "," no valor juros
        $juros         = number_format($juros, 2, ',', ''); //valor com duas casas pos a virgula.
        
        $valor_boleto  = number_format($valor_cobrado, 2, ',', '');
        $paData = str_replace(".", "/", $model->Vencimento);
        $aDadosboleto["data_vencimento"] = $paData; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
        $aDadosboleto["data_documento"] = $model->Emissao; // Data de emiss�o do Boleto
        $aDadosboleto["data_processamento"] = $model->Emissao; // Data de processamento do boleto (opcional)
        $aDadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
        $aDadosboleto['sacado']    = $aCliente->Nome;
        $aDadosboleto['endereco1'] = $aCliente->Endereco;
        $aDadosboleto['endereco2'] = $aCliente->Bairro;
        
        //---------- DETALHES ------------------
        $paDet = explode(";",$model->Detalhe);
            
        $aCod = '<table id="detalhe" border="0" cellpadding="2" cellspacing="0" width=666>';
        $aCod .= '<thead style="text-align:center;">';
        $aCod .= '<td>Codigo</td><td>Evento</td><td>Descrição</td><td>Valor</td>';
        $aCod .= '</thead>';
        for ($i=0;$i<count($paDet) && $i < 5 ;$i++) {
            $aTmp = explode("|",$paDet[$i]);
            if(count($aTmp) > 1){
                $aCod .= "<tr>";
            for($y = 0; $y < count($aTmp); $y++)
            {
                $aCod .= "<td style=' text-align:center;'>".$aTmp[$y]."</td>";
            }
            $aCod .="</tr>";
            }
        }
        $aCod .= "</table>";
        $aDadosboleto['demonstrativo1'] = $aCod;
        
        //---------------------------------------------------
        $Desc = $model->Desconto;
        if($Desc>0.00){
            $Desc = str_replace(",", ".",$Desc);
            $Desc=number_format($Desc, 2, ',', '');  //Converte o Valor do BAnco para duas casas apos a virgula
            $msgDesc = "Desconto de R$ $Desc para pagamento ate vencimento."; //Mensagem de Desconto
        }else{
            $msgDesc = "";
        }
        
        // ----------- INSTRU��ES -------------------------------
        
            $aTmp = $aConta->Instrucoes;
            $aTmp = preg_replace('/\[JUROS\]/',$juros,$aTmp);
            $aInstrucoes = explode("\n",$aTmp);
            $aDadosboleto['instrucoes1'] = $aInstrucoes[0];
            if(count($aInstrucoes) > 1)
                $aDadosboleto['instrucoes2'] = $aInstrucoes[1];
            else
                $aDadosboleto['instrucoes2'] = " ";
            if(count($aInstrucoes) > 2)
                $aDadosboleto['instrucoes3'] = $aInstrucoes[2];
            else
                $aDadosboleto['instrucoes3'] = " ";
            if(count($aInstrucoes) > 3)
                $aDadosboleto['instrucoes4'] = $aInstrucoes[3];
            else
                   $aDadosboleto['instrucoes4'] = " ";
        
        
        //-------------------------------------------------------
        
        $aDadosboleto['cedente']  = $aEmpresa->Nome;
        $aDadosboleto['cpf_cnpj'] = $aEmpresa->CNPJ;
        if($model->Filial_id > 0){
            $aDadosboleto['identificacao'] = $aFilial->ID;
            $aDadosboleto['endereco']      = $aFilial->Endereco;
            $aDadosboleto['cidade_uf']     = $aFilial->Cidade."/".$aFilial->UF;
        }
        else{
            $aDadosboleto['identificacao'] = $aEmpresa->ID;
            $aDadosboleto['endereco']      = $aEmpresa->Endereco;
            $aDadosboleto['cidade_uf']     = $aEmpresa->Cidade."/".$aEmpresa->UF;
        }
        
        
        $aDadosboleto["nosso_numero"] =  $model->ID;
        $aDadosboleto["numero_documento"] = $model->xnNumberFormat($model->ID,9,0);

        //Dados opcionais de acordo com o banco do cliente
        $aDadosboleto['quantidade']    = "";
        $aDadosboleto['valor_unitario']= "";
        $aDadosboleto["aceite"]        = $aConta->Aceite; //obs = ver onde colocar campo aceite
        $aDadosboleto["especie"]       = $aConta->Especie; //obs = ver onde colocar especie
        //
        //
        //OBS = ALTERAR TABELA CONTA PARA COLETAR DADO ESPECIE DOC
        $aDadosboleto['especie_doc']   = 'DM';//obs ver onde colocar campo especie doc
        
        $aDadosboleto['nBancoCentral'] =  $model->xnNumberFormat($aBanco->NumeroBancoCentral,3,0);
        
        $aDadosboleto['nMoeda'] = $aConta->CodigoMoeda;
        
        $aDadosboleto['carteira'] = $aConta->NumeroCarteira;
        
        $aDadosboleto['agencia'] = $aConta->Agencia;
        
        $aDadosboleto['conta'] = $aConta->CC;
        
        



?>




<?php 
    
if($aBanco->NumeroBancoCentral == '341')
    echo $this->renderPartial('_boletoITAU', array('model'=>$model,'aDadosboleto'=>$aDadosboleto)); 
    
?>


