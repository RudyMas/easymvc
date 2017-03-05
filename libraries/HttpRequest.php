<?php
namespace Library;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class HttpRequest
{
    private $httpClient;
    private $baseUri = '';

    /**
     * HttpRequest constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param string $Url
     * @param string|null $username
     * @param string|null $password
     * @return Response
     */
    public function get(string $Url, string $username = null, string $password = null): Response
    {
        $response = $this->httpClient->request('GET', $this->baseUri . $Url, [
            'auth' => [$username, $password]
        ]);
        return $response;
    }

    /**
     * @param string $Url
     * @param string $body
     * @param string|null $username
     * @param string|null $password
     * @return Response
     */
    public function post(string $Url, string $body, string $username = null, string $password = null): Response
    {
        $response = $this->httpClient->request('POST', $this->baseUri . $Url, [
            'auth' => [$username, $password],
            'headers' => ['Content-Type' => 'application/json', 'accept' => 'application/json'],
            'body' => $body
        ]);
        return $response;
    }

    /**
     * @param string $Url
     * @param string $body
     * @param string|null $username
     * @param string|null $password
     * @return Response
     */
    public function put(string $Url, string $body, string $username = null, string $password = null): Response
    {
        $response = $this->httpClient->request('PUT', $this->baseUri . $Url, [
            'auth' => [$username, $password],
            'headers' => ['content-type' => 'application/json', 'accept' => 'application/json'],
            'body' => $body
        ]);
        return $response;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri(string $baseUri): void
    {
        $this->baseUri = $baseUri;
    }
}