<?php namespace Gravatari\Api;

use Gravatari\Api;
use Gravatari\UrlGenerator;
use InvalidArgumentException;

class Image extends Api {
    
    /**
     * Fluent container
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
    protected $urlTemplate = "www.gravatar.com/avatar/%s%s";

    /**
     * The settable options
     *
     * @var array
     */
    protected $options = array(
        'size' => 's',
        'default' => 'd',
        'forceDefault' => 'f',
        'rating' => 'r',
    );

    /**
     * Set a value in the container
     *
     * @param  string $key
     * @param  mixed  $value
     *
     * @return void
     */
    protected function set($key, $value)
    {
        if ($key == 'default') $value = urlencode($value);

        $this->container->{$key} = $value;
    }

    /**
     * Get the urlGenerator instance
     *
     * @return Gravatari/UrlGenerator
     */
    public function getUrlGenerator()
    {
        return $this->urlGenerator;
    }

    /**
     * Generate url for an email
     *
     * @param  string $email
     * @param  bool   $secure
     * @retrn  string
     */
    public function url($email, $secure = null)
    {
        $hash   = $this->hash($email);
        $params = $this->compileParams();
        $url    = $this->urlGenerator->make(array($hash, $params), $secure);

        return $url;
    }

    /**
     * Generate secure url for an email
     *
     * @param  string $email
     * @return string
     */
    public function urlSecure($email)
    {
        return $this->url($email, true);
    }

    /**
     * Compile params into query string
     *
     * @return string
     */
    protected function compileParams()
    {
        $options = array();

        foreach ($this->options as $option => $abbrev)
        {
            if ($value = $this->container->get($option, false))
            {
                $options[] = "$abbrev=$value";
            }
        }

        if (count($options) == 0) return '';

        return '?'.implode($options, '&');

        return $params;
    }

    /**
     * Magic call method
     *
     * @param  string $method
     * @param  array  $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if ( ! in_array($method, array_keys($this->options)))
        {
            throw new InvalidArgumentException("[$method] is not a valid attribute");
        }

        if (isset($arguments[0]))
        {
            $this->set($method, $arguments[0]);
        }
        else
        {
            return $this->container->get($method);
        }

        return $this;
    }
}
