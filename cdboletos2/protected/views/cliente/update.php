<?php


$this->menu=array(
                  array('label'=>'Gereciar Cliente','icon'=>'heart','url'=>array('view','id'=>$model->ID),'active'=>true),
                  array('label'=>'Gerenciar Clientes','icon'=>'book','url'=>array('admin')),
	array('label'=>'Novo Cliente','icon'=>'pencil','url'=>array('create')),
);
?>

<h1>Atualizar Cliente <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>