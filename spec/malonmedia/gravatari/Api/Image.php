<?php namespace spec\Gravatari\Api;

use PHPSpec2\ObjectBehavior;

class Image extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gravatari\Api\Image');
    }

    function it_should_throw_exception_for_invalid_option()
    {
        $this->shouldThrow(new \InvalidArgumentException("[invalidOption] is not a valid attribute"))
            ->duringInvalidOption();
    }

    function it_should_set_valid_option()
    {
        $this->email('foo@foo.com');

        $this->email()->shouldReturn('foo@foo.com');
    }

    function it_should_set_url_generator()
    {
        $this->getUrlGenerator()->shouldBeAnInstanceOf('Gravatari\UrlGenerator');
    }

    function it_should_get_url()
    {
        $this->email('foo@foo.com')
            ->size(120)
            ->rating('g')
            ->url()->shouldReturn('http://www.gravatar.com/avatar/3717483f26171b61a4e2154fb37ffbd1?s=120&r=g');
    }

    function it_should_get_secured_url()
    {
        $this->email('foo@foo.com')
            ->size(120)
            ->rating('g')
            ->urlSecure()->shouldReturn('https://www.gravatar.com/avatar/3717483f26171b61a4e2154fb37ffbd1?s=120&r=g');
    }

    function it_should_make_url_with_only_email()
    {
        $this->url('foo@foo.com')->shouldReturn('http://www.gravatar.com/avatar/3717483f26171b61a4e2154fb37ffbd1');
    }

    function it_should_url_encode_default()
    {
        $this->default('http://www.foo.com');

        $this->default()->shouldReturn('http%3A%2F%2Fwww.foo.com');
    }
}
