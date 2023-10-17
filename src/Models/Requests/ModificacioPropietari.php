<?php

namespace Ajtarragona\Anicom\Models\Requests;

use Ajtarragona\Anicom\Models\AnicomUpdateRequest;

class ModificacioPropietari extends AnicomUpdateRequest 
{
    protected $body_name="modificacio";



        
    public function __construct($id_propietari, $variables=[])
    {

        // dd($variables);
        $variables=array_merge($variables,[
            'idPk'=>$id_propietari,
            'nivell'=>1
        ]);
           
        parent::__construct($variables);
    }
}
