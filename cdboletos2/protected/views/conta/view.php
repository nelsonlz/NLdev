<?php


$this->menu=array(
                array('label'=>'Gerenciar Contas','icon'=>'book','url'=>array('admin'),'active'=>'true'),
	array('label'=>'Nova Conta','icon'=>'pencil','url'=>array('create')),
	array('label'=>'Atualizar Conta','icon'=>'cog','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Deletar Conta','icon'=>'remove','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
    
);
?>

<h2>Conta: <?php echo $model->CC.'-'.$model->DgCC; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
//		'ID',
//		'Contratante_id',
//		'Empresa_id',
//		'Filial_id',
		'Banco_id',
		'Agencia',
		'DgAgencia',
		'CC',
		'DgCC',
		'CodCedente',
		'DgCodCedente',
		'NumeroConvenio',
		'TipoConvenio',
		'NumeroCarteira',
		'NumeroAplicativo',
		'CodigoMoeda',
		'Modalidade',
		'Aceite',
		'Especie',
		'Mulda',
		'Juros',
		'Instrucoes',
	),
)); ?>
