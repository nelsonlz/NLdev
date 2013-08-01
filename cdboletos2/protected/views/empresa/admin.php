<?php

Yii::app()->user->setState('contratante_id', '58');
Yii::app()->user->setState('empresa_id',null);
Yii::app()->user->setState('filial_id',null);



$this->menu=array(
	array('label'=>'Nova Empresa','icon'=>'pencil','url'=>array('create'),'active'=>true),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('empresa-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Empresas</h1>

<?php    
                        Yii::app()->user->setFlash('info', 'Para uma busca precisa você pode digitar um dos operados de comparação<strong>(&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; ou =)</strong> no inicio dos valores.');
                            $this->widget('bootstrap.widgets.TbAlert', array(
                                'block'=>true, // display a larger alert block?
                                'fade'=>true, // use transitions?
                                'closeText'=>'×', // close link text - if set to false, no close link is displayed
                                'alerts'=>array( // configurations per alert type
                                'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
                            ),
                        ));
                            
                ?>

<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'empresa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
                    'type' => 'striped bordered condensed',
                   'columns'=>array(
		'ID',
//		'Contratante_id',
		'Nome',
		'CNPJ',
//		'Endereco',
//		'Logradouro',
//		'CEP',
		'Cidade',
//		'UF',
		'Telefone',
		'Telefone2',
		'Email',
                                   array(
                                                     'header' => Yii::t('ses', 'Gerenciar'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
                                                     'template'=>'{view}',
		),
		array(
                                                     'header' => Yii::t('ses', 'Editar'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
                                                     'template'=>'{update}{delete}',
		),
	),
)); ?>


