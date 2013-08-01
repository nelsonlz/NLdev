<?php

Yii::app()->user->setState('filial_id',null);

$contratante_id = Yii::app()->user->contratante_id;

$empresa_id = Yii::app()->user->empresa_id;



$this->menu=array(
	array('label'=>'Gerenciar Empresa','icon'=>'heart','url'=>array('empresa/','view'=>$empresa_id),'active'=>true),
	array('label'=>'Nova Filial','icon'=>'pencil','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('filial-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Filiais</h1>

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



<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
	'id'=>'filial-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    	'type' => 'striped bordered condensed',
    	'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
                   'cacheTTLType' => 's', // type can be of seconds, minutes or hours
	'columns'=>array(
//		'ID',
//		'Contratante_id',
//		'Empresa_id',
		'CNPJ',
                                    'CEP',
//		'Endereco',
//		'Bairro',
		
		'Cidade',
		'UF',
		'Telefone',
//		'Telefone2',
		'Email',
		
		 array(
                                                     'header' => Yii::t('ses', 'Gerenciar'),
			'class'=>'bootstrap.widgets.TbJsonButtonColumn',
                                                     'template'=>'{view}',
		),
		array(
                                                     'header' => Yii::t('ses', 'Editar'),
			'class'=>'bootstrap.widgets.TbJsonButtonColumn',
                                                     'template'=>'{update}{delete}',
		),
	),
)); ?>
