<?php
namespace Controller;

use Library\Controller;

/**
 * Class ExampleController
 */
class ExampleController extends Controller
{
    private $text;
    private $data = [];

    /**
     * Example constructor
     * Only use the constructor for initiating settings to be used inside the controller's functions
     */
    public function __construct()
    {
        $this->data['personalInfo'][0]['name'] = 'Firstname Lastname';
        $this->data['personalInfo'][0]['address'] = 'Somestreet 5';
        $this->data['personalInfo'][0]['city'] = 'City';
        $this->data['personalInfo'][0]['extra'] = 'Extra Information';
        $this->data['personalInfo'][1]['name'] = 'Firstname2 Lastname2';
        $this->data['personalInfo'][1]['address'] = 'Somestreet 7';
        $this->data['personalInfo'][1]['city'] = 'City2';
        $this->data['personalInfo'][1]['extra'] = 'Extra Information 2';

        $this->text = '<h2>Text to be used in a function</h2>';
        $this->text .= '<p>This is created inside the constructor.</p>';
    }

    /**
     * function testAction($var)
     * @param string $var
     */
    public function testAction($var)
    {
        print($this->text);
        print('<p>This is text from the function testAction.</p>');
        if (isset($var['name'])) print('<p>Name: ' . $var['name'] . '</p>');
    }

    public function showJSONAction()
    {
        $this->render(null, $this->data, 'JSON');
    }

    public function showXMLAction()
    {
        $this->render(null, $this->data, 'XML');
    }

    public function showPHPAction()
    {
        $this->render('ExamplePHP/IndexView', $this->data, 'PHP');
    }

    public function infoPHPAction()
    {
        $this->render('ExamplePHP/SubpageView:info', $this->data, 'PHP');
    }

    public function tabelPHPAction()
    {
        $this->render('ExamplePHP/SubpageView:tabel', $this->data, 'PHP');
    }
}

/** End of File: ExampleController.php **/