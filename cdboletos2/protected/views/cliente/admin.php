<?php

/*
 * Exemplo de como limpar a variavel de sescao
 * DOC: http://www.yiiframework.com/doc/api/1.1/CWebUser#setState-detail
 * 
 * Yii::app()->user->setState('contratante_id',null); 
 */

if(Yii::app()->user->hasState('contratante_id'))
        $contratante_id = Yii::app()->user->contratante_id;
else
        $contratante_id = "0";
        
        
if(Yii::app()->user->hasState('empresa_id'))
        $empresa_id = Yii::app()->user->empresa_id;
else
        $empresa_id = "0";

if(Yii::app()->user->hasState('filial_id'))
        $filial_id = Yii::app()->user->filial_id;
else
        $filial_id = "0";

if($filial_id == 0)
    $this->menu=array(
    	 array('label'=>'Gerenciar Empresa','icon'=>'heart','url'=>array('empresa/','view'=>$empresa_id),'active'=>true),
                    array('label'=>'Novo Cliente','icon'=>'pencil','url'=>array('create')),
    );
else
    $this->menu=array(
             array('label'=>'Gerenciar Filial','icon'=>'heart','url'=>array('filial/','view'=>$filial_id),'active'=>true),
             array('label'=>'Novo Cliente','icon'=>'pencil','url'=>array('create')),
    );
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cliente-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


?>

<h1>Gerenciar Clientes</h1>

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
	'id'=>'cliente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
                'type' => 'striped bordered condensed',
	'columns'=>array(
                                    'Empresa_id',
		'ID',
//		'Contratante_id',
//		'Empresa_id',
//		'Filial_id',
		'Nome',
		'CPF_CNPJ',
//		'RG_IE',
//		'Logradouro',
//		'Endereco',
//		'Cidade',
//		'UF',
		'Telefone',
		'Telefone2',
		'Email',
		array(
                                                     'header'=>Yii::t('ses', 'Gerenciar'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
                                                    'template'=>'{view}'
		),
		array(
                                                     'header'=>Yii::t('ses', 'Editar'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
                                                    'template'=>'{update}{delete}'
		),
	),
)); ?>
