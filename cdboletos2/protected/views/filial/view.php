<?php

Yii::app()->user->setState('filial_id',$model->ID);


$this->menu=array(
                  array('label'=>'Gerenciar Filiais','icon'=>'book','url'=>array('admin'),'active'=>'true'),
	array('label'=>'Atualizar Filial','icon'=>'cog','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Deletar Filial','icon'=>'remove','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
                  array('label'=>'Gerencia'),     
                  array('label'=>'Gerenciar Clientes','icon'=>'user','url'=>array('/cliente/admin')),
                  array('label'=>'Gerenciar Contas Bancarias','icon'=>'list-alt','url'=>array('/conta/admin')),
                  array('label'=>'Gerenciar Filiais','icon'=>'briefcase','url'=>array('/filial/admin')),
                  array('label'=>'Boletos '),     
                  array('label'=>'Gerenciar Boletos','icon'=>'barcode','url'=>array('/boleto/admin')),
);
?>

<h2>Filial  <?php echo $model->ID; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
//		'Contratante_id',
//		'Empresa_id',
		'CNPJ',
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
