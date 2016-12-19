<?php
namespace Library;

use Exception;
use RudyMas\XML_JSON\XML_JSON;

/**
 * Class Controller
 * @package Library
 */
class Controller
{
    /**
     * @param string|null $page
     * @param array $data
     * @param string $type
     * @param int $httpResponseCode
     * @throws Exception
     */
    public function render($page, array $data, string $type, int $httpResponseCode = 200)
    {
        switch (strtoupper($type)) {
            case 'JSON':
                $this->renderJSON($data, $httpResponseCode);
                break;
            case 'XML':
                $this->renderXML($data, $httpResponseCode);
                break;
            case 'PHP':
                $this->renderPHP($page, $data);
                break;
            default:
                throw new Exception("<p><b>Exception:</b> Wrong page type ({$type}) given.</p>", 404);
        }
    }

    /**
     * @param array $data Array of data following XML standards
     * @param int $httpResponseCode HTTP response code to send (Default: 200)
     */
    private function renderJSON(array $data, int $httpResponseCode = 200)
    {
        if ($httpResponseCode >= 200 && $httpResponseCode <= 206) {
            $jsonData['data'] = $data;
        } else {
            $jsonData['error']['code'] = $httpResponseCode;
            $jsonData['error']['message'] = 'Error '.$httpResponseCode.' has occurred';
        }

        $convert = new XML_JSON();
        $convert->setArrayData($jsonData);
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
    private function renderXML(array $data, int $httpResponseCode = 200)
    {
        $convert = new XML_JSON();
        $convert->setArrayData($data);
        $convert->array2xml('<xmldata/>');

        http_response_code($httpResponseCode);
        header('Content-Type: application/xml; charset=utf-8');
        print($convert->getXmlData());
    }

    /**
     * @param string $page Name of the HTML5 view class
     * @param array $data array of data to insert on the page
     */
    private function renderPHP(string $page, array $data)
    {
        $view = $this->processPhpPage($page);
        new $view($data);
    }

    /**
     * @param string $page
     * @return string
     */
    private function processPhpPage(string $page)
    {
        $view = '\\View';
        $class = explode('/', trim($page, '/'));
        foreach ($class as $path) {
            $view .= "\\{$path}";
        }
        return $view;
    }
}