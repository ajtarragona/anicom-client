<?php

namespace Ajtarragona\Anicom\Models; 

class AnicomQueryRequest extends AnicomRequest{

    protected $idConsulta;
    
    protected $body_name="consulta";

    public function __construct($idConsulta, $parametres=[])
    {
        parent::__construct($parametres);
        $this->idConsulta=$idConsulta;
    }

    
    public function parameters(){
        return [
            "dadesConsulta" => [
                "idConsulta" => $this->idConsulta,
                "idRegistre" => $this->idRegistre,
                'parametre' => $this->parametres,
                "varOcurrencia" => null,
            ]
        ];
    }
}
	