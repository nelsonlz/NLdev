<?php

$this->menu=array(
                  array('label'=>'Gerenciar Clientes','icon'=>'book','url'=>array('admin'),'active'=>true),
	array('label'=>'Atualizar Cliente','icon'=>'cog','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Deletar Cliente','icon'=>'remove','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h2><?php echo $model->Nome; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
//		'ID',
//		'Contratante_id',
//		'Empresa_id',
//		'Filial_id',
		'Nome',
		'CPF_CNPJ',
		'RG_IE',
                                    'CEP',
                                    'Endereco',
		'Bairro',
		'Cidade',
		'UF',
		'Telefone',
		'Telefone2',
		'Email',
	),
)); ?>
