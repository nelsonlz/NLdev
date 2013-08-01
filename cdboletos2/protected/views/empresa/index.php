<?php

$this->menu=array(
	array('label'=>'Nova Empresa','url'=>array('create')),
	array('label'=>'Gerenciar Empresas','url'=>array('admin')),
);
?>

<h1>Empresas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
