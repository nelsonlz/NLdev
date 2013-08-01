<?php

$this->menu=array(
	array('label'=>'Gerenciar Filial','icon'=>'heart','url'=>array('view','id'=>$model->ID),'active'=>true),
	array('label'=>'Gerenciar Filiais','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Atualizar Filial <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>