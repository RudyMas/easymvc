<?php
/**
 * PHP EasyMVC (PHP version 7.1)
 * An easy to use MVC PHP Framework with Mobile App Support.
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2019, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.5.1
 */
session_start();
require_once('vendor/autoload.php');

use EasyMVC\Core\Core;

define('EMVC_VERSION', '1.5.1');
$Core = new Core();
