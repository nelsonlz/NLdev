<?php

class BoletoController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='//layouts/column2';

/**
* @return array action filters
*/
public function filters()
{
    return array(
        'accessControl', // perform access control for CRUD operations
    );
}

/**
* Specifies the access control rules.
* This method is used by the 'accessControl' filter.
* @return array access control rules
*/
public function accessRules()
{
    return array(
        array('allow',  // allow all users to perform 'index' and 'view' actions
            'actions'=>array('meuBoleto'),
            'users'=>array('*'),
        ),  

    array('allow', // allow authenticated user to perform 'create' and 'update' actions
        'actions'=>array('create','update','import','view','admin','approve'),
        'users'=>array('@'),
    ),
    array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'actions'=>array('delete'),
        'users'=>array('admin'),
    ),
        array('deny',  // deny all users
            'actions'=>array('index'),
            'users'=>array('*'),
        ),
    );
}

/**
* Displays a particular model.
* @param integer $id the ID of the model to be displayed
*/
public function actionView($id)
{
    $this->render('view',array(
        'model'=>$this->loadModel($id),
    ));
}

/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
    $model=new Boleto;
    
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

    if(isset($_POST['Boleto']))
    {
        
        $model->attributes=$_POST['Boleto'];
        
        
        $model->beforeSave();
        
        $model->afterFind();
        
        if($model->save())
            $this->redirect(array('admin'));
    }

     
    
        $this->render('create',array(
            'model'=>$model,
        ));
}

/**
* Updates a particular model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id the ID of the model to be updated
*/
public function actionUpdate($id)
{
$model=Boleto::model()->findByLink($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Boleto']))
{
$model->attributes=$_POST['Boleto'];
if($model->save())
$this->redirect(array('view','id'=>$model->ID));
}

$this->render('update',array(
'model'=>$model,
));
}

/**
* Deletes a particular model.
* If deletion is successful, the browser will be redirected to the 'admin' page.
* @param integer $id the ID of the model to be deleted
*/
public function actionDelete($id)
{
if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('Boleto');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Importa Arquivos
*/
public function actionImport()
{
         $model=new Boleto;
         
         if(Yii::app()->request->isPostRequest)
        {

             $model->attributes=$_POST['Boleto'];
         }
         
         
        $this->render('import',array(
            'model'=>$model,
        ));
}

/**
 * Apresenta Boleto
 */

public function actionMeuBoleto($id){
    $this->layout='//layouts/meuboleto';
        $this->render('meuBoleto',array(
              'model'=>Boleto::model()->findByLink($id),
        ));
}


public function  actionEnviaemail(){
    echo '<br>';echo '<br>';echo '<br>';echo '<br>';
    echo 'Lista de Links';
  if(isset($_POST['ids']))             // method $_POST can't get any value, code stop at here. 
        {
            print_r($_POST['ids']);
//            foreach($_POST['ids'] as $val)
//            {
//                echo $val . '<br/>';
//            }
            
                
                
            
        }

    
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Boleto('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Boleto']))
$model->attributes=$_GET['Boleto'];

$this->render('admin',array(
'model'=>$model,
));
}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
//$model=Boleto::model()->findByPk($id);
    $model = Boleto::model()->findByLink($id);
    if($model===null)
        throw new CHttpException(404,'A pagina requisitada não existe.');
    return $model;
}

    /**
    * Performs the AJAX validation.
    * @param CModel the model to be validated
    */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='boleto-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
