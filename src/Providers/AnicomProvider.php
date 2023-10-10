<?php

namespace Ajtarragona\Anicom\Providers;

use Ajtarragona\Anicom\Models\Requests\AltaAnimal;
use Ajtarragona\Anicom\Models\Requests\AltaPropietari;
use Ajtarragona\Anicom\Models\Requests\BaixaAnimal;
use Ajtarragona\Anicom\Models\Requests\CanviPropietariAnimal;
use Ajtarragona\Anicom\Models\Requests\ConsultaAnimal;
use Ajtarragona\Anicom\Models\Requests\ConsultaPropietari;
use Ajtarragona\Anicom\Models\Requests\ModificacioAnimal;

class AnicomProvider {
	
	
	public function consultaAnimal($id_animal){
		$ret= new ConsultaAnimal($id_animal);
		return $ret->send();
	}


	public function consultaPropietari($id_propietari){
		$ret= new ConsultaPropietari($id_propietari);
		return $ret->send();
	}


	public function altaPropietari($variables=[]){
		$ret= new AltaPropietari($variables);
		return $ret->send();
	}

	public function altaAnimal($parametres=[]){
		$ret= new AltaAnimal($parametres);
		return $ret->send();
	}

	public function canviPropietari($id_animal,$id_nou_prop){
		$ret= new CanviPropietariAnimal($id_animal,$id_nou_prop);
		return $ret->send();
	}

	
	public function modificacioAnimal($id_animal,$variables=[]){
		$ret= new ModificacioAnimal($id_animal,$variables);
		return $ret->send();
	}

	public function modificacioPropietari($id_propietari){
	}

	public function baixaAnimal($id_animal, $motiu=1,$data=null){
		$ret= new BaixaAnimal($id_animal,$motiu,$data);
		return $ret->send();
	}

}