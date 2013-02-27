<?php namespace Gravatari;

use Illuminate\Support\Fluent;

class Api {

    protected $container;

    public function __construct()
    {
        $this->container = new Fluent;
    }

    public function hash($value)
    {
        return md5(strtolower(trim($value)));
    }

    public function getContainer()
    {
        return $this->container;
    }
}
