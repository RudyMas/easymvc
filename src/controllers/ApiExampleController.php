<?php
namespace Controller;

use GuzzleHttp\Exception\RequestException;
use Library\Controller;
use RudyMas\XML_JSON\XML_JSON;

class ApiExampleController extends Controller
{
    private $http;

    /**
     * ApiExampleController constructor.
     * @param $args
     */
    public function __construct($args)
    {
        $this->http = $args['http'];
    }

    public function getOverviewAction(): void
    {
        $json = new XML_JSON();
        try {
            $response = $this->http->get('http://webapi.rmfoto.be/api/overview');
            $json->setJsonData($response->getBody());
            $json->json2array();
            $this->render(null, $json->getArrayData(), 'JSON');
        } catch (RequestException $exception) {
            die($exception->getMessage());
        }
    }
}