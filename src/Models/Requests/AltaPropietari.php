<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomStoreRequest;

class AltaPropietari extends AnicomStoreRequest
{



    protected $param_ids = [
        'tipus_persona' => 155479,
        'tip_ident' => 155447,
        'ident' => 9,
        'nom' => 10,
        'cognoms' => 11,
        'rao_social' => 72,
        'sexe' => 155448,
        'tip_ident_repres' => 155449,
        'ident_repres' => 47,
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


    public function __construct($variables = [])
    {

        // $example = [
        //     'tipus_persona' => 1,    
        //     'tip_ident' => 1,    
        //     'ident' => '47762271B',    
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
            'tip_ident'=>1,
            'ambit'=>1,
            '157520'=>'ANICOM', //origen_dades
        ];
        parent::__construct($variables);
    }
}
