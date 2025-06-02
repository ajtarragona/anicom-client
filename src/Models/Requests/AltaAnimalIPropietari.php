<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomStoreRequest;
use Carbon\Carbon;

class AltaAnimalIPropietari extends AnicomStoreRequest 
{

    
    protected $extern_params=['nivell','idOcurrencia','idOcurrenciaPare'];

    
    public function __construct($dades_animal = [], $dades_propietari=[])
    {

        // $example = [
        //     'identificacio' => '123456789012345',    
        //     'lloc_marcatge' => 1,    
        //     'especie' => 1,    //Gos
        //     'sexe' => 1,    //mascle
        //     'raca' => 2,    //fox terrier
        //     'idPkPare' => '11111116T'
        //     'nom_animal'=>'Joselito',
        
        // ];
       
        
        $dades_propietari=$dades_propietari + [
            
            'tipus_persona'=>1,
            'tip_document'=>1,
            'ambit'=>1,
            '157520'=>'ANICOM', //origen_dades
            
        ];

        $reqAnimal=new AltaAnimal($dades_animal);
        $animal= $reqAnimal->parameters()["registre"]["varOcurrencies"];

        // dd("HOLA");
        // dd($animal);

        // $dades_propietari
        
        // dd($variables);
           
        $this->extra_params = ["varOcurrencies"=>$animal];
        parent::__construct($dades_propietari);
        // dd($this->toParams(),$this->toXml());
        // dd($this->toParams(),$this->toXml());
        // $this->generarXmlAltaV2());
    }
}
