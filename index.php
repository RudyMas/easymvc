<?php
/**
 * PHP EasyMVC (PHP version 7.0)
 * An easy to use MVC PHP Framework.
 *
 * This app uses the following classes: (composer.json provided)
 *  - DBconnect (composer require rudymas/pdo-ext)
 *  - EasyRouter (composer require rudymas/router)
 *  - HTML5 (composer require rudymas/html5)
 *  - XML_JSON (composer require rudymas/xml_json)
 *  - Text (composer require rudymas/manipulator)
 *  - Twig (composer require twig/twig)
 *  - Guzzle (composer require guzzlehttp/guzzle)
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     0.3.0
 */
session_start([
    'cookie_lifetime' => 10800
]);
require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/config/config.php');

use Library\HttpRequest;
use Library\Login;
use RudyMas\PDOExt\DBconnect;
use RudyMas\Router\EasyRouter;

/**
 * Setting up some easy to use constant variables
 */
define('BASE_URL', dirname($_SERVER['SCRIPT_NAME']));

/**
 * Loading the database(s)
 */
if (USE_DATABASE) {
    require(__DIR__ . '/config/database.php');
    foreach ($database as $connect) {
        $object = $connect['objectName'];
        $$object = new DBconnect($connect['dbHost'], $connect['dbUsername'],
            $connect['dbPassword'], $connect['dbName'], $connect['dbCharset'], $connect['dbType']);
    }
}

/**
 * Setting up the login for the website
 */
if (USE_LOGIN) {
    $login = new Login($database[0]['objectName']);
}

/**
 * Setting up the HttpRequest for the website
 */
if (USE_HTTP_REQUEST) {
    $http = new HttpRequest();
}

/**
 * Setting up the routing for the website
 */
$router = new EasyRouter();
require(__DIR__ . '/config/router.php');
try {
    $router->execute();
} catch (Exception $exception) {
    http_response_code($exception->getCode());
    print($exception->getMessage());
}
/** End of File: index.php **/