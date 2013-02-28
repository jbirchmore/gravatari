<?php namespace Gravatari\Api;

use Gravatari\Api;
use Gravatari\UrlGenerator;
use Guzzle\Http\Client;
use InvalidArgumentException;

class Profile extends Api {

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
    protected $urlTemplate = "www.gravatar.com/%s%s";

    public function url($email, $format = null, $callback = null)
    {
        $hash   = $this->hash($email);
        $params = $this->buildParams($format, $callback);
        $url    = $this->urlGenerator->make(array($hash, $params));

        return $url;
    }

    public function urlJson($email, $callback = null)
    {
        return $this->url($email, 'json', $callback);
    }

    public function urlXml($email)
    {
        return $this->url($email, 'xml');
    }

    public function urlPhp($email)
    {
        return $this->url($email, 'php');
    }

    public function urlVcf($email)
    {
        return $this->url($email, 'vcf');
    }

    public function urlQr($email)
    {
        return $this->url($email, 'qr');
    }

    private function buildParams($format, $callback = null)
    {
        $format   = $format ? ".$format" : '';
        $callback = $callback ? "?callback=$callback" : '';

        return $format.$callback;
    }

    public function requestJson($email, $callback = null, $client = null)
    {
        $url = $this->urlJson($email, $callback);

        $response = $this->request($url, $client)->getBody();

        return $response;
    }

    protected function request($url, $client = null)
    {
        $client = $client ?: new Client;

        $request = $client->get($url);

        $response = $request->send();

        return $response;
    }

    public function requestPhp($email, $client = null)
    {
        $url = $this->urlPhp($email);

        $response = $this->request($url, $client)->getBody();

        return $response;
    }
}
