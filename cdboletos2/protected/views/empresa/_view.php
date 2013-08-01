<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Contratante_id')); ?>:</b>
	<?php echo CHtml::encode($data->Contratante_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nome')); ?>:</b>
	<?php echo CHtml::encode($data->Nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CNPJ')); ?>:</b>
	<?php echo CHtml::encode($data->CNPJ); ?>
	<br />
        
                 <b><?php echo CHtml::encode($data->getAttributeLabel('CEP')); ?>:</b>
	<?php echo CHtml::encode($data->CEP); ?>
	<br />
        

	<b><?php echo CHtml::encode($data->getAttributeLabel('Endereco')); ?>:</b>
	<?php echo CHtml::encode($data->Endereco); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('Bairro')); ?>:</b>
	<?php echo CHtml::encode($data->Bairro); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Cidade')); ?>:</b>
	<?php echo CHtml::encode($data->Cidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UF')); ?>:</b>
	<?php echo CHtml::encode($data->UF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Telefone')); ?>:</b>
	<?php echo CHtml::encode($data->Telefone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Telefone2')); ?>:</b>
	<?php echo CHtml::encode($data->Telefone2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	*/ ?>

</div>