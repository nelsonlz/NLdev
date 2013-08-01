<?php

/**
 * This is the model class for table "Cd_Empresa".
 *
 * The followings are the available columns in table 'Cd_Empresa':
 * @property integer $ID
 * @property integer $Contratante_id
 * @property string $Nome
 * @property string $CNPJ
 * @property string $CEP
  * @property string $Endereco
 * @property string $Bairro
 * @property string $Cidade
 * @property string $UF
 * @property string $Telefone
 * @property string $Telefone2
 * @property string $Email
 */
class Empresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cd_Empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Contratante_id, Nome, CNPJ', 'required'),
			array('Contratante_id', 'numerical', 'integerOnly'=>true),
			array('Nome, Endereco, Bairro, Cidade', 'length', 'max'=>40),
                                                       array('CEP','length','max'=>12),
			array('CNPJ, Telefone, Telefone2', 'length', 'max'=>24),
			array('UF', 'length', 'max'=>2),
			array('Email', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Contratante_id, Nome, CNPJ, CEP, Endereco, Bairro, Cidade, UF, Telefone, Telefone2, Email', 'safe', 'on'=>'search'),
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
			'Nome' => 'Nome',
			'CNPJ' => 'CNPJ',
			'CEP' => 'Cep',
                                                      'Endereco' => 'Endereco',
			'Bairro' => 'Bairro',
			'Cidade' => 'Cidade',
			'UF' => 'UF',
			'Telefone' => 'Telefone',
			'Telefone2' => 'Telefone 2',
			'Email' => 'e-mail',
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

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Contratante_id',$this->Contratante_id);
		$criteria->compare('Nome',$this->Nome,true);
		$criteria->compare('CNPJ',$this->CNPJ,true);
		$criteria->compare('Endereco',$this->Endereco,true);
		$criteria->compare('Bairro',$this->Bairro,true);
		$criteria->compare('CEP',$this->CEP,true);
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
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
