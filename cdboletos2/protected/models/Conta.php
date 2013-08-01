<?php

/**
 * This is the model class for table "Cd_Conta".
 *
 * The followings are the available columns in table 'Cd_Conta':
 * @property integer $ID
 * @property integer $Contratante_id
 * @property integer $Empresa_id
 * @property integer $Filial_id
 * @property integer $Banco_id
 * @property integer $Agencia
 * @property integer $DgAgencia
 * @property integer $CC
 * @property integer $DgCC
 * @property integer $CodCedente
 * @property integer $DgCodCedente
 * @property integer $NumeroConvenio
 * @property integer $TipoConvenio
 * @property integer $NumeroCarteira
 * @property integer $NumeroAplicativo
 * @property integer $CodigoMoeda
 * @property string $Modalidade
 * @property string $Aceite
 * @property string $Especie
 * @property double $Mulda
 * @property double $Juros
 * @property string $Instrucoes
 */
class Conta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cd_Conta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Contratante_id, Empresa_id, Filial_id, Banco_id', 'required'),
			array('Contratante_id, Empresa_id, Filial_id, Banco_id, Agencia, DgAgencia, CC, DgCC, CodCedente, DgCodCedente, NumeroConvenio, TipoConvenio, NumeroCarteira, NumeroAplicativo, CodigoMoeda', 'numerical', 'integerOnly'=>true),
			array('Mulda, Juros', 'numerical'),
			array('Modalidade, Aceite', 'length', 'max'=>2),
			array('Especie', 'length', 'max'=>3),
			array('Instrucoes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Contratante_id, Empresa_id, Filial_id, Banco_id, Agencia, DgAgencia, CC, DgCC, CodCedente, DgCodCedente, NumeroConvenio, TipoConvenio, NumeroCarteira, NumeroAplicativo, CodigoMoeda, Modalidade, Aceite, Especie, Mulda, Juros, Instrucoes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                                    
                                            
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Contratante_id' => 'Contratante',
			'Empresa_id' => 'Empresa',
			'Filial_id' => 'Filial',
			'Banco_id' => 'Banco',
			'Agencia' => 'Agencia',
			'DgAgencia' => 'Dg Agencia',
			'CC' => 'Cc',
			'DgCC' => 'Dg Cc',
			'CodCedente' => 'Cod Cedente',
			'DgCodCedente' => 'Dg Cod Cedente',
			'NumeroConvenio' => 'Numero Convenio',
			'TipoConvenio' => 'Tipo Convenio',
			'NumeroCarteira' => 'Numero Carteira',
			'NumeroAplicativo' => 'Numero Aplicativo',
			'CodigoMoeda' => 'Codigo Moeda',
			'Modalidade' => 'Modalidade',
			'Aceite' => 'Aceite',
			'Especie' => 'Especie',
			'Mulda' => 'Multa',
			'Juros' => 'Juros',
			'Instrucoes' => 'Instrucoes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
                                    // @todo Please modify the following code to remove attributes that should not be searched.
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
            
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Contratante_id',$contratante_id);
		$criteria->compare('Empresa_id',$empresa_id);
		$criteria->compare('Filial_id',$filial_id);
		$criteria->compare('Banco_id',$this->Banco_id);
		$criteria->compare('Agencia',$this->Agencia);
		$criteria->compare('DgAgencia',$this->DgAgencia);
		$criteria->compare('CC',$this->CC);
		$criteria->compare('DgCC',$this->DgCC);
		$criteria->compare('CodCedente',$this->CodCedente);
		$criteria->compare('DgCodCedente',$this->DgCodCedente);
		$criteria->compare('NumeroConvenio',$this->NumeroConvenio);
		$criteria->compare('TipoConvenio',$this->TipoConvenio);
		$criteria->compare('NumeroCarteira',$this->NumeroCarteira);
		$criteria->compare('NumeroAplicativo',$this->NumeroAplicativo);
		$criteria->compare('CodigoMoeda',$this->CodigoMoeda);
		$criteria->compare('Modalidade',$this->Modalidade,true);
		$criteria->compare('Aceite',$this->Aceite,true);
		$criteria->compare('Especie',$this->Especie,true);
		$criteria->compare('Mulda',$this->Mulda);
		$criteria->compare('Juros',$this->Juros);
		$criteria->compare('Instrucoes',$this->Instrucoes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
                public function Itens(){
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
                        $criteria->compare('ID',$this->ID);
                        $criteria->compare('Contratante_id',$contratante_id);
                        $criteria->compare('Empresa_id',$empresa_id);
                        $criteria->compare('Filial_id',$filial_id);
                        $criteria->order = 'CC ASC';

                         return CHtml::listData(Conta::model()->findAll($criteria), 
                                                                'ID','CC');
                }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Conta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
