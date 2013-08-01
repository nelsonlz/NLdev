<?php


$this->menu=array(
	array('label'=>'Create Filial','url'=>array('create')),
	array('label'=>'Manage Filial','url'=>array('admin')),
);
?>

<h1>Filials</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
