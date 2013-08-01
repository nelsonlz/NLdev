<?php


$this->menu=array(
                  array('label'=>'Gerenciar Empresa','icon'=>'heart','url'=>array('view','id'=>$model->ID),'active'=>true),
);
?>

<h1>Atualizar Empresa <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>