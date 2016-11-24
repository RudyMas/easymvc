<?php
namespace Library;

use RudyMas\XML_JSON\XML_JSON;

/**
 * Class Controller
 * @package Library
 */
class Controller
{
    /**
     * @param array $data Array of data following XML standards
     * @param int $httpResponseCode HTTP response code to send (Default: 200)
     */
    public function renderJSON(array $data, int $httpResponseCode = 200)
    {
        $convert = new XML_JSON();
        $convert->setArrayData($data);
        $convert->array2json();

        http_response_code($httpResponseCode);
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        print($convert->getJsonData());
    }

    /**
     * @param array $data Array of data following XML standards
     * @param int $httpResponseCode HTTP response code to send (Default: 200)
     */
    public function renderXML(array $data, int $httpResponseCode = 200)
    {
        $convert = new XML_JSON();
        $convert->setArrayData($data);
        $convert->array2xml('<data/>');

        http_response_code($httpResponseCode);
        header('Content-Type: application/xml; charset=utf-8');
        print($convert->getXmlData());
    }

    /**
     * @param string $PHPpage Name of the HTML5 view class
     * @param array $data array of data to insert on the page
     */
    public function renderPHP(string $PHPpage, array $data)
    {
        $view = '\\View\\' . $PHPpage . 'View';
        new $view($data);
    }
}