<?php
namespace View\ExamplePHP;

use RudyMas\HTML5\HTML5;

/**
 * Class IndexView
 * @package View\ExamplePHP
 *
 * You can name your namespace anything you want, but the default way to do it, is by adding the folder name to the
 * View namespace.
 */
class IndexView extends HTML5
{
    /**
     * @var string
     */
    private $output;

    /**
     * IndexView constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct('nl-BE');
        $this->output = parent::head('start', 'EasyMVC Example Page', 'Rudy Mas', 'rudy.mas@rudymas.be',
            'EasyMVC, example, page', 'Example of a HTML5 PHP page');
        $this->output .= parent::head('stop');

        $this->output .= parent::body('start');
        $this->output .= parent::h3('full', '', '', '', 'Help function');
        $this->output .= parent::p('full', '', '', '', 'If you need help with a HTML-tag, use "parent::&lt;HTML-tag&gt;(\'!help!\');" inside your code.');
        $this->output .= parent::p('full', '', '', '', 'Keep in mind that this will abort the output and only display the information about the tag.');
        $this->output .= $this->p('full', '', '', '', 'You can also use: "$this->&lt;HTML-tag&gt;(...);');
        $this->output .= parent::body('stop');

        echo $this->output;
    }
}
/** End of File: IndexView.php **/