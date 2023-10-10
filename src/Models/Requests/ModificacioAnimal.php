<?php

namespace Ajtarragona\Anicom\Models\Requests;



class ModificacioAnimal extends AltaAnimal
{
    
    protected $body_name="modificacioV2";

        
    protected $extern_params=['idPk','nivell'];
        
    public function __construct($id_animal,$variables=[])
    {

        $variables=array_merge($variables,[
            'idPk'=>$id_animal,
            'nivell'=>46932
        ]);
           
        parent::__construct($variables);
    }
}
