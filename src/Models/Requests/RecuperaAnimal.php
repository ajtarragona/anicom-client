<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomUpdateRequest;
use Carbon\Carbon;


class RecuperaAnimal extends AnicomUpdateRequest 
{
    
    protected $body_name="modificacioV2";

        
    protected $extern_params=['idPk','nivell'];
        

    public function __construct($id_animal)
    {

        $variables=[
            'reactivar_animal'=>'S',
            'idPk'=>$id_animal."N",
            'nivell'=>46932
        ];
           
        parent::__construct($variables);
    }
}
