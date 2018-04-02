<?php

namespace Controllers;

use EasyMVC\Controller\Controller;
use EasyMVC\Core\Core;
use Exception;

class EmvcHelpController extends Controller
{
    private $Core;

    /**
     * EmvcHelpController constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->Core = $args['Core'];
    }

    public function welcomeAction()
    {
        try {
            $this->render('index.twig', [], 'TWIG');
        } catch (Exception $e) {
            $this->checkArray($e->getMessage());
        }
    }
}