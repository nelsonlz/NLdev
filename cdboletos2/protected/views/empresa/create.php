<?php

$this->menu=array(
	array('label'=>'Gerenciar Empresas','icon'=>'book','url'=>array('admin'),'active'=>true),
);
?>

<h1>Nova Empresa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>