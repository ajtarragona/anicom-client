<?php

namespace Ajtarragona\Anicom\Models; 
use Ajtarragona\Anicom\Models\AnicomObject;
use Exception;
use Illuminate\Support\Facades\Log;
use SoapClient;
use XMLWriter;
use Illuminate\Support\Str;
use SoapVar;

abstract class AnicomRequest{

		protected $idRegistre;
		protected $usuari;
		protected $pwd;
		protected $aplicacio;
        
        protected $parametres=[];
        
		protected $xml;
		protected $config;
        protected $body_name="query";
        protected $xml_params=false;
        protected $param_ids=[];

        public function __construct( $parametres=[])
        {
            $this->parametres=$parametres;
            $environment=config("anicom.environment");
            $this->config=config('anicom.environments.'.$environment);

            $this->idRegistre= $this->config['id_registre'];
            $this->usuari=$this->config['ws_user'];
            $this->pwd=$this->config['ws_pwd'];
            $this->aplicacio=$this->config['id_aplicacio'];
            $this->xml=new XMLWriter();

        }

        
        public function start($name){
            $this->xml->startElement($name);
        }

        public function end($name=null){
            $this->xml->endElement();
        }
        
        public function addElement($name,$text=null,$attributes=[]){
            $this->xml->startElement($name);
            if($attributes){
                foreach($attributes as $key=>$value){
                    $this->xml->startAttribute($key);
                    $this->xml->text($value);
                }
            }

            if($text) $this->xml->text($text);
            $this->xml->endElement();
        }


        public abstract function parameters();
        
        public function toParams(){
            $ret=[
                "usuari" => $this->usuari,
                "pwd" => $this->pwd,
                "aplicacio" => "ANICOM"
            ];
            $params=$this->parameters();
            if($params){
                $ret=array_merge($params,$ret);
            }
            return $ret;
        }


        public function toXml($params=[],$open=true,$declaration=true){

            
            // $first=false;
            if($open){
                // $first=true;
                $this->xml=new XMLWriter();
                $this->xml->openMemory();
                if($declaration) $this->xml->startDocument("1.0");
            }
            if(!$params) $params=$this->toParams();

            
            foreach($params as $key=>$value){
              
                if(is_array($value)){
                    if(array_is_list($value)){
                        foreach($value as $attributes){
                            $this->addElement($key,null,$attributes);
                        }
                    }else{
                        $this->start($key);
                        $this->toXml($value,false);
                        $this->end();
                    }
                }else{
                    
                        $this->addElement($key,$value);
                    
                }
           
            }

            if($open){
                if($declaration) $this->xml->endDocument();
                return  $this->xml->outputMemory();
            }
        }




        public function getParamName($id){
            foreach($this->param_ids as $key=>$value){
                if($value==$id) return $key;
            }
            return $id;
        }

        public function parseReturn($attributes){
            $ret=[];
            foreach($attributes as $attribute){
                if(!$attribute->nom && $attribute->codi){
                    $nom = $this->getParamName($attribute->codi);
                    if($nom!=$attribute->codi){
                        $valor=$attribute->valor;
                        $ret[Str::slug($nom,'_')] = $valor;
                    }
                }else{
                    $nom=$attribute->nom;
                    $valor=$attribute->descripcio;
                    $ret[Str::slug($nom,'_')] = $valor;
                }
            }
            return json_decode(json_encode($ret),false);
        }

        public function send(){
            $client   = new SoapClient($this->config['ws_url'].'?wsdl',  array("trace" => 1));

            $client->__setLocation($this->config['ws_url']);
            $ret=[];

            
            try{
                $params=$this->toParams();
                

                if($this->xml_params){
                    $tmp=[];
                    foreach($params as $key=>$value){
                        if(is_array($value)){
                            $tmp[]= new SoapVar( $this->toXml([$key=>$value],true,false), XSD_ANYXML );
                        }else{
                            $tmp[]= new SoapVar($value, XSD_STRING,null,null,$key);

                        }

                    }
                    // dd($tmp);
                    $params=$tmp;
                }
                
                if(config('anicom.debug')){
                    Log::debug('ANICOM - Calling: '. $this->config['ws_url'] .":".$this->body_name);
                    Log::debug('ANICOM - Params: '. $this->toXml());
                }
                dd($params, $this->toXml());
                // dump($params);
                // dd($params,$this->toXml());
                $response = $client->__soapCall($this->body_name, $params );
                
                if(config('anicom.debug')){
                    Log::debug('ANICOM - Response: '. json_encode($response, JSON_PRETTY_PRINT));

                }
                // dd($response);


                if (isset($response->errors) && isset($response->errors->error)){
                    $errors=$response->errors->error;
                    if(!is_array($errors)) $errors=[$errors];

                    $errors=collect($errors)->pluck('missatge')->toArray();
                    $ret =  ["success" => false, "message" => $errors];

                }else if ( $response->varOcurrencies->varArray ?? null){
                    $return=$this->parseReturn($response->varOcurrencies->varArray);
                    $ret = ["success" => true, "return" => $return];
                }else if (($response->varOcurrencia->idOcurrencia??-1) > 0 && ($response->varOcurrencia->varArray ?? null) ){
                    $return=$this->parseReturn($response->varOcurrencia->varArray);
                    $ret = ["success" => true, "return" => $return];
                }else{
                    // dump($response);
                    if($response->error->missatge??null){
                        $ret = ["success" => false, 'codi'=>$response->error->codi??0, "message" => $response->error->missatge];
                    }else{
                        if(!isset($response->varOcurrencia) || (isset($response->varOcurrencia) && !isset($response->varOcurrencia->varArray))){
                            $ret =  ["success" => false, "message" => "No trobat"];
                        }else{
                            $ret =  ["success" => false, "message" => "Error ANICOM desconegut"];
                        }
                   }
                }
                

                //dd($client->__getLastRequest());
            } catch(Exception $e) {
                $ret = ["success" => false, "message" => $e->getMessage()];
            }

            
            
            return json_decode(json_encode($ret),false);
        }
}
	