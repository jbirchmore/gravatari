<?php namespace Gravatari\Extension\Laravel;

use Illuminate\Support\ServiceProvider;
use Gravatari\Api\Image;

class GravatariServiceProvider extends ServiceProvider {

    /**
     * Application instance
     *
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Constructor
     *
     * @param  Illuminate\Foundation\Application $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app['gravatari.image'] = $app->share(function($app)
        {
            return new Image;
        });
    }
}
