<?php
namespace Controller;

/**
 * Class Example
 */
class ExampleController
{
    /**
     * Example constructor.
     */
    public function __construct()
    {
        print('This is the constructor<br>');
    }

    /**
     * function testAction()
     * @param string $var
     */
    public function testAction($var)
    {
        print('This is the test.<br>');
        if (isset($var['name'])) print('Name: '. $var['name']);
    }
}
//End of File: ExampleController.php **/