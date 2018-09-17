<?php

namespace Controllers\version;

use EasyMVC\Controller\Controller;
use Exception;

/**
 * Class VersionController
 * @package Controllers
 */
class VersionController extends Controller
{
    /**
     * To display the version status of EasyMVC and the website
     */
    public function versionAction()
    {
        try {
            $this->render('version/version.twig', [], 'TWIG');
        } catch (Exception $e) {
            $this->checkArray($e->getMessage());
        }
    }
}