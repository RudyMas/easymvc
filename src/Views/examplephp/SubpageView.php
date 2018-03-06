<?php
namespace View\ExamplePHP;

use RudyMas\HTML5\HTML5;

/**
 * Class SubpageView
 * @package View\ExamplePHP
 *
 * You can name your namespace anything you want, but the default way to do it, is by adding the folder name to the
 * View namespace.
 */
class SubpageView extends HTML5
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var string
     */
    private $output;

    /**
     * SubpageView constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct('nl-BE');
        $this->output = parent::head('start', 'EasyMVC Example Page', 'Rudy Mas', 'rudy.mas@rudymas.be',
            'EasyMVC, example, page', 'Example of a HTML5 PHP page');
        $this->output .= parent::head('stop');
        $this->output .= parent::body('start');
    }

    /**
     * SubpageView deconstruct.
     */
    public function __destruct()
    {
        $this->output .= parent::body('stop');
        echo $this->output;
        parent::__destruct();
    }

    public function infoPage()
    {
        $this->output .= parent::h3('full', '', '', '', 'Help function');
        $this->output .= parent::p('full', '', '', '', 'If you need help with a HTML-tag, use "parent::&lt;HTML-tag&gt;(\'!help!\');" inside your code.');
        $this->output .= parent::p('full', '', '', '', 'Keep in mind that this will abort the output and only display the information about the tag.');
        $this->output .= $this->p('full', '', '', '', 'You can also use: "$this->&lt;HTML-tag&gt;(...);');
    }

    public function tablePage()
    {
        $this->output .= parent::h4('full', '', '', '', '<u>Tabel $data</u>');
        $this->output .= parent::table('start');
        $this->output .= parent::thead('start');
        $this->output .= parent::tr('start');
        $this->output .= parent::th('full', '', '', '', '[name]');
        $this->output .= parent::th('full', '', '', '', '[address]');
        $this->output .= parent::th('full', '', '', '', '[city]');
        $this->output .= parent::th('full', '', '', '', '[extra]');
        $this->output .= parent::tr('stop');
        $this->output .= parent::thead('start');
        $this->output .= parent::tbody('start');
        foreach ($this->data['member'] as $member) {
            $this->output .= parent::tr('start');
            $this->output .= parent::td('full', '', '', '', $member['name']);
            $this->output .= parent::td('full', '', '', '', $member['address']);
            $this->output .= parent::td('full', '', '', '', $member['city']);
            $this->output .= parent::td('full', '', '', '', $member['extra']);
            $this->output .= parent::tr('stop');
        }
        $this->output .= parent::tbody('start');
        $this->output .= parent::table('stop');
    }
}
/** End of File: SubpageView.php **/