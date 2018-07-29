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
    public function versionAction()
    {
        try {
            $this->render('version.twig', [], 'TWIG');
        } catch (Exception $e) {
            $this->checkArray($e->getMessage());
        }
    }
}