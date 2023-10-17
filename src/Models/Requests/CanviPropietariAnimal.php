<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomStoreRequest;
use Ajtarragona\Anicom\Models\AnicomUpdateRequest;
use Carbon\Carbon;

class CanviPropietariAnimal extends AnicomStoreRequest
{

    protected $extern_params=['nivell','idPkPare'];
        
    public function __construct($id_animal,$id_nou_prop)
    {

        $variables=[
            'data_alta' => Carbon::now()->format('d/m/Y'),
            'identificacio_canvi'=>$id_animal,
            'canvi_prop'=>'S',
            'mateixa_adreca'=>'S',
            'proteccio_dades'=>'S',
            'idPkPare'=>$id_nou_prop,
            'nivell'=>46932
            
            
        ];
           
        parent::__construct($variables);
    }
}
