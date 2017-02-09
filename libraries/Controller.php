<?php
namespace Library;

use Exception;
use RudyMas\XML_JSON\XML_JSON;
use Twig_Environment;
use Twig_Loader_Filesystem;

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
            case 'HTML':
                $this->renderHTML($page);
                break;
            case 'JSON':
                $this->renderJSON($data, $httpResponseCode);
                break;
            case 'XML':
                $this->renderXML($data, $httpResponseCode);
                break;
            case 'PHP':
                $this->renderPHP($page, $data);
                break;
            case 'TWIG':
                $this->renderTWIG($page, $data);
                break;
            default:
                throw new Exception("<p><b>Exception:</b> Wrong page type ({$type}) given.</p>", 404);
        }
    }

    /**
     * @param string $page Page to redirect to (Can by an URL or a routing directive)
     */
    public function redirect(string $page)
    {
        header('Location: ' . $page);
        exit;
    }

    /**
     * @param string $page HTML page to output to the browser
     */
    private function renderHTML(string $page)
    {
        $display = __DIR__ . '/../src/views/' . $page;
        if (file_exists($display)) {
            readfile($display);
        } else {
            header('HTTP/1.1 404 Not Found');
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
            $jsonData['error']['message'] = 'Error ' . $httpResponseCode . ' has occurred';
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
        list($view, $subpage) = $this->processPhpPage($page);
        if ($subpage == null) {
            new $view($data);
        } else {
            $subpage .= 'Page';
            $loadPage = new $view($data);
            $loadPage->$subpage();
        }
    }

    /**
     * @param string $page
     * @return string
     */
    private function processPhpPage(string $page)
    {
        $view = '\\View';
        $split = explode(':', trim($page, '/'));
        if (count($split) > 1) $subpage = $split[1]; else $subpage = null;
        $class = explode('/', trim($split[0], '/'));
        foreach ($class as $path) {
            $view .= "\\{$path}";
        }
        return [$view, $subpage];
    }

    /**
     * @param string $page
     * @param array $data
     */
    private function renderTWIG(string $page, array $data)
    {
        $loader = new Twig_Loader_Filesystem('src/views');
        $twig = new Twig_Environment($loader);
        $twig->display($page, $data);
    }
}

/** End of File: Controller.php **/