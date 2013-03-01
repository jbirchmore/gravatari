<?php namespace Gravatari\Api;

use Gravatari\Api;
use Gravatari\UrlGenerator;
use Guzzle\Http\Client;
use InvalidArgumentException;
use Guzzle\Http\Exception\ClientErrorResponseException;

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

    /**
     * Generate an url
     *
     * @param  string $email
     * @param  string $format
     * @param  string $callback
     *
     * @return string
     */
    public function url($email, $format = null, $callback = null)
    {
        $hash   = $this->hash($email);
        $params = $this->buildParams($format, $callback);
        $url    = $this->urlGenerator->make(array($hash, $params));

        return $url;
    }

    /**
     * Generate a json url
     *
     * @param  string $email
     * @param  string $callback
     *
     * @return string
     */
    public function urlJson($email, $callback = null)
    {
        return $this->url($email, 'json', $callback);
    }

    /**
     * Generate an xml url
     *
     * @param  string $email
     *
     * @return string
     */
    public function urlXml($email)
    {
        return $this->url($email, 'xml');
    }

    /**
     * Generate a php url
     *
     * @param  string $email
     *
     * @return string
     */
    public function urlPhp($email)
    {
        return $this->url($email, 'php');
    }

    /**
     * Generate a VCF/vCard url
     *
     * @param  string $email
     *
     * @return string
     */
    public function urlVcf($email)
    {
        return $this->url($email, 'vcf');
    }

    /**
     * Generate a QR url
     *
     * @param  string $email
     *
     * @return string
     */
    public function urlQr($email)
    {
        return $this->url($email, 'qr');
    }

    /**
     * Build parameter string
     *
     * @param  string $format
     * @param  string $callback
     * @return void
     */
    private function buildParams($format, $callback = null)
    {
        $format   = $format ? ".$format" : '';
        $callback = $callback ? "?callback=$callback" : '';

        return $format.$callback;
    }

    /**
     * Make a json request
     *
     * @param  string $email
     * @param  string $callback
     * @param  string $client
     * @return void
     */
    public function requestJson($email, $callback = null, $client = null)
    {
        $url = $this->urlJson($email, $callback);

        if ( ! $response = $this->request($url, $client))
        {
            return false;
        }

        return $response->getBody();
    }

    /**
     * Make a request
     *
     * @param  string $url
     * @param  string $client
     * @return void
     */
    protected function request($url, $client = null)
    {
        $client = $client ?: new Client;

        $request = $client->get($url);

        try 
        {
            $response = $request->send();
        }
        catch (ClientErrorResponseException $e)
        {
            return false;
        }

        return $response;
    }

    /**
     * Make a php request
     *
     * @param  string $url
     * @param  string $client
     * @return void
     */
    public function requestPhp($email, $client = null)
    {
        $url = $this->urlPhp($email);

        $response = $this->request($url, $client)->getBody();

        return $response;
    }

    /**
     * Make a xml request
     *
     * @param  string $url
     * @param  string $client
     * @return void
     */
    public function requestXml($email, $client = null)
    {
        $url = $this->urlXml($email);

        $response = $this->request($url, $client)->getBody();

        return $response;
    }
}
