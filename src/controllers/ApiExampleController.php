<?php
namespace Controller;

use GuzzleHttp\Exception\RequestException;
use Library\Controller;
use RudyMas\XML_JSON\XML_JSON;

class ApiExampleController extends Controller
{
    private $http;

    public function __construct($args)
    {
        $this->http = $args['http'];
    }

    public function getOverviewAction(): void
    {
        $json = new XML_JSON();
        try {
            $response = $this->http->get('GET', 'http://webapi.rmfoto.be/api/habits/1');
            $json->setJsonData($response->getBody(), 'overview');
            $json->json2array();
            $this->render(null, $json->getArrayData(), 'JSON');
            exit;
        } catch (RequestException $exception) {
            print('<pre>');
            print_r($exception->getMessage());
            print('</pre>');
            exit;
        }
    }
}