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

    public function get(string $URL, string $username = null, string $password = null): Response
    {
        $response = $this->httpClient->request('GET', $URL, [
            'auth' => [$username, $password]
        ]);
        return $response;
    }
}