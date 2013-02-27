<?php namespace Gravatari\Extension\Laravel;

use Illuminate\Support\ServiceProvider;
use Gravatari\Api\Image;

class GravatariServiceProvider extends ServiceProvider {

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function register()
    {
        $app = $this->app;

        $app['gravatari.image'] = $app->share(function($app)
        {
            return new Image;
        });
    }
}
