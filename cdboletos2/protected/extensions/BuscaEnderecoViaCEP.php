<?php

# Baseado no código do site: http://www.eliezer.com.br/post/busca-de-cep-no-seu-form-apenas-com-javascript/

class BuscaEnderecoViaCEP extends CWidget {
        public $model;
        public $mapeamento;
        public $cepID;
        public $enderecoID;
        public $cidadeID;
        public $bairroID;
        public $ufID;
        public $tipo;
        public $label;
        
        public function init() {                
                parent::init();
                
                Yii::app()->clientScript->registerCoreScript( 'jquery' );
                
                if (!isset($this->tipo))
                        $this->tipo='button';
                
                if (!isset($this->label))
                        $this->label='Consultar';
                
                $this->cepID=CHtml::activeId($this->model,$this->mapeamento['cep']);
                $this->enderecoID=CHtml::activeId($this->model,$this->mapeamento['endereco']);
                $this->cidadeID=CHtml::activeId($this->model,$this->mapeamento['cidade']);
                $this->bairroID=CHtml::activeId($this->model,$this->mapeamento['bairro']);
                $this->ufID=CHtml::activeId($this->model,$this->mapeamento['uf']);
                
                Yii::app()->clientScript->registerScript(CClientScript::POS_LOAD, '
                        $("#ConsultaEndereco").on("click", function(event) {
                                $("#'.$this->cepID.'").attr("disabled","true");
                                $("#'.$this->enderecoID.'").attr("disabled","true");
                                $("#'.$this->cidadeID.'").attr("disabled","true");
                                $("#'.$this->bairroID.'").attr("disabled","true");
                                $("#'.$this->ufID.'").attr("disabled","true");

                                $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#'.$this->cepID.'").val(), function() {
                                        // o getScript dá um eval no script, então é só ler!
                                        //Se o resultado for igual a 1
                                        if(resultadoCEP["resultado"]) {
                                                $("#'.$this->cepID.'").removeAttr("disabled");
                                                $("#'.$this->enderecoID.'").removeAttr("disabled");
                                                $("#'.$this->cidadeID.'").removeAttr("disabled");
                                                $("#'.$this->bairroID.'").removeAttr("disabled");
                                                $("#'.$this->ufID.'").removeAttr("disabled");

                                                $("#'.$this->enderecoID.'").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                                                $("#'.$this->bairroID.'").val(unescape(resultadoCEP["bairro"]));
                                                $("#'.$this->cidadeID.'").val(unescape(resultadoCEP["cidade"]));
                                                $("#'.$this->ufID.'").val(unescape(resultadoCEP["uf"]));
                                        }
                                });
                                return false;
                        });
                ');
        }
        
        public function returnButton(){
            $class=array('id'=>'ConsultaEndereco','class'=>'btn btn-primary');
            return CHtml::button($this->label,$class);
            
        }

        public function run() {
                parent::run();
                
                $class=array('class'=>'ConsultaEndereco');
                
//                if ($this->tipo=='button')
//                        echo  CHtml::button($this->label,$class);
//                elseif ($this->tipo=='link')
//                        echo CHtml::link($this->label,'#',$class);
        }
}
?>