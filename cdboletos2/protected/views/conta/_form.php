<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery/jquery.price_formate.min.js') ;

Yii::app()->clientScript->registerScript('jquery-priceformat',"
    $('#CampoMulta').priceFormat({
         prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '',
        clearPrefix: true
    });
    
 $('#CampoJuros').priceFormat({
         prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '',
        clearPrefix: true
    });
");


Yii::app()->clientScript->registerScript('VerificaNumero',"
$('#ID').keypress(function(e){
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
});

");

?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'conta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php    
                        Yii::app()->user->setFlash('info', '<strong>Campos marcados com <span class="required">*</span> são obrigatorios.</strong>');
                            $this->widget('bootstrap.widgets.TbAlert', array(
                                'block'=>true, // display a larger alert block?
                                'fade'=>true, // use transitions?
                                'closeText'=>'×', // close link text - if set to false, no close link is displayed
                                'alerts'=>array( // configurations per alert type
                                'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
                            ),
                        ));
                ?>

<?php

        $this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs',
                'tabs'=>array(
                    array('label'=>'Banco', 'content'=>
                         '<div style="display:none;">'
                        .$form->textFieldRow($model,'Contratante_id',array('class'=>'span5','readonly'=>true))
                        .$form->textFieldRow($model,'Empresa_id',array('class'=>'span5','readonly'=>true))
                        .$form->textFieldRow($model,'Filial_id',array('class'=>'span5','readonly'=>true))
                        .'</div>'
                        .$form->dropDownListRow($model, 'Banco_id', array('empty'=>'Selecione Um Banco','Opções'=> Banco::model()->itens()))
                        
                        , 'active'=>true,),
                    array('label'=>'Conta', 'content'=>
                             "<span style='float:left; margin-right:10px;'>"
                            .$form->maskedTextFieldRow($model,'Agencia','9999',array('class'=>'span1'))
                          ."&nbsp;-</span>"
                        .$form->textFieldRow($model,'DgAgencia',array('class'=>'span1','maxlength'=>2))
                        ."<div style='clear:both';></div>"
                        
                        ."<span style='float:left; margin-right:10px;'>"
                            .$form->maskedTextFieldRow($model,'CC','99999',array('class'=>'span1'))
                          ."&nbsp;-</span>"
                        .$form->textFieldRow($model,'DgCC',array('class'=>'span1','maxlength'=>2))
                        ."<div style='clear:both';></div>"
                        
                        ."<span style='float:left; margin-right:10px;'>"
                            .$form->maskedTextFieldRow($model,'CodCedente','99999999',array('class'=>'span1'))
                          ."&nbsp;-</span>"
                        .$form->textFieldRow($model,'DgCodCedente',array('class'=>'span1','maxlength'=>2))
                        ."<div style='clear:both';></div>"
                        
                        ."<span style='float:left; margin-right:10px;'>"
                            .$form->maskedTextFieldRow($model,'NumeroConvenio','9999999999',array('class'=>'span2'))
                          ."&nbsp;-</span>"
                        .$form->textFieldRow($model,'TipoConvenio',array('class'=>'span1','maxlength'=>2))
                        
                    ),
                    
                    array('label'=>'Opções da Conta', 'content'=>
                             
                            $form->textFieldRow($model,'NumeroCarteira',array('class'=>'span1','maxlength'=>3))
                        
                            .$form->textFieldRow($model,'NumeroAplicativo',array('class'=>'span1','maxlength'=>4))
                        
                            .$form->maskedTextFieldRow($model, 'CodigoMoeda', '9', array('class'=>'span1'))
                        
                            .$form->textFieldRow($model,'Modalidade',array('class'=>'span1','maxlength'=>2))
                        
                            .$form->radioButtonListRow($model, 'Aceite', array(
                                                                                                'A'=>'Aceite',
                                                                                                'N'=>'Não Aceite',
                            ))
                        
                            .$form->dropDownListRow($model, 'Especie',
                                                                            array('Especie', 'R$'=>'R$'))
                        
                        
                    ),
                    
                    array('label'=>'Administração', 'content'=>
                             
                            $form->textFieldRow($model,'Mulda',array('class'=>'span3','id'=>'CampoMulta'))
                            .$form->textFieldRow($model,'Juros',array('class'=>'span3','id'=>'CampoJuros'))
                        
                            .$form->textAreaRow($model,'Instrucoes',array('rows'=>6, 'cols'=>50, 'class'=>'span8','hint'=>'<b>Variaveis:</b> [JUROS] [MULTA] [DESCONTO]<br/><b>exemplo: </b> <br/>Após Vencimento Juros de R$ [JUROS] <br/> ao dia
Apos Vencimento Somente nas Agencias do Banco do Itau <br/>
Não receber apos 30 (trinta) dias do vencimento',))
                            
                        
                        
                    ),
                    
                ),
            ));
?>

	<?php echo $form->errorSummary($model); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Gravar' : 'Salvar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
