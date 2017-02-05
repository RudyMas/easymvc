<?php
/**
 * PHP EasyMVC
 * An easy to use MVC PHP Framework.
 *
 * This app uses the following classes:
 *  - DBconnect (composer require rudymas/pdo-ext)
 *  - EasyRouter (composer require rudymas/router)
 *  - HTML5 (composer require rudymas/html5)
 *  - XML_JSON (comoser require rudymas/xml_json)
 *
 * @author      Rudy Mas <rudy.mas@rudymas.be>
 * @copyright   2016-2017, rudymas.be. (http://www.rudymas.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     0.2.3
 */
require(__DIR__.'/vendor/autoload.php');
require(__DIR__.'/config/config.php');

use RudyMas\PDOExt\DBconnect;
use RudyMas\Router\EasyRouter;

if (USE_DATABASE) {
    require(__DIR__.'/config/database.php');
    foreach ($database as $connect) {
        $object = $connect['objectName'];
        $$object = new DBconnect($connect['dbHost'], $connect['dbUsername'],
            $connect['dbPassword'], $connect['dbName'], $connect['dbCharset'], $connect['dbType']);
    }
}

$router = new EasyRouter();
require(__DIR__.'/config/router.php');
try {
    $router->execute();
} catch (Exception $exception) {
    http_response_code($exception->getCode());
    print($exception->getMessage());
}
/** End of File: index.php **/