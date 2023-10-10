<?php

namespace Ajtarragona\Anicom\Models\Requests; 
use Ajtarragona\Anicom\Models\AnicomQueryRequest;

class ConsultaPropietari extends AnicomQueryRequest{
    protected static $ID_CONSULTA=78007;

    public function __construct($id_propietari)
    {
        parent::__construct(self::$ID_CONSULTA, ['valor1'=>$id_propietari]);
    }
    
}

	