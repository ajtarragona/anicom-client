<?php

if (! function_exists('anicom')) {
	function anicom($options=false){
		return new \Ajtarragona\Anicom\Providers\AnicomProvider($options);
	}
}

