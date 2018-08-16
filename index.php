<?php
/**
 * PHP EasyMVC (PHP version 7.1)
 * An easy to use MVC PHP Framework with Mobile App Support.
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2018, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     0.7.7
 */
session_start();
require_once('vendor/autoload.php');

use EasyMVC\Core\Core;
use EasyMVC\Router\Router;

define('EMVC_VERSION', '0.7.7');
require_once('config/version.php');
require_once('config/server.php');
$Core = new Core();

/**
 * Loading the website by routing
 */
$router = new Router($Core);
require_once('config/router.php');
try {
    $router->execute();
} catch (Exception $exception) {
    http_response_code(500);
    print('EasyMVC : Something went wrong.<br><br>');
    print($exception->getMessage());
}