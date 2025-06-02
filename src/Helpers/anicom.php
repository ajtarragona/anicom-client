<?php

if (! function_exists('anicom')) {
	function anicom($options=false){
		return new \Ajtarragona\Anicom\Providers\AnicomProvider($options);
	}
}


if (!function_exists('array_is_a_list')) {
    
    /**
     * Check if an array is a list (i.e., has sequential integer keys starting from 0).
     *
     * @param array $arr The array to check.
     * @return bool True if the array is a list, false otherwise.
     */
    function array_is_a_list(array $arr)
    {
        if ($arr === []) {
            return true;
        }
        return array_keys($arr) === range(0, count($arr) - 1);
    }
}

