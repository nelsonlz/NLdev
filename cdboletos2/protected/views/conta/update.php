<?php


$this->menu=array(
	array('label'=>'Gerenciar Conta','icon'=>'heart','url'=>array('view','id'=>$model->ID),'active'=>true),
	array('label'=>'Gerenciar Contas','icon'=>'book','url'=>array('admin')),
);
?>

<h2>Atualizar Conta <?php echo $model->CC.'-'.$model->DgCC; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>