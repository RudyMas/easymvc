<?php
namespace View;

use RudyMas\HTML5\HTML5;

class ExampleView extends HTML5
{
    private $output;

    public function __construct(array $data)
    {
        parent::__construct('nl-BE');
        $this->output = parent::head('start', 'EasyMVC Example Page', 'Rudy Mas', 'rudy.mas@rudymas.be',
            'EasyMVC, example, page', 'Example of a HTML5 PHP page');
        $this->output .= parent::head('stop');

        $this->output .= parent::body('start');
        $this->output .= parent::p('full', '', '', '', 'Als je informatie wenst over het gebruik van een element gebruik dan: parent::&lt;tag&gt;(\'!help\');');
        $this->output .= parent::body('stop');

        echo $this->output;
    }
}