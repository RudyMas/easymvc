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

        $this->text = '<!DOCTYPE html>';
        $this->text .= '<html lang="en">';
        $this->text .= '<head>';
        $this->text .= '<meta charset="UTF-8">';
        $this->text .= '<title>EasyMVC Text</title>';
        $this->text .= '</head>';
        $this->text .= '<body>';
        $this->text .= '<h2>Text to be used in a function</h2>';
        $this->text .= '<p>Text created inside the constructor can be used in all the other functions. You should probably only use it to set the head part of the HTML page.</p>';
    }

    public function helpAction(): void
    {
        $this->render('help.html', [], 'HTML');
    }

    /**
     * function testAction($var)
     * @param array $var
     */
    public function testAction(array $var): void
    {
        print($this->text);
        print('<p>This is text from the function testAction.</p>');
        if (isset($var['name'])) print('<p>Name: ' . $var['name'] . '</p>');
        print('</body>');
        print('</html>');
    }

    public function redirectAction(): void
    {
        $this->redirect('/text/Redirect');
    }

    public function showJSONAction(): void
    {
        $this->render(null, $this->data, 'JSON');
    }

    public function showXMLAction(): void
    {
        $this->render(null, $this->data, 'XML');
    }

    public function showPHPAction(): void
    {
        $this->render('ExamplePHP/IndexView', $this->data, 'PHP');
    }

    public function infoPHPAction(): void
    {
        $this->render('ExamplePHP/SubpageView:info', $this->data, 'PHP');
    }

    public function tablePHPAction(): void
    {
        $this->render('ExamplePHP/SubpageView:table', $this->data, 'PHP');
    }

    public function showTwigAction(): void
    {
        $this->render('ExampleTWIG/index.twig', $this->data, 'TWIG');
    }

    public function infoTwigAction(): void
    {
        $this->render('ExampleTWIG/info.twig', $this->data, 'TWIG');
    }

    public function tableTwigAction(): void
    {
        $this->render('ExampleTWIG/table.twig', $this->data, 'TWIG');
    }
}

/** End of File: ExampleController.php **/