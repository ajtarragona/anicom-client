<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomStoreRequest;

class AltaPropietari extends AnicomStoreRequest 
{



    public function __construct($variables = [])
    {

        // $example = [
        //     'tipus_persona' => 1,    
        //     'tip_document' => 1,    
        //     'document' => '47762271B',    
        //     'nom' => 'TXOMIN',    
        //     'cognoms' => 'MEDRANO MARTORELL',    
        //     'rao_social' => '',    
        //     'sexe' => 2,    
        //     'ambit' => 1,    
        //     'tipus_via' => 1,    
        //     'via' => 'FAKE STREET',   
        //     'numero' => 1,   
        //     'municipi' => 17118,    
        //     'telefon' => '666666666'
        // ];
        
        $variables=$variables + 
        [
            'tipus_persona'=>1,
            'tip_document'=>1,
            'ambit'=>1,
            '157520'=>'ANICOM', //origen_dades
        ];
        parent::__construct($variables);
    }
}
