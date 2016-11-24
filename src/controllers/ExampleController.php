<?php
namespace Controller;

use Library\Controller;

/**
 * Class ExampleController
 */
class ExampleController extends Controller
{
    private $text;
    private $data;

    /**
     * Example constructor.
     */
    public function __construct()
    {
        $this->data = [];
        $this->data['personalInfo'][0]['name'] = 'Firstname Lastname';
        $this->data['personalInfo'][0]['address'] = 'Somestreet 5';
        $this->data['personalInfo'][0]['city'] = 'City';
        $this->data['personalInfo'][0]['extra'] = 'Extra Information';
        $this->data['personalInfo'][1]['name'] = 'Firstname2 Lastname2';
        $this->data['personalInfo'][1]['address'] = 'Somestreet 7';
        $this->data['personalInfo'][1]['city'] = 'City2';
        $this->data['personalInfo'][1]['extra'] = 'Extra Information 2';

        $this->text = 'This is text configured in the constructor.';

        // Only use the constructor for output when you don't have any other functions in your class.
        // In most cases, you will use the constructor to initiate other classes or data.
    }

    /**
     * function testAction($var)
     * @param string $var
     */
    public function testAction($var)
    {
        print($this->text.'<br>');
        print('This is text from the function testAction.<br>');
        if (isset($var['name'])) print('Name: '. $var['name']);
    }

    public function showJSONAction()
    {
        $this->renderJSON($this->data);
    }

    public function showXMLAction()
    {
        $this->renderXML($this->data);
    }

    public function showPHPAction()
    {
        $this->renderPHP('Example', $this->data);
    }
}
/** End of File: ExampleController.php **/