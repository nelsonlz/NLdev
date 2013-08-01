<?php

Yii::app()->user->setState('empresa_id',$model->ID);
Yii::app()->user->setState('filial_id',null);


$this->menu=array(
                  array('label'=>'Gerenciar Empresas','icon'=>'book','url'=>array('admin'),'active'=>true),
	array('label'=>'Atualizar Empresa','icon'=>'cog','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Deletar Empresa','icon'=>'remove','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
                  array('label'=>'Gerencia'),     
                  array('label'=>'Gerenciar Clientes','icon'=>'user','url'=>array('/cliente/admin')),
                  array('label'=>'Gerenciar Contas Bancarias','icon'=>'list-alt','url'=>array('/conta/admin')),
                  array('label'=>'Gerenciar Filiais','icon'=>'briefcase','url'=>array('/filial/admin')),
                  array('label'=>'Boletos '),     
                  array('label'=>'Gerenciar Boletos','icon'=>'barcode','url'=>array('/boleto/admin')),
    
);

?>



<h2><?php echo $model->Nome; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Contratante_id',
		'Nome',
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
