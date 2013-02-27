<?php namespace Gravatari\Api;

use Gravatari\Api;
use Gravatari\UrlGenerator;
use InvalidArgumentException;

class Image extends Api {
    
    protected $container;

    protected $urlGenerator;

    protected $urlTemplate = "www.gravatar.com/avatar/%s%s";

    protected $options = array(
        'size' => 's',
        'default' => 'd',
        'forceDefault' => 'f',
        'rating' => 'r',
    );

    public function __construct()
    {
        parent::__construct($urlGenerator = null);

        $this->urlGenerator = $urlGenerator ?: new UrlGenerator;

        $this->urlGenerator->setTemplate($this->urlTemplate);
    }

    protected function set($key, $value)
    {
        if ($key == 'default') $value = urlencode($value);

        $this->container->{$key} = $value;
    }

    public function getUrlGenerator()
    {
        return $this->urlGenerator;
    }

    public function url($email = null, $secure = null)
    {
        $email  = $email ?: $this->container->email;
        $hash   = $this->hash($email);
        $params = $this->compileParams();
        $url    = $this->urlGenerator->make(array($hash, $params), $secure);

        return $url;
    }

    public function urlSecure($email = null)
    {
        return $this->url($email, true);
    }

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
