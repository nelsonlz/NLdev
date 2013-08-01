




<?php 

//        /*
//            #################################################
//            DESENVOLVIDO PARA CARTEIRA 18
//
//            - Carteira 18 com Convenio de 8 digitos
//              Nosso número: pode ser at� 9 d�gitos
//
//            - Carteira 18 com Convenio de 7 digitos
//              Nosso número: pode ser at� 10 d�gitos
//
//            - Carteira 18 com Convenio de 6 digitos
//              Nosso número:
//              de 1 a 99999 para op��o de at� 5 d�gitos
//              de 1 a 99999999999999999 para op��o de at� 17 d�gitos
//
//            #################################################
//        */
        
        $aDadosboleto["codigo_banco_com_dv"] = $model->xnGeraCodigoBanco($aDadosboleto['nBancoCentral']);
        $nummoeda = $aDadosboleto['nMoeda'];
        $nnum  = $model->xnNumberFormat($aDadosboleto["nosso_numero"],8,0);
        $valor = $model->xnNumberFormat($aDadosboleto["valor_boleto"],10,0,"valor");
        
         $codigo_barras = $aDadosboleto['nBancoCentral']
                         .$nummoeda
                         .$model->xnFatorVencimento($aDadosboleto['data_vencimento'])
                         .$valor
                         .$aDadosboleto['carteira']
                         .$nnum
                         .$model->modulo_10($aDadosboleto['agencia'].
                                              $aDadosboleto['conta'].
                                               $aDadosboleto['carteira']
                                               .$nnum)
                         .$aDadosboleto['agencia']
                         .$aDadosboleto['conta']
                         .$model->modulo_10($aDadosboleto['agencia']
                                              .$aDadosboleto['conta'])
                         .'000';

//        // 43 numeros para o calculo do digito verificador
        $dv = $model->xnDigitoVerificadorBarraItau($codigo_barras);
//         Numero para o codigo de barras com 44 digitos
        $linha = substr($codigo_barras,0,4)
                 .$dv
                 .substr($codigo_barras,4,43);
//
        $nossonumero    = $aDadosboleto["carteira"].'/'.$nnum.'-'. $model->modulo_10($aDadosboleto['agencia'].$aDadosboleto['conta'].$aDadosboleto["carteira"].$nnum);
        $agencia_codigo = $aDadosboleto['agencia']." / ". $aDadosboleto['conta']."-".$model->modulo_10($aDadosboleto['agencia'].$aDadosboleto['conta']);
//
        $aDadosboleto['codigo_barras'] = $linha;
        $aDadosboleto['linha_digitavel'] = $model->xaMontaLinhaDigitavelItau($linha);
        $aDadosboleto['agencia_codigo'] = $agencia_codigo;
        $aDadosboleto['nosso_numero'] = $nossonumero;
        $aDadosboleto['DesenhoCodBarras'] = $model->xaBarCode($aDadosboleto['codigo_barras']);
        
        

?>

