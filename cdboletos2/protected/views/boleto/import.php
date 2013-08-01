<?php 
$aClientes = Cliente::model()->Itens();

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
    $filial_id =0;

$criteria=new CDbCriteria;
$criteria->compare('Contratante_id',$contratante_id);
$criteria->compare('Empresa_id',$empresa_id);
$criteria->compare('Filial_id',$filial_id);
$criteria->order = 'Nome ASC';


$aClientesFull = Cliente::model()->findAll($criteria);



$sClienteFull  = array();
foreach($aClientesFull as $cliente){
    $sClienteFull[$cliente->ID][] = $cliente->Nome;
    $sClienteFull[$cliente->ID][] = $cliente->Email;
}

$criteria->order = 'CC ASC';

$aContas = Conta::model()->findAll($criteria);

$sConta = array();

foreach($aContas as $conta){
    $aBanco = Banco::model()->findByPk($conta->Banco_id);
    $sConta[$conta->ID] =$aBanco->NomeBancoCentral. ' C/C: '.$conta->CC.'-'.$conta->DgCC;
}

?>


<script type="text/javascript">
   
function Importar(){
        
        var cliente = '<?php echo serialize($sClienteFull);?>';
        var contratante = '<?php echo $contratante_id; ?>';
        var empresa = '<?php echo $empresa_id; ?>';
        var contas = '<?php echo serialize($sConta);?>'
        var filial = '<?php echo $filial_id; ?>';        
        $.ajax({
                url:'<?php echo Yii::app()->baseUrl."/protected/views/boleto/_displayImport.php"; ?>',
                dataType: 'html',
                type: 'POST',
                data:{
                      opc:2,
                     clientes:cliente,
                     contas:contas,
                     contratante_id:contratante,
                     empresa_id: empresa,
                     filial_id: filial,
                    Dados:$("#dados").text()
                }
            }).done(function(data){
                        
                        $("#importDisplay").html(data);

    }).fail(function(){alert('<?php echo Yii::app()->baseUrl."/protected/views/_displayImport.php"; ?>');});
    
}    
</script>


<?php


$this->menu=array(
array('label'=>'Gerenciar Boletos','icon'=>'book','url'=>array('admin'),'active'=>'true'),
array('label'=>'Importar','icon'=>'book','url'=>"#", 'linkOptions'=>array('onclick'=>'javascript: Importar()')),
);
?>

<h1>Importar Boletos</h1>

<form action="<?php echo Yii::app()->baseUrl."/protected/views/_displayImport.php"?>">

<?php
    $this->widget('ext.nlFilePreload.nlFilePreload', array(
                        'model'=>$model,
                        'view'=>'boleto/_displayImport',
                        'mapeamento'=>array('id'=>'Teste','saida'=>'importDisplay'),
                        'clientes'=>$aClientes,
                        'contas'=>$sConta,
                )); 
?>
</action>

<div id='importDisplay' style="width:813px;"></div>