<?php

namespace Ajtarragona\Anicom\Models;

use SoapVar;

class AnicomUpdateRequest extends AnicomRequest{

		
        protected $body_name="modificacioV2";
        protected $xml_params=true;

        protected $extern_params=['idPk','nivell'];

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

            $registre =[
                'varArray'=>$params,
                'nivell' => 1,
                "idOcurrencia" => -1,
                "idRegistre" => $this->idRegistre,
            ];

            foreach($this->extern_params as $key){
                if(isset($this->parametres[$key])){
                    $registre[$key]=$this->parametres[$key];
                }
            }
            
            
            $ret= [
                "registre" => $registre,
                   
            ];


          
       
            // dd($ret);

            return $ret;
        }
}
	