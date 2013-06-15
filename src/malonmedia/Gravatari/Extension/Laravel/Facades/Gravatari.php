<?php namespace Gravatari\Extension\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Gravatari extends Facade {

    /**
     * Get the registered component
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'gravatari'; }
}
