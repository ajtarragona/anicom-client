<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomStoreRequest;
use Carbon\Carbon;

class AltaAnimal extends AnicomStoreRequest 
{

    
    protected $extern_params=['idPkPare','nivell'];
    
    
    public function __construct($variables = [])
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
       
        
        $variables=$variables + [
            
            'nivell'=>46932,
            'data_alta'=> Carbon::now()->format('d/m/Y'),
            'tip_identificacio'=>1, // XIP
            'lloc_marcatge'=>0,
            'mateixa_adreca'=>'S',
            'canvi_prop'=>'N',
            'proteccio_dades'=>'S',
            "157523"=>'ANICOM', //origen_dades
        ];
        // dd($variables);
           
        parent::__construct($variables);
                // dd($this->toParams(),$this->toXml());

    }
}
