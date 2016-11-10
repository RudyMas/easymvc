<?php
/**
 * PHP EasyMVC
 * An easy to use MVC PHP Framework.
 *
 * This app uses the following classes:
 *  - DBconnect (composer require rudymas/pdo-ext)
 *  - EasyRouter (composer require rudymas/router)
 *  - HTML5 (composer require rudymas/html5)
 *  - Monolog (composer require monolog/monolog)
 *
 * @author      Rudy Mas <rudy.mas@rudymas.be>
 * @copyright   2016, rudymas.be. (http://www.rudymas.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     0.1.0
 */
require(__DIR__.'/vendor/autoload.php');
require(__DIR__.'/config/config.php');

use RudyMas\PDOExt\DBconnect;

if (USE_DATABASE) {
    $database = [];
    require(__DIR__.'/config/database.php');
    foreach ($database as $connect) {
        $$connect['objectName'] = new DBconnect($connect['dbHost'], $connect['dbUsername'],
            $connect['dbPassword'], $connect['dbName'], $connect['dbCharset'], $connect['dbType']);
    }
}

require(__DIR__.'/config/router.php');