<?php


$this->menu=array(
	array('label'=>'Gerenciar Contas Bancarias','icon'=>'book','url'=>array('admin'),'active'=>true),
);
?>

<h1>Nova Conta Bancaria</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>