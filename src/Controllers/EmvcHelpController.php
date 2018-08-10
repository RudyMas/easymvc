<?php

namespace Controllers;

use EasyMVC\Controller\Controller;

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
}