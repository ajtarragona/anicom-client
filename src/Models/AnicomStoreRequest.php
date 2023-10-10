<?php

namespace Ajtarragona\Anicom\Models;

use SoapVar;

class AnicomStoreRequest extends AnicomRequest{

		
        protected $body_name="altaV2";
        protected $param_ids = [];
        protected $xml_params=true;

        protected $extern_params=[];
        
        public function __construct( $parametres=[] )
        {
            parent::__construct($parametres);
        }
        
        public function parameters(){
            $params=[];
            foreach($this->parametres as $key=>$value){
                if(is_numeric($key) || isset($this->param_ids[$key])){
                    $params[] = [
                        'codi'=> $this->param_ids[$key]??$key ,
                        'valor' => $value
                    ];
                }
            }

            $ocurrencies =[
                'varArray'=>$params,
                'nivell' => 1,
                "idOcurrencia" => -1,
                "idOcurrenciaPare" => -1,
            ];

            foreach($this->extern_params as $key){
                if(isset($this->parametres[$key])){
                    $ocurrencies[$key]=$this->parametres[$key];
                }
            }
            
            
            $ret= [
                "registre" => [
                    "varOcurrencies"=>$ocurrencies,
                    "idRegistre" => $this->idRegistre,
                ]
            ];

          
       
            // dd($ret);

            return $ret;
        }
}
	