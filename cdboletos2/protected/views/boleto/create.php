<?php


$this->menu=array(
array('label'=>'Gerenciar Boletos','icon'=>'book','url'=>array('admin'),'active'=>'true'),
);
?>

<h1>Novo Boleto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>