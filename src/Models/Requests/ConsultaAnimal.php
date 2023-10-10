<?php

namespace Ajtarragona\Anicom\Models\Requests; 
use Ajtarragona\Anicom\Models\AnicomQueryRequest;

class ConsultaAnimal extends AnicomQueryRequest{
    protected static $ID_CONSULTA=78440;

    public function __construct($id_animal)
    {
        parent::__construct(self::$ID_CONSULTA, ['valor1'=>$id_animal]);
    }
    
}

	