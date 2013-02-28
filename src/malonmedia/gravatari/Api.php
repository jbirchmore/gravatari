<?php namespace Gravatari;

use Illuminate\Support\Fluent;

class Api {

    /**
     * The fluent container
     *
     * @var Illuminate\Support\Fluent
     */
    protected $container;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->container = new Fluent;
    }

    /**
     * Hash a string
     *
     * @param  string $value
     * @return string
     */
    public function hash($value)
    {
        return md5(strtolower(trim($value)));
    }

    /**
     * Get the container instance
     *
     * @return Illuminate\Support\Fluent
     */
    public function getContainer()
    {
        return $this->container;
    }
}
