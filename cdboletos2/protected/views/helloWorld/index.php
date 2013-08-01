<?php
/* @var $this HelloWorldController */

$this->breadcrumbs=array(
	'Hello World',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<div id="data">
    <?php 
        echo Yii::app()->getBasePath();
    $this->renderPartial('_ajaxContent',array('myValue'=>$myValue)); ?>

    <?php echo CHtml::ajaxButton ("Update data",
                              CController::createUrl('helloWorld/UpdateAjax'), 
                              array('update' => '#data'));
    ?>
</div>
