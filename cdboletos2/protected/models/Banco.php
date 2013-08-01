<?php

/**
 * This is the model class for table "Cd_Banco".
 *
 * The followings are the available columns in table 'Cd_Banco':
 * @property integer $ID
 * @property string $NumeroBancoCentral
 * @property string $NomeBancoCentral
 * @property string $NomeReduzido
 * @property string $aLogo
 */
class Banco extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cd_Banco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NumeroBancoCentral', 'required'),
			array('NumeroBancoCentral', 'length', 'max'=>4),
			array('NomeBancoCentral, aLogo', 'length', 'max'=>40),
			array('NomeReduzido', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NumeroBancoCentral, NomeBancoCentral, NomeReduzido, aLogo', 'safe', 'on'=>'search'),
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
			'NumeroBancoCentral' => 'Numero Banco Central',
			'NomeBancoCentral' => 'Nome Banco Central',
			'NomeReduzido' => 'Nome Reduzido',
			'aLogo' => 'A Logo',
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
		$criteria->compare('NumeroBancoCentral',$this->NumeroBancoCentral,true);
		$criteria->compare('NomeBancoCentral',$this->NomeBancoCentral,true);
		$criteria->compare('NomeReduzido',$this->NomeReduzido,true);
		$criteria->compare('aLogo',$this->aLogo,true);

		 return new CActiveDataProvider(get_class($this), array(
                                                    'criteria' => $criteria,
                                                    'sort' => array(
                                                    'defaultOrder' => 'ID DESC',
                                                ),
                                                'pagination' => array(
                                                    'pageSize' => 25,
                                                ),
                                            ));
	}
        
                    public function itens(){
                            return CHtml::listData(Banco::model()->findAllBySql("select * from Cd_Banco"), 
                                                                                                                        'ID', 'NomeBancoCentral');
                    }
                    
                    public function getBancoById($id){
                        $criteria = new CDbCriteria;
                        $criteria->compare('ID',$id);
                        
                        return $this->findAll($criteria);
                    }
                    

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
