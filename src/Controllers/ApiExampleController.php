<?php
namespace Controllers;

use EasyMVC\Controller\Controller;
use GuzzleHttp\Exception\RequestException;
use RudyMas\XML_JSON\XML_JSON;

/**
 * Class ApiExampleController
 * @package Controller
 */
class ApiExampleController extends Controller
{
    private $http, $xmlJson;

    /**
     * ApiExampleController constructor.
     * @param $args
     */
    public function __construct($args)
    {
        $this->http = $args['http'];
        $this->http->setBaseUri('http://webapi.rmfoto.be');
        $this->xmlJson = new XML_JSON();
    }

    public function getOverviewAction(): void
    {
        try {
            $response = $this->http->get('/api/overview');
            $this->xmlJson->setJsonData($response->getBody());
            $this->xmlJson->json2array();
            $this->render(null, $this->xmlJson->getArrayData(), 'JSON');
        } catch (RequestException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @param $vars
     */
    public function getHabitsUserAction($vars): void
    {
        try {
            $response = $this->http->get('/api/habits/' . $vars['userId']);
            $this->xmlJson->setJsonData($response->getBody());
            $this->xmlJson->json2array();
            $this->render(null, $this->xmlJson->getArrayData(), 'JSON');
        } catch (RequestException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @param $vars
     */
    public function setHabitAction($vars): void
    {
        $jsonString = '{"habit_id":1,"completed":true}';
        try {
            $response = $this->http->post('/api/setHabit/' . $vars['userId'], $jsonString);
            $this->redirect('/api/overview');
        } catch (RequestException $exception) {
            die($exception->getMessage());
        }
    }
}

/** End of File: ApiExampleController.php **/