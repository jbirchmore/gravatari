<?php namespace spec\Gravatari;

use PHPSpec2\ObjectBehavior;

class UrlGenerator extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith('www.foo.com/%s');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gravatari\UrlGenerator');
    }

    function it_should_set_template()
    {
        $this->getTemplate()->shouldReturn('www.foo.com/%s');
    }

    function it_should_make_url()
    {
        $this->make(array('bar'))->shouldReturn('http://www.foo.com/bar');
    }

    function it_should_make_secure_url()
    {
        $this->makeSecure(array('bar'))->shouldReturn('https://www.foo.com/bar');
    }
}
