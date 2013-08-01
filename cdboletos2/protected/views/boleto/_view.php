<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Contratante_id')); ?>:</b>
	<?php echo CHtml::encode($data->Contratante_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa_id')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Filial_id')); ?>:</b>
	<?php echo CHtml::encode($data->Filial_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cliente_id')); ?>:</b>
	<?php echo CHtml::encode($data->Cliente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Conta_id')); ?>:</b>
	<?php echo CHtml::encode($data->Conta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Vencimento')); ?>:</b>
	<?php echo CHtml::encode($data->Vencimento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Emissao')); ?>:</b>
	<?php echo CHtml::encode($data->Emissao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Consulta')); ?>:</b>
	<?php echo CHtml::encode($data->Consulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ValorNominal')); ?>:</b>
	<?php echo CHtml::encode($data->ValorNominal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ValorPago')); ?>:</b>
	<?php echo CHtml::encode($data->ValorPago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Desconto')); ?>:</b>
	<?php echo CHtml::encode($data->Desconto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Detalhe')); ?>:</b>
	<?php echo CHtml::encode($data->Detalhe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EnvioEmail')); ?>:</b>
	<?php echo CHtml::encode($data->EnvioEmail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataPagamento')); ?>:</b>
	<?php echo CHtml::encode($data->DataPagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aLink')); ?>:</b>
	<?php echo CHtml::encode($data->aLink); ?>
	<br />

	*/ ?>

</div>