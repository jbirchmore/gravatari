<?php namespace Gravatari;

class UrlGenerator {

    protected $template;

    public function __construct($template = '')
    {
        $this->setTemplate($template);
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function make(array $args = array(), $secure = null)
    {
        $protocol = $secure ? 'https' : 'http';

        $url = "$protocol://".vsprintf($this->template, $args);

        return $url;
    }

    public function makeSecure(array $args = array())
    {
        return $this->make($args, true);
    }
}
