<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Contratante_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Empresa_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Filial_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Banco_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Agencia',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DgAgencia',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CC',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DgCC',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CodCedente',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DgCodCedente',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NumeroConvenio',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TipoConvenio',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NumeroCarteira',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NumeroAplicativo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CodigoMoeda',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Modalidade',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'Aceite',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'Especie',array('class'=>'span5','maxlength'=>3)); ?>

	<?php echo $form->textFieldRow($model,'Mulda',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Juros',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'Instrucoes',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
