<?php
namespace Library;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class HttpRequest
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function get(string $method, string $URI, string $username = null, string $password = null): Response
    {
        $response = $this->httpClient->request($method, $URI, [
            'auth' => [$username, $password]
        ]);
        return $response;
    }
}