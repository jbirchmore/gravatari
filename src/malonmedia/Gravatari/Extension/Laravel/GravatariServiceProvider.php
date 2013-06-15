<?php namespace Gravatari\Extension\Laravel;

use Illuminate\Support\ServiceProvider;
use Gravatari\Api\Image;
use Gravatari\Api\Profile;

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
        list($app, $me) = array($this->app, $this);

        $app['gravatari'] = $app->share(function($app) use ($me)
        {
            return $me;
        });
    }

    /**
     * Create a Profile instance
     *
     * @return Gravatari\Api\Profile
     */
    public function profile()
    {
        return new Profile;
    }

    /**
     * Create an Image instance
     *
     * @return Gravatari\Api\Image
     */
    public function image()
    {
        return new Image;
    }

    /**
     * Magic call method
     *
     * @param  string $method
     * @param  array  $args
     * @return void
     */
    public function __call($method, $args)
    {
        $class = $this->image();

        return call_user_func_array(array($class, $method), $args);
    }
}
