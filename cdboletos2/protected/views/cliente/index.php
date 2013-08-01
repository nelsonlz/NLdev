<?php

$this->menu=array(
	array('label'=>'Novo Cliente','url'=>array('create')),
	array('label'=>'Gerenciar Cliente','url'=>array('admin')),
);
?>

<h1>Clientes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
