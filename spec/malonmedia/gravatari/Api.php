<?php namespace spec\Gravatari;

use PHPSpec2\ObjectBehavior;

class Api extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gravatari\Api');
    }

    function it_should_set_container()
    {
        $this->getContainer()->shouldBeAnInstanceOf('Illuminate\Support\Fluent');
    }

    function it_should_hash_value()
    {
        $expectation = '3717483f26171b61a4e2154fb37ffbd1';

        $this->hash('foo@foo.com')->shouldReturn($expectation);
        $this->hash('FOO@FOO.COM')->shouldReturn($expectation);
        $this->hash(' foo@foo.com ')->shouldReturn($expectation);
    }
}
