<?php namespace Gravatari;

use Illuminate\Support\Fluent;
use Gravatari\UrlGenerator;

class Api {

    /**
     * The fluent container
     *
     * @var Illuminate\Support\Fluent
     */
    protected $container;

    /**
     * The url generator instance
     *
     * @var Gravatari\UrlGenerator
     */
    protected $urlGenerator;

    /**
     * Template for generating url
     *
     * @var string
     */
    protected $urlTemplate = "www.gravatar.com/%s%s";

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(UrlGenerator $urlGenerator = null)
    {
        $this->container = new Fluent;

        $this->urlGenerator = $urlGenerator ?: new UrlGenerator;

        $this->urlGenerator->setTemplate($this->urlTemplate);
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
