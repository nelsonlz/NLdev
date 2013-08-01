<?php

/**
 * This is the model class for table "Cd_Boleto".
 *
 * The followings are the available columns in table 'Cd_Boleto':
 * @property integer $ID
 * @property integer $Contratante_id
 * @property integer $Empresa_id
 * @property integer $Filial_id
 * @property integer $Cliente_id
 * @property integer $Conta_id
 * @property string $Vencimento
 * @property string $Emissao
 * @property string $Consulta
 * @property double $ValorNominal
 * @property double $ValorPago
 * @property double $Desconto
 * @property string $Detalhe
 * @property string $EnvioEmail
 * @property string $DataPagamento
 * @property string $aLink
 */
class Boleto extends CActiveRecord
{
    
                   public function primaryKey()
                    {
                            return 'aLink';
                    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cd_Boleto';
	}
        
                    public function beforeSave() {
                        
                        
                        if(Yii::app()->user->hasState('contratante_id'))
                                $this->Contratante_id  = Yii::app()->user->contratante_id;
            
                        if(Yii::app()->user->hasState('empresa_id'))
                              $this->Empresa_id = Yii::app()->user->empresa_id;

                        if(Yii::app()->user->hasState('filial_id'))
                              $this->Filial_id = Yii::app()->user->filial_id;
                        else
                            $this->Filial_id =0;
                        
                        
                         $Link = $this->Contratante_id.'|'.$this->Empresa_id.'|'.$this->Filial_id.'|'.$this->ID.'|'.$this->Conta_id;
                         $cript = md5($Link);
                        
                        
                         $this->aLink = $cript;
                         
                        $this->Emissao = date('Y-m-d');
                        
                        
                        $this->ValorNominal = str_replace(',', '.', $this->ValorNominal);
                        
                        $this->Desconto = str_replace(',', '.', $this->Desconto);
                        
                        if($this->Vencimento){
                            $tmp = explode('-',$this->Vencimento);
                            $this->Vencimento = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
                        }
                                  $criteria = new CDbCriteria;
                                   $criteria->compare('ID',$this->ID);
                                   $criteria->compare('Conta_id',$this->Conta_id);
                                   $saida = Boleto::model()->find($criteria);
                                   
                                   echo '<br><br><br><br>';
                                   echo 'teste';
                        
                            return  parent::beforeSave();
                    }
                    
                    public function afterFind() {
                        
                        $this->ValorNominal = str_replace('.', ',', $this->ValorNominal);
                        
                        $this->aLink = $this->aLink ;
                        
                        $this->Desconto = str_replace('.', ',', $this->Desconto);
                        
                        $tmp = explode('-',$this->Emissao);
                        $this->Emissao = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
                        if($this->Vencimento){
                            $tmp = explode('-',$this->Vencimento);
                            $this->Vencimento = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
                        }
                            
                        return parent::afterFind();
                    }
                    
                   


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID,Contratante_id, Empresa_id, Filial_id, Cliente_id, Conta_id, Vencimento,  Emissao, ValorNominal', 'required'),
//                                                      array('Vencimento', 'type', 'type'=>'date', 'dateFormat'=>Yii::app()->locale->dateFormat),
                                                     array('ID', 'numerical','integerOnly'=>true),
			array( 'Contratante_id, Empresa_id, Filial_id, Cliente_id, Conta_id', 'numerical', 'integerOnly'=>true),
			array('ValorNominal, ValorPago, Desconto', 'safe'),
			array('aLink', 'length', 'max'=>100),
			array('Detalhe, EnvioEmail, DataPagamento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Contratante_id, Empresa_id, Filial_id, Cliente_id, Conta_id, Vencimento, Emissao, Consulta, ValorNominal, ValorPago, Desconto, Detalhe, EnvioEmail, DataPagamento, aLink', 'safe', 'on'=>'search'),
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
			'ID' => 'Numero Boleto',
			'Contratante_id' => 'Contratante',
			'Empresa_id' => 'Empresa',
			'Filial_id' => 'Filial',
			'Cliente_id' => 'Cliente',
			'Conta_id' => 'Conta',
			'Vencimento' => 'Vencimento',
			'Emissao' => 'Emissao',
			'Consulta' => 'Consulta',
			'ValorNominal' => 'Valor Nominal',
			'ValorPago' => 'Valor Pago',
			'Desconto' => 'Desconto',
			'Detalhe' => 'Detalhe',
			'EnvioEmail' => 'Envio Email',
			'DataPagamento' => 'Data Pagamento',
			'aLink' => 'A Link',
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
                                    
