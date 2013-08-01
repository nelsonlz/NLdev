<?php

$this->menu=array(
	array('label'=>'Gerenciar Clientes','icon'=>'heart','url'=>array('admin'),'active'=>true),
);
?>

<h1>Novo Cliente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>