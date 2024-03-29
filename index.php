<?php
/**
 * PHP EasyMVC (PHP version 8.1)
 * An easy to use MVC PHP Framework with Mobile App Support.
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2020, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     8.1.0.0
 */

use EasyMVC\Core;

session_start();
require_once('vendor/autoload.php');


const EMVC_VERSION = '8.1.0.0';
$Core = new Core();
