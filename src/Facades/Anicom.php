<?php

namespace Ajtarragona\Anicom\Facades; 

use Illuminate\Support\Facades\Facade;

class Anicom extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'anicom';
    }
}
