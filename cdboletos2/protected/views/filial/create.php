<?php

$this->menu=array(
	array('label'=>'Gerenciar Filiais','icon'=>'book','url'=>array('admin'),'active'=>true),
);
?>

<h1>Nova Filial</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>