<div id="containerBoleto">
    
 <?php 
 
 Yii::app()->clientScript->registerCss(1, 
"
    #containerBoleto
    {
        margin:0 auto;
        padding: 0;
        overflow: auto; 
        height:550px;
        border-radius:0.5em;
    }
    #containerBoleto table
    {
        margin:0 ;
        padding: 0;
    }
    
    #containerBoleto td
    {
        margin:0 ;
        padding: 0;
    }
    #containerBoleto tr
    {
        margin:0 ;
        padding: 0;
    }
    
    #codBarras img{
        height:50px;
    
}
    .cp {  font: bold 10px Arial;   color: #000000; padding:0; margin:0;}
    .ti {  font: bold 9px Arial, Helvetica, sans-serif; margin:0; padding: 0;}
    .ld {  font: bold 14px Arial;      color: #000000;text-align: right;padding:0; margin:0;}
    .ct {  font: 9px 'Arial Narrow';   color: #000033;padding:0; margin:0;}
    .cn {  font: 9px Arial;            color: #000000; padding:0; margin:0;}
    .bc {  font: bold 20px Arial;      color: #000000; padding:0; margin:0;}
    .ld2 { font: bold 12px Arial;      color: #000000; }
    #detalhe{font: 9px Arial;      color: #000000;border-collapse: collapse;}
    #detalhe thead{font: bold 9px Arial;}
    #detalhe tr td {border: 1px solid black;}

");
 
 ?>   
    
    

<table width=666 cellspacing=0 cellpadding=1 border=0>
    <tr>
        <td valign="top" class="cp">
            <div ALIGN="CENTER">Instruções de Impressão</div>
        </td>
    </tr>
    <tr>
        <td valign="to" class="cp">
            <div ALIGN="left">
                <ul>
                    <li>Imprima em impressora jato de tinta (ink jet) ou laser em qualidade normal ou alta (Não use modo económico).</li>
                    <li>Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) e margens minimas a esquerda e a direita do formulário.</li>
                    <li>Corte na linha indicada. Não rasure, risque, fure ou dobre a região onde se encontra o código de barras.</li>
                    <li>Caso não apareça o código de barras no final, clique em F5 para atualizar esta tela.</li>
                    <li>Caso tenha problemas ao imprimir, copie a sequencia numérica abaixo e pague no caixa eletrônico ou no internet banking:</li>
                </ul>
            </div>
        </td>
    </tr>
</table>
<br>
<table cellspacing=0 cellpadding=1 width=666 border=0>
    <tbody>
        <tr>
            <td class="ct" width="666">
                <div align="right"><b class=cp>Recibo do Sacado<b></div>
            </td>
        </tr>
        <tr>
            <td class=ct width=666>
                <img height=1 src="<?php echo Yii::app()->baseUrl;?>/images/boleto/6.png" width=665 border=0>
            </td>
        </tr>
    </tbody>
</table>
<table width=666 cellspacing=5 cellpadding=1 border=0>
    <tr>
        <td width=41></td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="1" width="666" border="0">
    <tr>
        <td class=cp width=150 style="border-bottom: solid 3px black;border-right: solid 3px black;">
                <img src="<?php echo Yii::app()->baseUrl;?>/images/boleto/logos/logoitau.jpg" width="150" height="40" border=0>
        </td>
        <td class="cpt" width=58 valign=bottom style="border-bottom: solid 3px black;border-right: solid 3px black;">
            <div align=center><font class=bc><?php echo $aDadosboleto["codigo_banco_com_dv"]?></font></div>
        </td>
        <td class="ld"  width="453" valign="bottom" style="border-bottom: solid 3px black;"> 
                    <?php echo $aDadosboleto["linha_digitavel"]?>
        </td>
   </tr>
</table>
<table cellspacing="0" cellpadding="1" border="0" width="666">
    <tr>
        <td class="ct" width="268" height="13" style=" border-left: solid 1px black;border-right: solid 1px black;">Cedente</td>
        <td class="ct" width="150" height="13" style="border-right: solid 1px black;">Agência/Código do Cedente</td>
        <td class="ct" width="34"  height="13" style="border-right: solid 1px black;">Espécie</td>
        <td class="ct" width="53"  height="13" style="border-right: solid 1px black;">Quantidade</td>
        <td class="ct" width="154" height="13" >Nosso número</td>
    </tr>
    <tr>
        <td class="cp" width="268" height="13" style=" border-left: solid 1px black;border-right: solid 1px black;border-bottom: solid 1px black;"><?php echo $aDadosboleto["cedente"]; ?>&nbsp;</td>
        <td class="cp" width="150" height="13" style=" border-right: solid 1px black;border-bottom: solid 1px black;text-align: center;">&nbsp;<?php echo $aDadosboleto["agencia_codigo"];?></td>
        <td class="cp" width="34"  height="13" style=" border-right: solid 1px black;border-bottom: solid 1px black;text-align: center;">&nbsp;<?php echo $aDadosboleto["especie"];?></td>
        <td class="cp" width="53"  height="13" style=" border-right: solid 1px black;border-bottom: solid 1px black;text-align: center;">&nbsp;<?php echo $aDadosboleto["quantidade"];?></td>
        <td class="cp" width="154" height="13" style="border-bottom: solid 1px black;text-align: right;">&nbsp;<?php echo $aDadosboleto["nosso_numero"];?></td>
    </tr>
</table>
<table cellspacing="0" cellpadding="1" border="0" width="666">
        <tr>
            <td class="ct" width="200" height="13" style="border-left:  solid 1px black;border-right: solid 1px black;">Número do documento</td>
            <td class="ct" width="200" height="13" style="border-right: solid 1px black;">CPF/CNPJ</td>
            <td class="ct" width="133" height="13" style="border-right: solid 1px black;">Vencimento</td>
            <td class="ct" width="133" height="13" >Valor documento</td>
        </tr>
        <tr>
            <td class="cp"  width="200" height="13" style="text-align: center;border-left:  solid 1px black;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;<?php echo $aDadosboleto["numero_documento"]?></td>
            <td class="cp"  width="101" height="13" style="text-align: center;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;<?php echo $aDadosboleto["cpf_cnpj"]?></td>
            <td class="cp"  width="133" height="13" style="text-align: center;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;<?php echo $aDadosboleto["data_vencimento"]?></td>
            <td class="cp"  width="133" height="13" style="text-align: right;border-bottom: solid 1px black;">&nbsp;<?php echo $aDadosboleto["valor_boleto"]?></td>
        </tr>
</table>
<table cellspacing="0" cellpadding="1" border="0" width="666">
    <tr>
        <td class="ct"  width="140" height="13" style="border-left:  solid 1px black;border-right: solid 1px black;">(-) Desconto / Abatimentos</td>
        <td class="ct"  width="112" height="13" style="border-right: solid 1px black;">(-) Outras deduções</td>
        <td class="ct"  width="113" height="13" style="border-right: solid 1px black;">(+) Mora / Multa</td>
        <td class="ct"  width="113" height="13" style="border-right: solid 1px black;">(+) Outros acréscimos</td>
        <td class="ct"  width="183" height="13" >(=) Valor cobrado</td>
    </tr>
    <tr>
        <td class="cp"  width="140" height="13" style="text-align: right;border-left:  solid 1px black;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;</td>
        <td class="cp"  width="112" height="13" style="text-align: center;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;</td>
        <td class="cp"  width="113" height="13" style="text-align: center;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;</td>
        <td class="cp"  width="113" height="13" style="text-align: center;border-right: solid 1px black;border-bottom: solid 1px black;">&nbsp;</td>
        <td class="cp"  width="183" height="13" style="text-align: center;border-bottom: solid 1px black;">&nbsp;</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="1" border="0" width="666">
    <tr>
        <td class="ct" width="666" height="13" style="border-left:  solid 1px black;">Sacado</td>
    </tr>
    <tr>
        <td class="cp" width="666" height="13" style="text-align: left;border-left: solid 1px black;border-bottom: solid 1px black;"><?php echo $aDadosboleto["sacado"]?>&nbsp;</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="1" border="0" width="666">    
        <tr>
            <td class="ct"  width="400" >Demonstrativo</td>
            <td class="ct"  width="366" style="text-align:right;">Autenticação mecânica - <b class="cp">Ficha de Compensações</b></td>
        </tr>
        <tr>
            <td colspan="3" class="ti" width="409" >
                    <?php echo $aDadosboleto["demonstrativo1"]?><br>
                    <?php //echo $aDadosboleto["demonstrativo2"]?><br>
                    <?php //echo $aDadosboleto["demonstrativo3"]?><br>
            </td>
        </tr>
</table>
<table cellspacing="0" cellpadding="1" width="666" border="0">
        <tr>
            <td width="7"></td>
            <td  width="500" class="cp">
                <br>
                <br>
            </td>
            <td width="159"></td>
        </tr>
</table>
<table cellspacing="0" cellpadding="1" width="666" border="0">
    <tr>
        <td class="ct" width="666"></td>
    </tr>
    <tr>
        <td class="ct" width="666">
            <div align="right">Corte na linha pontilhada</div>
        </td>
    </tr>
    
    <tr>
        <td class="ct" width="666"><img height="1" src="<?php echo Yii::app()->baseUrl;?>/images/boleto/6.png" width="665" border="0"></td>
    </tr>
</table>
<br/>
   <!-----------------   SEGUNDA VIA           -->
<table cellspacing="0" cellpadding="1" width="666" border="0">
    <tr>
        <td class="cp" width="150" style="border-bottom: solid 3px black;border-right: solid 3px black;">
            <span class="campo">
                <img src="<?php echo Yii::app()->baseUrl;?>/images/boleto/logos/logoitau.jpg" width="150" height="40" border=0>
            </span>
        </td>
        <td class="cp" width="58" valign="bottom" style="border-bottom: solid 3px black;border-right: solid 3px black;">
            <div align="center"><font class="bc"><?php echo $aDadosboleto["codigo_banco_com_dv"]?></font></div>
        </td>
        <td class=ld align="right" width="453" valign="bottom" style="border-bottom: solid 3px black;"> 
            <span class="ld">
                    <?php echo $aDadosboleto["linha_digitavel"]?>
            </span>
        </td>
   </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>
        <td class=ct valign=top width=472 height=13 style="border-left:  solid 1px black;border-right: solid 1px black;">Local de pagamento</td>
        <td class=ct valign=top width=180 height=13 >Vencimento</td>
    </tr>
    <tr>
        <td class=cp valign=top width=472 height=13 style="text-align: left; border-left:  solid 1px black;border-right: solid 1px black;border-bottom: solid 1px black;">Atéo vencimento, preferencialmente no Itaú. Após o vencimento, somente no Itaú</td>
        <td class=cp valign=top width=180 height=13 style="text-align: right; border-bottom: solid 1px black;">&nbsp;<?php echo $aDadosboleto["data_vencimento"]?></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>
        <td class=ct valign=top width=472 height=13 style="border-left:  solid 1px black;border-right: solid 1px black;">Cedente</td>
        <td class=ct valign=top width=180 height=13>Agência/Código cedente</td>
    </tr>
    <tr>
        <td class=cp valign=top width=472 height=12 style="border-left:  solid 1px black;border-right: solid 1px black;border-bottom: solid 1px black;"><?php echo $aDadosboleto["cedente"]?>&nbsp;</td>
        <td class=cp valign=top width=180 height=12 style="text-align: right;border-bottom: solid 1px black;">&nbsp;<?php echo $aDadosboleto["agencia_codigo"]?></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>
        <td class="ct"  width="100" height="13" style="border-left:  solid 1px black;border-right: solid 1px black;">Data do documento</td>
        <td class="ct"  width="100" height="13" style="border-right: solid 1px black;">N<u>o</u> documento</td>
        <td class="ct"  width="70"  height="13" style="border-right: solid 1px black;">Espécie doc.</td>
        <td class="ct"  width="48"  height="13" style="border-right: solid 1px black;">Aceite</td>
        <td class="ct"  width="158" height="13" style="border-right: solid 1px black;">Data processamento</td>
        <td class="ct"  height="13"  >Nosso número</td>
    </tr>
    <tr>
        <td class="cp"  width="100" height="13" style="border-left:  solid 1px black;border-bottom:solid 1px black; border-right: solid 1px black;text-align: center"><?php echo $aDadosboleto["data_documento"]?></td>
        <td class="cp"  width="100" height="13" style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["numero_documento"]?></td>
        <td class="cp"  width="60"  height="13" style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["especie_doc"]?></td>
        <td class="cp"  width="48"  height="13" style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["aceite"]?></td>
        <td class="cp"  width="155" height="13" style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["data_processamento"]?></td>
        <td class="cp"  height="13" style="border-bottom:solid 1px black;text-align: right">&nbsp;<?php echo $aDadosboleto["nosso_numero"]?></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>
        <td class="ct"  width="155"   height="13" style="border-left:  solid 1px black;border-right: solid 1px black;">Uso do banco</td>
        <td class="ct"  width="70"    height="13" style="border-right: solid 1px black;">Carteira</td>
        <td class="ct"  width="55"    height="13" style="border-right: solid 1px black;">Espécie</td>
        <td class="ct"  width="91"    height="13" style="border-right: solid 1px black;">Quantidade</td>
        <td class="ct"  width="105"    height="13" >Valor Documento</td>
        <td class="ct"  height="13" style="border-left: solid 1px black;">(=) Valor documento</td>
    </tr>
    <tr>
        <td class="cp"   width="155" height="13"  style="border-left:  solid 1px black;border-bottom:solid 1px black; border-right: solid 1px black;text-align: right">&nbsp;</td>
        <td class="cp"   width="70"  height="13"  style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["carteira"]?></td>
        <td class="cp"   width="55"  height="13"  style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["especie"]?></td>
        <td class="cp"   width="91"  height="13"  style="border-bottom:solid 1px black; border-right: solid 1px black;text-align: center">&nbsp;<?php echo $aDadosboleto["quantidade"]?></td>
        <td class="cp"   width="92"  height="13"  style="border-bottom:solid 1px black; text-align: center">&nbsp;<?php echo $aDadosboleto["valor_unitario"]?></td>
        <td class="cp"               height="13"  style="border-bottom:solid 1px black; border-left: solid 1px black;text-align: right">&nbsp;<?php echo $aDadosboleto["valor_boleto"]?></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=0 width="666" border=0>
    <tr>
        <td valign=top width=" 480" rowspan="6" style="padding:0;border-left:solid 1px black; border-right: solid 1px black; border-bottom: solid 1px black;">
            <span class=ct>Instruções (Todas as Informações deste bloqueto são de exclusiva responsabilidade do cedente)</span>
            <br>
            <span class="ti">
                <br/>
                <?php echo $aDadosboleto["instrucoes1"]; ?><br>
                <?php echo $aDadosboleto["instrucoes2"]; ?><br>
                <?php echo $aDadosboleto["instrucoes3"]; ?><br>
                <?php echo $aDadosboleto["instrucoes4"]; ?>
            </span>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="0" border="0" style="padding:0px;">
                <tr>
                    <td class="ct" valign=top width=183 height=13 >(-)Desconto / Abatimentos</td>
                </tr>
                <tr>
                    <td class="ct" valign=top width=180 height=13 style="border-bottom:solid 1px black;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="1" border="0" style="padding:0px;">
                <tr>
                    <td class="ct" valign=top width=180 height=13 >(-)Outras deduções</td>
                </tr>
                <tr>
                    <td class="ct" valign=top width=180 height=13 style="border-bottom:solid 1px black;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td class="ct" valign=top width=180 height=13 >(+)Mora / Multa</td>
                </tr>
                <tr>
                    <td class="ct" valign=top width=180 height=13 style="border-bottom:solid 1px black;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td class="ct" valign=top width=180 height=13 >(+)Outros acréscimos</td>
                </tr>
                <tr>
                    <td class="ct" valign=top width=180 height=13 style="border-bottom:solid 1px black;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td class="ct" valign=top width=180 height=13 >(=)Valor cobrado</td>
                </tr>
                <tr>
                    <td class="ct" valign=top width=180 height=13 style="border-bottom:solid 1px black;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>        
        <td class=ct valign=top width=666 height=13 style="border-left:solid 1px black;">Sacado</td>
    </tr>
    <tr>
        <td class=cp valign=top width=666 height=12 style="border-left:solid 1px black;"><?php echo $aDadosboleto["sacado"]?>&nbsp;</td>
    </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>
        <td class=cp valign=top width=666 height=12 style="border-left:solid 1px black;"><?php echo $aDadosboleto["endereco1"]?>&nbsp;</td>
    </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="666">
    <tr>
        <td class=cp valign=top width=472 height=13 style="border-left:solid 1px black;border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $aDadosboleto["endereco2"]?>&nbsp;</td>
        <td class=ct valign=top width=180 height=13 style="border-bottom:solid 1px black;">Cód.baixa</td>
    </tr>
</table>
<table cellSpacing=0 cellPadding=0 border=0 width=666>
    <tbody>
        <tr>
            <td accesskey=""class=ct  width=7 height=12></td>
            <td class=ct  width=409 >Sacador/Avalista</td>
            <td class=ct  width=250 >
                <div align=right>Autenticação mecânica - <b class=cp>Ficha de Compensações</b>
                </div>
            </td>
        </tr>
        <tr>
            <td class=ct  colspan=3 ></td>
        </tr>
    </tbody>
</table>
<table cellSpacing=0 cellPadding=0 width=666 border=0>
    <tbody>
        <tr>
            <td vAlign=bottom align=left height=50><span  id="codBarras"><?php echo $aDadosboleto["DesenhoCodBarras"]; ?></span></td>
        </tr>
    </tbody>
</table>
<table cellSpacing=0 cellPadding=0 width=666 border=0>
    <tr>
        <td class=ct width=666></td>
    </tr>
    <tr>
        <td class="ct" width="666">
            <div align="right">Corte na linha pontilhada</div>
        </td>
    </tr>
    
    <tr>
        <td class=ct width=666><img height=1 src="<?php echo Yii::app()->baseUrl;?>/images/boleto/6.png" width=665 border=0></td>
    </tr>   
</table>
</div>

    

