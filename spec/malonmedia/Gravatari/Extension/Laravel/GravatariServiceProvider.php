<?php namespace spec\Gravatari\Extension\Laravel;

use PHPSpec2\ObjectBehavior;

class GravatariServiceProvider extends ObjectBehavior
{
    /**
     * @param Illuminate\Foundation\Application $app
     */
    function let($app)
    {
        $this->beConstructedWith($app);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gravatari\Extension\Laravel\GravatariServiceProvider');
    }

    function it_should_register($app)
    {
        $app->offsetSet(ANY_ARGUMENTS)->shouldBeCalled();
        $app->share(ANY_ARGUMENT)->shouldBeCalled();

        $this->register();
    }
}
