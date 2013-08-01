<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cliente-form',
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



<!-- Início da chamada da extensão -->
                    <?php $ConsultaCEP =  $this->widget('ext.BuscaEnderecoViaCEP', array(
                        //'tipo'=>'link',
                        'label'=>'Consultar CEP',
                        'model'=>$model,
                        'mapeamento'=>array('cep'=>'CEP',
                                            'endereco'=>'Endereco',
                                            'cidade'=>'Cidade',
                                            'bairro'=>'Bairro',
                                            'uf'=>'UF'),
                    )); 
                    
                    
                    ?>
<!-- Fim da chamada da extensão -->




<?php

        $this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs',
                'tabs'=>array(
                    array('label'=>'Dados', 'content'=>
                         '<div style="display:none;">'
                        .$form->textFieldRow($model,'Contratante_id',array('class'=>'span1','readonly'=>true))
                        .$form->textFieldRow($model,'Empresa_id',array('class'=>'span1','readonly'=>true))
                        .$form->textFieldRow($model,'Filial_id',array('class'=>'span1','readonly'=>true))
                        .'</div>'
                        .$form->textFieldRow($model,'Nome',array('class'=>'span5','maxlength'=>40))
                        .$form->maskedTextFieldRow($model, 'CPF_CNPJ', '999999999999', array('class'=>'span2','maxlength'=>24))
                        .$form->textFieldRow($model,'RG_IE',array('class'=>'span2','maxlength'=>24))
                        , 'active'=>true),
                         array('label'=>'Endereço',
                                'content'=>
                            
                                $form->maskedTextFieldRow($model, 'CEP', '99999-999', array('class'=>'span2','maxlength'=>24))
                            
                               .$ConsultaCEP->returnButton()
                               .$form->textFieldRow($model,'Endereco',array('class'=>'span5','maxlength'=>40))

                                .$form->textFieldRow($model,'Bairro',array('class'=>'span5','maxlength'=>40))
                                . "<span style='float:left; margin-right:10px;'>"
                                .$form->textFieldRow($model,'Cidade',array('class'=>'span5','maxlength'=>40))
                                ."</span>"    
                                .$form->textFieldRow($model,'UF',array('class'=>'span1','maxlength'=>2))
                            
                                ."<div style='clear:both';></div>"
                            
                                . "<span  style='float:left; margin-right:10px;'>"
                                .$form->maskedTextFieldRow($model, 'Telefone', '(99)9999-9999', array('class'=>'span2','maxlength'=>24))
                                ."</span>"    
                            
                                .$form->maskedTextFieldRow($model, 'Telefone2', '(99)9999-9999', array('class'=>'span2','maxlength'=>24))
	
                                .$form->textFieldRow($model,'Email',array('class'=>'span5','maxlength'=>100))
                                ,
                                    'itemOptions'=>array('class'=>'disabled')),
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
