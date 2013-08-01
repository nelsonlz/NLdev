<?php

/**
 * This is the model class for table "Cd_Filial".
 *
 * The followings are the available columns in table 'Cd_Filial':
 * @property integer $ID
 * @property integer $Contratante_id
 * @property integer $Empresa_id
 * @property string $CNPJ
 * @property string $Endereco
 * @property string $Bairro
 * @property string $Cidade
 * @property string $UF
 * @property string $Telefone
 * @property string $Telefone2
 * @property string $Email
 */
class Filial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cd_Filial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Contratante_id, Empresa_id', 'required'),
                                                      array('Telefone', 'required'),
			array('Contratante_id, Empresa_id', 'numerical', 'integerOnly'=>true),
			array('CNPJ, Telefone, Telefone2', 'length', 'max'=>24),
                                                      array('CEP','length','max'=>12),
			array('Endereco, Bairro, Cidade', 'length', 'max'=>40),
			array('UF', 'length', 'max'=>2),
			array('Email', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Contratante_id, Empresa_id, CNPJ, CEP, Endereco, Bairro, Cidade, UF, Telefone, Telefone2, Email', 'safe', 'on'=>'search'),
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
			'CNPJ' => 'Cnpj',
                                                      'CEP'=>'CEP',
			'Endereco' => 'Endereco',
			'Bairro' => 'Bairro',
			'Cidade' => 'Cidade',
			'UF' => 'Uf',
			'Telefone' => 'Telefone',
			'Telefone2' => 'Telefone2',
			'Email' => 'Email',
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
                                    

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Contratante_id',$contratante_id);
		$criteria->compare('Empresa_id',$empresa_id);
		$criteria->compare('CNPJ',$this->CNPJ,true);
                                    $criteria->compare('CEP',$this->CEP,true);
		$criteria->compare('Endereco',$this->Endereco,true);
		$criteria->compare('Bairro',$this->Bairro,true);
		$criteria->compare('Cidade',$this->Cidade,true);
		$criteria->compare('UF',$this->UF,true);
		$criteria->compare('Telefone',$this->Telefone,true);
		$criteria->compare('Telefone2',$this->Telefone2,true);
		$criteria->compare('Email',$this->Email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Filial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
