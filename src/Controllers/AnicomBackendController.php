<?php

namespace Ajtarragona\Anicom\Controllers; 

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Anicom; //facade
use \Artisan;


class AnicomBackendController extends Controller{

	
	public function index(){
		
			$params=[];
			return view("anicom::index",$params);

			
	}


}