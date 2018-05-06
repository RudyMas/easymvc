<?php

namespace Controllers;

use EasyMVC\Controller\Controller;
use Exception;

/**
 * Class EmvcHelpController
 *
 * @package Controllers
 */
class EmvcHelpController extends Controller
{
    /**
     * EmvcHelpController constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        $Core = $args['Core'];
    }

    /**
     *
     */
    public function welcomeAction()
    {
        try {
            $this->render('index.twig', [], 'TWIG');
        } catch (Exception $e) {
            $this->checkArray($e->getMessage());
        }
    }
}