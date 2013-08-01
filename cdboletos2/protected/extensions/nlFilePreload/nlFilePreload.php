<?php

class nlFilePreload extends CWidget{
    public $model;
    public $mapeamento;
    public $id;
    public $saida;
    public $view;
    public $clientes;
    public $contas;
    public function init(){
        parent::init();
        Yii::app()->clientScript->registerCoreScript( 'jquery' );
        $this->id = $this->mapeamento['id'];
        $this->saida = '#'.$this->mapeamento['saida'];
        $sClientes = serialize($this->clientes);
        $sContas = serialize($this->contas);
        
         Yii::app()->clientScript->registerScript(CClientScript::POS_LOAD, "
              var tmp = 'saida';
               function LeArquivo(evt){
                var data = evt.target.files;
                var file = data[0];
                var clientes = '".$sClientes."';
                var contas = '".$sContas."';
                var reader = new FileReader();   
                var tmp;

                reader.onload = (function(theFile){
                                                return function(e){
                                                      var nCont = 0;
                                                      aSaida = e.target.result;
			tmp = aSaida.split('\\n');
                                                        $.ajax({
				url:'".Yii::app()->baseUrl."/protected/views/".$this->view.".php',
				dataType: 'html',
				type: 'POST',
				data:{
                                                                                      opc:1,
                                                                                       clientes:clientes,
                                                                                       contas:contas,
                                                                                        Dados:tmp
                                                                        }
                                                            }).done(function(data){
                                                                       var aux = '';
                                                                        for(i = 0 ; i <= tmp.length -1; i++){
                                                                              aux += tmp[i]+'\\n';
                                                                        }
                                                                        $('<span>',{'id':'dados'}).text(aux).appendTo('body').hide();
                                                                        
                                                                        $('".$this->saida."').html(data);
                                                                            
					
				}).fail(function(){alert('Erro de requisicao!');});

		     
                    }
                })(file);
                reader.readAsText(file);
            }

             
                    document.getElementById('Teste').addEventListener('change', LeArquivo, false);
                        
                ");
        
    }
    
    public function run() {
                parent::run();
                echo CHtml::fileField('teste[]','Carregar arquivo de boletos',array('id'=>$this->id));
    
    }
}



?>
