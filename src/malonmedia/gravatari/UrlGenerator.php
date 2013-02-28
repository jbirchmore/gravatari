<?php namespace Gravatari;

class UrlGenerator {

    /**
     * Template to be used for generating urls
     *
     * @var string
     */
    protected $template;

    /**
     * Constructor
     * 
     * @param  string $template
     * @return void
     */
    public function __construct($template = '')
    {
        $this->setTemplate($template);
    }

    /**
     * Retrieve the current template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set the template
     *
     * @param  string $template
     * @return void
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * Generate an url
     *
     * @param  array $args
     * @param  bool  $secure
     * @return string
     */
    public function make(array $args = array(), $secure = null)
    {
        $protocol = $secure ? 'https' : 'http';

        $url = "$protocol://".vsprintf($this->template, $args);

        return $url;
    }

    /**
     * Generate a secure url
     *
     * @param  array $args
     * @return string
     */
    public function makeSecure(array $args = array())
    {
        return $this->make($args, true);
    }
}
