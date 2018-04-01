<?php

namespace Controllers;

use EasyMVC\Controller\Controller;
use Exception;

class EmvcHelpController extends Controller
{
    public function welcomeAction()
    {
        try {
            $this->render('index.twig', [], 'TWIG');
        } catch (Exception $e) {
            $this->checkArray($e->getMessage());
        }
    }
}