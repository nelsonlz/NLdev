<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Contratante_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Empresa_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Filial_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nome',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'CPF_CNPJ',array('class'=>'span5','maxlength'=>24)); ?>

	<?php echo $form->textFieldRow($model,'RG_IE',array('class'=>'span5','maxlength'=>24)); ?>

	<?php echo $form->textFieldRow($model,'Endereco',array('class'=>'span5','maxlength'=>40)); ?>
                    
                <?php echo $form->textFieldRow($model,'Bairro',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'Cidade',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'UF',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'Telefone',array('class'=>'span5','maxlength'=>24)); ?>

	<?php echo $form->textFieldRow($model,'Telefone2',array('class'=>'span5','maxlength'=>24)); ?>

	<?php echo $form->textFieldRow($model,'Email',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
