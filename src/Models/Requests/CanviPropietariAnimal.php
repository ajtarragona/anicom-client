<?php

namespace Ajtarragona\Anicom\Models\Requests;



class CanviPropietariAnimal extends AltaAnimal
{

    protected $extern_params=['nivell','idPkPare'];
        
    public function __construct($id_animal,$id_nou_prop)
    {

        $variables=[
            'ident'=>$id_animal,
            'canvi_prop'=>'S',
            'mateixa_adreca'=>'S',
            'proteccio_dades'=>'S',
            'idPkPare'=>$id_nou_prop,
            'nivell'=>46932
            
        ];
           
        parent::__construct($variables);
    }
}
