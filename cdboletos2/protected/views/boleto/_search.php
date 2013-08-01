<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Contratante_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Empresa_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Filial_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Cliente_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Conta_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Vencimento',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Emissao',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Consulta',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'ValorNominal',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'ValorPago',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'Desconto',array('class'=>'span5')); ?>

		<?php echo $form->textAreaRow($model,'Detalhe',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'EnvioEmail',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'DataPagamento',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'aLink',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
