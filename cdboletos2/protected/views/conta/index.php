<?php


$this->menu=array(
	array('label'=>'Create Conta','url'=>array('create')),
	array('label'=>'Manage Conta','url'=>array('admin')),
);
?>

<h1>Contas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
