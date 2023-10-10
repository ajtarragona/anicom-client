<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomStoreRequest;
use Carbon\Carbon;

class AltaAnimal extends AnicomStoreRequest
{

    protected $param_ids = [
        'data_alta' => 157238,
        'tip_ident' => 157245,
        'ident' => 157246,
        'lloc_marcatge' => 157247,
        'especie' => 157248,
        'sexe' => 157249,
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
        'tipus_via' => 157268,
        'via' => 157269,
        'numero' => 157270,
        'bloc' => 157271,
        'escala' => 157272,
        'pis' => 157273,
        'porta' => 157274,
        'municipi' => 157276,
        'codi_postal' => 157277,
        'observacions' => 157282,
        'proteccio_dades' => 157513,
        'canvi_prop' => 240223,
        'data_baixa' => 157240,
        'motiu_baixa' => 157243,
        'acreditacio_mort' => 147241,
        'reactivar_animal' => 335186,
    ];


    protected $extern_params=['idPkPare'];
    
    
    public function __construct($variables = [])
    {

        // $example = [
        //     'ident' => '123456789012345',    
        //     'lloc_marcatge' => 1,    
        //     'especie' => 1,    //Gos
        //     'sexe' => 1,    //mascle
        //     'raca' => 2,    //fox terrier
        //     'idPkPare' => '11111116T'
        
        // ];
       
        
        $variables=$variables + [
            'data_alta'=> Carbon::now()->format('d/m/Y'),
            'tip_ident'=>1, // XIP
            'lloc_marcatge'=>0,
            'mateixa_adreca'=>'S',
            'canvi_prop'=>'N',
            'proteccio_dades'=>'S',
            "157523"=>'ANICOM', //origen_dades
        ];
        // dd($variables);
           
        parent::__construct($variables);
    }
}
