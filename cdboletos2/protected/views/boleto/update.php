<?php

	$this->menu=array(
                    array('label'=>'Gerenciar Boletos','icon'=>'book','url'=>array('admin'),'active'=>'true'),
	array('label'=>'Gerenciar Boleto','icon'=>'heart','url'=>array('view','id'=>$model->aLink)),
	);
	?>

	<h1>Atualizar Boleto <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>