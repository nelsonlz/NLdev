<?php

if(isset($_GET['pageSize']))
    Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);  

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);


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
                    array('label'=>'Novo Boleto','icon'=>'pencil','url'=>array('create')),
                    array('label'=>'Importar Boletos','icon'=>'inbox','url'=>array('import')),
    );
else
    $this->menu=array(
             array('label'=>'Gerenciar Filial','icon'=>'heart','url'=>array('filial/','view'=>$filial_id),'active'=>true),
             array('label'=>'Novo Boleto','icon'=>'pencil','url'=>array('create')),
             array('label'=>'Importar Boletos','icon'=>'inbox','url'=>array('import')),
    );


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('boleto-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<?php  

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Enviar Email',
        'width'=>'70%',
        'height'=>'400',
        'modal'=>true,
        'buttons' => array(
                    'Ok'=>'js:function(){alert("ok")}',
                    'Cancelar'=>'js:function(){$("#mydialog").dialog("close");}',),
        
        'autoOpen'=>false,
    ),
));

?>

<div id='dContent'></div>

<?php 
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>


<h1>Gerenciar Boletos</h1>



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



<?php 

    
    $this->widget('bootstrap.widgets.TbButton', array(
                                                                                                'label' => 'Enviar Boletos',
                                                                                                'url'=>'enviaemail',
                                                                                                  'buttonType' => 'ajaxSubmit',
                                                                                                'ajaxOptions' => array(
                                                                                                                    "data" => "js:{ids:$.fn.yiiGridView.getSelection('boleto-grid')}",
                                                                                                                    'success' => 
                                                                                                                    'function(data){
                                                                                                                            console.log(data);
                                                                                                                            $("#dContent").html(data);
                                                                                                                            $("#mydialog").dialog("open");
                                                                                                                            
                                                                                                                            }'
                                                                                            ),
                                                                                            'htmlOptions'=>array('class'=>'btn btn-primary',),
                        )
        );
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
    'enableAjaxValidation'=>true,
)); ?>
<br/>
<b>de :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'from_date',  // name of post parameter
//    'value'=>Yii::app()->request->cookies['from_date']->value,  // value comes from cookie after submittion
     'options'=>array(
        'dateFormat'=>'dd-mm-yy',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
<b>até :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'to_date',
//    'value'=>Yii::app()->request->cookies['to_date']->value,
     'options'=>array(
        'dateFormat'=>'dd-mm-yy',
 
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
<?php echo CHtml::submitButton('Filtrar'); ?> 
<?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'boleto-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'type' => 'striped bordered condensed',
 'selectableRows' => 2,
'columns'=>array(
   array(
        'id' => 'aLink',
        'class' => 'CCheckBoxColumn',
    ),
		'ID',
//		'Contratante_id',
//		'Empresa_id',
//		'Filial_id',
		'Cliente_id',
		'Conta_id',
		'Vencimento',
//		'Emissao',
//		'Consulta',
		'ValorNominal',
//		'ValorPago',
//		'Desconto',
//		'Detalhe',
//		'EnvioEmail',
//		'DataPagamento',
//		'aLink',
		
                                    array(
                                                     'header'=>Yii::t('ses', 'Visualizar'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
                                                    'template'=>'{view}'
		),
		array(
                                                     'header'=>CHtml::dropDownList(
                                                'pageSize',
                                                $pageSize,
                                                array(5=>5,20=>20,50=>50,100=>100),
                                                array('class'=>'span1',
                                                           'onchange'=>"$.fn.yiiGridView.update('boleto-grid',{ data:{pageSize: $(this).val() }})",)
                                            ),
			'class'=>'bootstrap.widgets.TbButtonColumn',
                                                    'template'=>'{update}'
		),
                                   

                                
                    ),
)); ?>

<div id="output">        </div>