                                    if(Yii::app()->user->hasState('filial_id'))
                                          $filial_id = Yii::app()->user->filial_id;
                                    else
                                        $filial_id =0;

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Contratante_id',$contratante_id);
		$criteria->compare('Empresa_id',$empresa_id);
		$criteria->compare('Filial_id',$filial_id);
		$criteria->compare('Cliente_id',$this->Cliente_id);
		$criteria->compare('Conta_id',$this->Conta_id);
		$criteria->compare('Vencimento',$this->Vencimento,true);
		$criteria->compare('Emissao',$this->Emissao,true);
		$criteria->compare('Consulta',$this->Consulta,true);
		$criteria->compare('ValorNominal',$this->ValorNominal);
		$criteria->compare('ValorPago',$this->ValorPago);
		$criteria->compare('Desconto',$this->Desconto);
		$criteria->compare('Detalhe',$this->Detalhe,true);
		$criteria->compare('EnvioEmail',$this->EnvioEmail,true);
		$criteria->compare('DataPagamento',$this->DataPagamento,true);
		$criteria->compare('aLink',$this->aLink,true);

		 return new CActiveDataProvider($this, array(
                                                    'criteria' => $criteria,
                                                    'sort' => array(
                                                    'defaultOrder' => 'ID DESC',
                                                ),
                                                'pagination' => array(
                                                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                                                ),
                                            ));
	}
        
                public function findByLink($aLink){
                        $criteria=new CDbCriteria;
                        $criteria->condition="aLink = :link ";
                        $criteria->params=array(':link'=>$aLink);
                       $model = Boleto::model()->find($criteria);
                       return $model;
                }
        
                    /**
                    *
                    * Serve para Calcular o Digito Verificar do Boleto para evitar com que o cliente acesse ou altere informa��o do boleto.
                    * Faz da seguinte forma:
                    * Agrupa C�digo Empresa, C�digo Cliente, Nosso N�mero, Data Vencimento(Formato Juliano), assim forma o digito verificador em 
                    * m�dulo 11.
                    *
                    * 
                    * @param string $num : string num�rica para a qual se deseja calcularo digito verificador;
                    * @param int $base : valor maximo de multiplicacao [2-$base]
                    * @param type $r  : quando especificado um devolve somente o resto
                    * @return int : Retorna o Digito verificador.
                    */
                    public static function xnCalcDigito($num, $base=9, $r=0)  
                    {
                        $soma = 0;
                        $fator = 2;
                        /* Separacao dos numeros */
                        for($i = strlen($num); $i > 0; $i--) 
                        {
                            // pega cada numero isoladamente
                            $numeros[$i] = substr($num,$i-1,1);
                           // Efetua multiplicacao do numero pelo falor
                           $parcial[$i] = $numeros[$i] * $fator;

                           // Soma dos digitos
                           $soma += $parcial[$i];
                           if ($fator == $base) {
                               // restaura fator de multiplicacao para 2
                               $fator = 1;
                           }
                           $fator++;
                        }
                        return $soma;        
                    }

                    public static function xnNumberFormat($numero,$loop,$insert,$tipo = "geral") 
                    {
                        if ($tipo == "geral") {
                                $numero = str_replace(",","",$numero);
                                while(strlen($numero)<$loop){
                                        $numero = $insert . $numero;
                                }
                        }
                        if ($tipo == "valor") {
                                /*
                                retira as virgulas
                                formata o numero
                                preenche com zeros
                                */
                                $numero = str_replace(",","",$numero);
                                while(strlen($numero)<$loop){
                                        $numero = $insert . $numero;
                                }
                        }
                        if ($tipo == "convenio") {
                                while(strlen($numero)<$loop){
                                        $numero = $numero . $insert;
                                }
                        }
                        return $numero;
                    }


                    public static function modulo_10($num) { 
                                $numtotal10 = 0;
                        $fator = 2;

                        // Separacao dos numeros
                        for ($i = strlen($num); $i > 0; $i--) {
                            // pega cada numero isoladamente
                            $numeros[$i] = substr($num,$i-1,1);
                            // Efetua multiplicacao do numero pelo (falor 10)
                            // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Ita�
                            $temp = $numeros[$i] * $fator; 
                            $temp0=0;
                            foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
                            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
                            // monta sequencia para soma dos digitos no (modulo 10)
                            $numtotal10 += $parcial10[$i];
                            if ($fator == 2) {
                                $fator = 1;
                            } else {
                                $fator = 2; // intercala fator de multiplicacao (modulo 10)
                            }
                        }

                        // v�rias linhas removidas, vide fun��o original
                        // Calculo do modulo 10
                        $resto = $numtotal10 % 10;
                        $digito = 10 - $resto;
                        if ($resto == 0) {
                            $digito = 0;
                        }

                        return $digito;

                    }


                    public static function modulo_11($num, $base=9, $r=0)  {
                        /**
                         *   Autor:
                         *           Pablo Costa <pablo@users.sourceforge.net>
                         *
                         *   Fun��o:
                         *    Calculo do Modulo 11 para geracao do digito verificador 
                         *    de boletos bancarios conforme documentos obtidos 
                         *    da Febraban - www.febraban.org.br 
                         *
                         *   Entrada:
                         *     $num: string num�rica para a qual se deseja calcularo digito verificador;
                         *     $base: valor maximo de multiplicacao [2-$base]
                         *     $r: quando especificado um devolve somente o resto
                         *
                         *   Sa�da:
                         *     Retorna o Digito verificador.
                         *
                         *   Observa��es:
                         *     - Script desenvolvido sem nenhum reaproveitamento de c�digo pr� existente.
                         *     - Assume-se que a verifica��o do formato das vari�veis de entrada � feita antes da execu��o deste script.
                         */                                        

                        $soma = 0;
                        $fator = 2;

                        /* Separacao dos numeros */
                        for ($i = strlen($num); $i > 0; $i--) {
                            // pega cada numero isoladamente
                            $numeros[$i] = substr($num,$i-1,1);
                            // Efetua multiplicacao do numero pelo falor
                            $parcial[$i] = $numeros[$i] * $fator;
                            // Soma dos digitos
                            $soma += $parcial[$i];
                            if ($fator == $base) {
                                // restaura fator de multiplicacao para 2 
                                $fator = 1;
                            }
                            $fator++;
                        }

                        /* Calculo do modulo 11 */
                        if ($r == 0) {
                            $soma *= 10;
                            $digito = $soma % 11;
                            if ($digito == 10) {
                                $digito = 0;
                            }
                            return $digito;
                        } elseif ($r == 1){
                            $resto = $soma % 11;
                            return $resto;
                        }
                    }


                    protected static function _dateToDays($year,$month,$day) {
                        $century = substr($year, 0, 2);
                        $year = substr($year, 2, 2);
                        if ($month > 2) {
                            $month -= 3;
                        } else {
                            $month += 9;
                            if ($year) {
                                $year--;
                            } else {
                                $year = 99;
                                $century --;
                            }
                        }
                        return ( floor((  146097 * $century)    /  4 ) +
                                floor(( 1461 * $year)        /  4 ) +
                                floor(( 153 * $month +  2) /  5 ) +
                                    $day +  1721119);
                    }

                    public  static function xnFatorVencimento($data) {
                //	$data = split("/",$data);
                //        if(count($data)<=1)
                           $data = explode("-",$data);
                        $ano = $data[2];
                        $mes = $data[1];
                        $dia = $data[0];
//                        return self::_dateToDays("1997","10","07");
                        return(abs((self::_dateToDays("1997","10","07")) - (self::_dateToDays($ano, $mes, $dia))));
                    }

                    public static function xnGeraCodigoBanco($numero) {
                        $parte1 = substr($numero, 0, 3);
                        $parte2 = self::modulo_11($parte1);
                        return $parte1 . "-" . $parte2;
                    }

                    public static function esquerda($entra,$comp){
                        return substr($entra,0,$comp);
                    }

                    public static function direita($entra,$comp){
                        return substr($entra,strlen($entra)-$comp,$comp);
                    }



                    /**
                     * 
                     * @param array $aValor  : array com numeros que compoe o codigo de barras
                     */
                    public static function xaBarCode($aValor)
                    {
                        $fino = 1 ;
                        $largo = 3 ;
                        $altura = 50 ;
                        $barcodes[0] = "00110" ;
                        $barcodes[1] = "10001" ;
                        $barcodes[2] = "01001" ;
                        $barcodes[3] = "11000" ;
                        $barcodes[4] = "00101" ;
                        $barcodes[5] = "10100" ;
                        $barcodes[6] = "01100" ;
                        $barcodes[7] = "00011" ;
                        $barcodes[8] = "10010" ;
                        $barcodes[9] = "01010" ;
                        
                        for($f1=9;$f1>=0;$f1--){ 
                            for($f2=9;$f2>=0;$f2--){  
                                $f = ($f1 * 10) + $f2 ;
                                $texto = "" ;
                                for($i=1;$i<6;$i++){ 
                                    $texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
                                }
                                $barcodes[$f] = $texto;
                            }
                        }
                        
                        
                        
                         $aGuardaInicial = '<img src="'.Yii::app()->baseUrl.'/images/boleto/barcod/p.png" width="'.$fino.'" height="'.$altura.'" border="0"/>';
                         $aGuardaInicial .= '<img src="'.Yii::app()->baseUrl.'/images/boleto/barcod/b.png" width="'.$fino.'" height="'.$altura.'" border="0"/>';
                         $aGuardaInicial .= '<img src="'.Yii::app()->baseUrl.'/images/boleto/barcod/p.png" width="'.$fino.'" height="'.$altura.'" border="0"/>';
                         $aGuardaInicial .= '<img src="'.Yii::app()->baseUrl.'/images/boleto/barcod/b.png" width="'.$fino.'" height="'.$altura.'" border="0"/>';
                         $aGuardaInicial .= '<img ';

                        $texto = $aValor;
                        if((strlen($texto) % 2) <> 0){
                            $texto = "0".$texto;
                        }

                        while(strlen($texto)>0)
                        {
                            $i = round(self::esquerda($texto,2));
                            $texto = self::direita($texto,strlen($texto)-2);
                            $f     = $barcodes[$i];
                            for($i=1; $i < 11; $i +=2){
                                if(substr($f,($i-1),1) == "0"){
                                    $f1 = $fino;
                                }
                                else
                                {
                                    $f1 = $largo;
                                }
                                 $aGuardaInicial .= ' src="'.Yii::app()->baseUrl.'/images/boleto/barcod/p.png" width="'.$f1.'" height="'.$altura.'" border="0"/><img';
                                if(substr($f, $i,1) == "0"){
                                    $f2 = $fino;
                                }
                                else{
                                    $f2 = $largo;
                                }
                                $aGuardaInicial .= ' src="'.Yii::app()->baseUrl.'/images/boleto/barcod/b.png" width="'.$f2.'" height="'.$altura.'" border="0"/><img';
                            }
                        }
                        $aGuardaInicial .= ' src="'.Yii::app()->baseUrl.'/images/boleto/barcod/p.png"     width="'.$largo.'" height="'.$altura.'" border="0"/>';
                        $aGuardaInicial .= '<img src="'.Yii::app()->baseUrl.'/images/boleto/barcod/b.png" width="'.$fino.'"  height="'.$altura.'" border="0"/>';
                        $aGuardaInicial .= '<img src="'.Yii::app()->baseUrl.'/images/boleto/barcod/p.png" width="1"          height="'.$altura.'" border="0"/>';
                        return  $aGuardaInicial;
                    }
                    
                    
                    //FUNCOES ITAU ---------------------------------------------------------------------------------------------------------
                    public static function xnDigitoVerificadorBarraItau($aNumero) 
                    {
                        $resto2 = self::modulo_11($aNumero, 9, 1);
                        $digito = 11 - $resto2;
                        if ($digito == 0 || $digito == 1 || $digito == 10  || $digito == 11) 
                        {
                            $dv = 1;
                        } 
                        else 
                            {
                                $dv = $digito;
                            }
                        return $dv;
                    }
                    
                    public static function xaMontaLinhaDigitavelItau($codigo) 
                    {
                        // campo 1
                        $banco    = substr($codigo,0,3);
                        $moeda    = substr($codigo,3,1);
                        $ccc      = substr($codigo,19,3);
                        $ddnnum   = substr($codigo,22,2);
                        $dv1      = self::modulo_10($banco.$moeda.$ccc.$ddnnum);
                        // campo 2
                        $resnnum  = substr($codigo,24,6);
                        $dac1     = substr($codigo,30,1);//modulo_10($agencia.$conta.$carteira.$nnum);
                        $dddag    = substr($codigo,31,3);
                        $dv2      = self::modulo_10($resnnum.$dac1.$dddag);
                        // campo 3
                        $resag    = substr($codigo,34,1);
                        $contadac = substr($codigo,35,6); //substr($codigo,35,5).modulo_10(substr($codigo,35,5));
                        $zeros    = substr($codigo,41,3);
                        $dv3      = self::modulo_10($resag.$contadac.$zeros);
                        // campo 4
                        $dv4      = substr($codigo,4,1);
                        // campo 5
                        $fator    = substr($codigo,5,4);
                        $valor    = substr($codigo,9,10);

                        $campo1 = substr($banco.$moeda.$ccc.$ddnnum.$dv1,0,5) . '.' . substr($banco.$moeda.$ccc.$ddnnum.$dv1,5,5);
                        $campo2 = substr($resnnum.$dac1.$dddag.$dv2,0,5) . '.' . substr($resnnum.$dac1.$dddag.$dv2,5,6);
                        $campo3 = substr($resag.$contadac.$zeros.$dv3,0,5) . '.' . substr($resag.$contadac.$zeros.$dv3,5,6);
                        $campo4 = $dv4;
                        $campo5 = $fator.$valor;

                        return "$campo1 $campo2 $campo3 $campo4 $campo5"; 
                    }
                    
                    //-------------------------------------------------------------------------------------------------------------------
                    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Boleto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
