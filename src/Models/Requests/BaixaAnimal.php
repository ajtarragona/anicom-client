<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomUpdateRequest;
use Carbon\Carbon;


class BaixaAnimal extends AnicomUpdateRequest 
{
    
    protected $body_name="modificacioV2";

        
    protected $extern_params=['idPk','nivell'];
        

    public function __construct($id_animal, $motiu, $data_baixa=null)
    {

        $variables=[
            'data_baixa'=>$data_baixa?$data_baixa:Carbon::now()->format('d/m/Y'),
            'motiu_baixa'=>$motiu,
            'acreditacio_mort'=>'S',
            'idPk'=>$id_animal."N",
            'nivell'=>46932
        ];
           
        parent::__construct($variables);
    }
}
