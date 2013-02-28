<?php namespace spec\Gravatari\Api;

use PHPSpec2\ObjectBehavior;

class Profile extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gravatari\Api\Profile');
    }

    function it_should_make_url()
    {
        $this->url('foo@foo.com')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1');
    }

    function it_should_make_json_url()
    {
        $this->urlJson('foo@foo.com')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.json');
    }

    function it_should_make_json_url_with_callback()
    {
        $this->urlJson('foo@foo.com', 'alert')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.json?callback=alert');
    }

    function it_should_make_xml_url()
    {
        $this->urlXml('foo@foo.com')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.xml');
    }

    function it_should_make_php_url()
    {
        $this->urlPhp('foo@foo.com')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.php');
    }

    function it_should_make_vcf_url()
    {
        $this->urlVcf('foo@foo.com')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.vcf');
    }

    function it_should_make_qr_url()
    {
        $this->urlQr('foo@foo.com')->shouldReturn('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.qr');
    }

    function it_should_make_json_request($client, $request, $response)
    {
        $json = json_encode(array('foo' => 'bar', 'bar' => 'foo'));
        $response->getBody()->willReturn($json);
        $request->send()->willReturn($response);
        $client->get('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.json')->willReturn($request);

        $this->requestJson('foo@foo.com', null, $client);
    }
    
    function it_should_make_xml_request($client, $request, $response)
    {
        $php = serialize(array('foo' => 'bar', 'bar' => 'foo'));
        $response->getBody()->willReturn($php);
        $request->send()->willReturn($response);
        $client->get('http://www.gravatar.com/3717483f26171b61a4e2154fb37ffbd1.php')->willReturn($request);

        $this->requestPhp('foo@foo.com', $client);
    }
}
