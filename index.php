<?php
/**
 * PHP EasyMVC (PHP version 7.2)
 * An easy to use MVC PHP Framework with Mobile App Support.
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2020, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.6.3
 */

use EasyMVC\Core;

session_start();
require_once('vendor/autoload.php');


define('EMVC_VERSION', '1.6.3');
$Core = new Core();
