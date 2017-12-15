<?php
/**
 * PHP EasyMVC (PHP version 7.1)
 * An easy to use MVC PHP Framework.
 *
 * This app uses the following classes: (composer.json provided)
 *  - DBconnect (rudymas/pdo-ext)
 *  - EasyRouter (rudymas/router)
 *  - HTML5 (rudymas/html5)
 *  - XML_JSON (rudymas/xml_json)
 *  - Text (rudymas/manipulator)
 *  - Twig (twig/twig)
 *  - Guzzle (guzzlehttp/guzzle)
 *  - Nette (nette/mail)
 *  - Latte (latte/latte)
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     0.9.0
 */
session_start();
require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/config/config.php');

use RudyMas\PDOExt\DBconnect;
use RudyMas\Router\EasyRouter;

/**
 * Creating some easy to use constant variables
 */
$arrayServerName = explode('.', $_SERVER['SERVER_NAME']);
$scriptName = rtrim(str_replace($arrayServerName, '', dirname($_SERVER['SCRIPT_NAME'])), '/\\');
define('BASE_URL', $scriptName);

/**
 * Loading the Database(s) configured in database.php
 */
if (USE_DATABASE) {
    $database = [];
    include(__DIR__ . '/config/database.php');
    foreach ($database as $connect) {
        $object = $connect['objectName'];
        $$object = new DBconnect($connect['dbHost'], $connect['port'], $connect['dbUsername'],
            $connect['dbPassword'], $connect['dbName'], $connect['dbCharset'], $connect['dbType']);
    }
}

/**
 * Processing the URL through the EasyRouter Class
 */
if (isset($DBconnect)) {
    $router = new EasyRouter($DBconnect);
} else {
    $router = new EasyRouter();
}
require(__DIR__ . '/config/router.php');
try {
    $router->execute();
} catch (Exception $exception) {
    http_response_code(500);
    print($exception->getMessage());
}

/** End of File: index.php **/