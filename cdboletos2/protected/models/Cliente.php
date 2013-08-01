<?php

/**
 * This is the model class for table "Cd_Cliente".
 *
 * The followings are the available columns in table 'Cd_Cliente':
 * @property integer $ID
 * @property integer $Contratante_id
 * @property integer $Empresa_id
 * @property integer $Filial_id
 * @property string $Nome
 * @property string $CPF_CNPJ
 * @property string $RG_IE
 * @property string $CEP
 * @property string $Bairro
 * @property string $Endereco
 * @property string $Cidade
 * @property string $UF
 * @property string $Telefone
 * @property string $Telefone2
 * @property string $Email
 */
class Cliente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cd_Cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Contratante_id, Nome, CPF_CNPJ, RG_IE', 'required'),
			array('Contratante_id, Empresa_id, Filial_id', 'numerical', 'integerOnly'=>true),
                                                      array('CEP','length','max'=>12),
			array('Nome, Bairro, Endereco, Cidade', 'length', 'max'=>40),
			array('CPF_CNPJ, RG_IE, Telefone, Telefone2', 'length', 'max'=>24),
			array('UF', 'length', 'max'=>2),
			array('Email', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Contratante_id, Empresa_id, Filial_id, Nome, CPF_CNPJ, RG_IE, CEP, Endereco, Bairro, Cidade, UF, Telefone, Telefone2, Email', 'safe', 'on'=>'search'),
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
			'Nome' => 'Nome',
			'CPF_CNPJ' => 'Cpf/Cnpj',
			'RG_IE' => 'RG/Inscrição Estadual',
                                                      'CEP'=>'CEP',
                                                      'Endereco' => 'Endereço',
			'Bairro' => 'Bairro',
			'Cidade' => 'Cidade',
			'UF' => 'Uf',
			'Telefone' => 'Telefone',
			'Telefone2' => 'Telefone 2',
			'Email' => 'E-mail',
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
            

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Contratante_id',$contratante_id);
		$criteria->compare('Empresa_id',$empresa_id);
		$criteria->compare('Filial_id',$filial_id);
		$criteria->compare('Nome',$this->Nome,true);
		$criteria->compare('CPF_CNPJ',$this->CPF_CNPJ,true);
		$criteria->compare('RG_IE',$this->RG_IE,true);
                                    $criteria->compare('CEP',$this->CEP,true);
		$criteria->compare('Bairro',$this->Bairro,true);
		$criteria->compare('Endereco',$this->Endereco,true);
		$criteria->compare('Cidade',$this->Cidade,true);
		$criteria->compare('UF',$this->UF,true);
		$criteria->compare('Telefone',$this->Telefone,true);
		$criteria->compare('Telefone2',$this->Telefone2,true);
		$criteria->compare('Email',$this->Email,true);

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
                            $criteria->order = 'Nome ASC';
                    
                     return CHtml::listData(Cliente::model()->findAll($criteria), 
                                                            'ID','Nome');
                }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cliente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
