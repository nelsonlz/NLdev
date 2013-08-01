<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery/jquery.price_formate.min.js') ;

Yii::app()->clientScript->registerScript('jquery-priceformat',"
    $('#ValorNominal').priceFormat({
         prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '',
        clearPrefix: true
    });
    
 $('#Desconto').priceFormat({
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
	'id'=>'boleto-form',
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

<?php echo $form->errorSummary($model); ?>

                 <?php  echo $form->textFieldRow($model,'ID',array('class'=>'span2','id'=>'ID','maxlength'=>9)); ?>


                <?php 
                     echo $form->dropDownListRow($model, 'Cliente_id',
                                                                              array('empty'=>'Selecione o Cliente','Opções'=>Cliente::model()->Itens()),array('class'=>'span5')); 
                ?>

            <?php 
                     echo $form->dropDownListRow($model, 'Conta_id',
                                                                              array('empty'=>'Selecione a Conta','Opções'=>Conta::model()->Itens()),array('class'=>'span5')); 
                ?>
                <?php echo $form->labelEx($model,'Vencimento'); ?>

 
                <?php 
                    $this->widget(
                        'zii.widgets.jui.CJuiDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'Vencimento',
                            'language'=>  'pt',
                            //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
                            'options'   => array(
                                'dateFormat' => 'dd-mm-yy','class'=>'span5', 'defaultDate' => "+1d",
                            ),
                        )
                    );
                ?>

                 <?php  echo $form->textFieldRow($model,'ValorNominal',array('class'=>'span2','id'=>'ValorNominal','alt'=>'decimal')); ?>

	<?php echo $form->textFieldRow($model,'Desconto',array('class'=>'span2','id'=>'Desconto','alt'=>'decimal')); ?>

	<?php echo $form->textAreaRow($model,'Detalhe',array('rows'=>6, 'cols'=>50, 'class'=>'span8','hint'=>'<b>Regra:</b> Separe as variaveis com <b style="color:red"> | </b> e termine a linha com  <b style="color:red"> ; </b> <br/><b>Variaveis: </b> ID | Descrição | Histórico | Valor | Descricao<br/><b>exemplo:</b><br/>055|Manutencao Mensal|Lcto Automatico|178.90;<br/>650|Tx. Bancaria|Lcto Automatico|3.50;')); ?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Criar' : 'Salvar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
