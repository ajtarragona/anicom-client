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
       

        protected $param_ids = [
            'data_alta' => 157238,
            'tip_identificacio' => 157245,
            'identificacio' => 157246,
            'identificacio_canvi' => 331565,
            'lloc_marcatge' => 157247,
            'especie' => 157248,
            'sexe_animal' => 157249,
            'mida' => 157250,
            'data_naixement' => 157251,
            'nom_animal' => 157252,
            'num_placa' => 157253,
            'esterilitzat' => 157254,
            'origen' => 157255,
            'raca' => 157258,
            'varietat_raca' => 344565,
            'raca_progenitor_1' => 157256,
            'raca_progenitor_2' => 157257,
            'perillos' => 157262,
            'assistencia' => 157263,
            'num_colegiat' => 157264,
            'mateixa_adreca' => 157267,
            'tipus_via_anim' => 157268,
            'via_anim' => 157269,
            'numero_anim' => 157270,
            'bloc_anim' => 157271,
            'escala_anim' => 157272,
            'pis_anim' => 157273,
            'porta_anim' => 157274,
            'municipi_anim' => 157276,
            'codi_postal_anim' => 157277,
            'observacions_anim' => 157282,
            'proteccio_dades' => 157513,
            'canvi_prop' => 240223,
            'data_baixa' => 157240,
            'motiu_baixa' => 157243,
            'acreditacio_mort' => 157241, //ojo es esta, no 147241
            'reactivar_animal' => 335186,
    
            'tipus_persona' => 155479,
            'tip_document' => 155447,
            'document' => 9,
            'nom' => 10,
            'cognoms' => 11,
            'rao_social' => 72,
            'sexe' => 155448,
            'tip_document_repres' => 155449,
            'document_repres' => 47,
            'nom_repres' => 41,
            'cognoms_repres' => 42,
            'ambit' => 155635,
            'tipus_via' => 26,
            'via' => 27,
            'numero' => 157212,
            'bloc' => 157166,
            'escala' => 157167,
            'pis' => 157168,
            'porta' => 157169,
            'municipi' => 33,
            'municipi_esp' => 335844,
            'codi_postal' => 157165,
            'poblacio_ext' => 36,
            'pais' => 37,
            'telefon' => 43,
            'telefon2' => 44,
            'telefon3' => 45,
            'email' => 49,
            'email2' => 1,
            'data_llicencia_gpp' => 75,
            'major_18' => 78,
            'observacions' => 68,
            'adreca_completa' => 39,
            'nom_complet' => 157019,
            'nom_municipi' => 157021
            
        ];
        

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
                    Log::debug('ANICOM - Params: '. json_encode($this->toParams(), JSON_PRETTY_PRINT));
                    Log::debug('ANICOM - Params XML: '. $this->toXml());
                }
                // dd($params, $this->toXml());
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
                    $ret =  ["success" => false, "message" => implode("\n",$errors)];

                }else if ( $response->varArray ?? null){
                    $return=$this->parseReturn($response->varArray);
                    $ret = ["success" => true, "return" => $return];
                }else if ( $response->varOcurrencies->varArray ?? null){
                    $return=$this->parseReturn($response->varOcurrencies->varArray);
                    $ret = ["success" => true, "return" => $return];
                }else if (($response->varOcurrencia->idOcurrencia??-1) > 0 && ($response->varOcurrencia->varArray ?? null) ){
                    $return=$this->parseReturn($response->varOcurrencia->varArray);
                    $ret = ["success" => true, "return" => $return];
                }else{
                    // dump($response);
                    if($response->error->missatge??null){
                        $missatge=$response->error->missatge;

                        if(is_array($missatge)) $missatge=implode("\n",$missatge);
                        
                        $ret = ["success" => false, 'codi'=>$response->error->codi??0, "message" => $missatge];
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
	