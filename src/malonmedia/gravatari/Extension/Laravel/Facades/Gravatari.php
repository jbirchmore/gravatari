<?php namespace Gravatari\Extension\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Gravatari extends Facade {

    protected static function getFacadeAccessor() { return 'gravatari.image'; }
}
