<?php
/**
 * This file is used to setup the develop & production server.
 * Set these parameters to reflect your environment in which you work.
 * SERVER_DEVELOP is used for the test server/environment you use. On this server the file 'config.local.php' will be used.
 * SERVER_PRODUCTION is used for the online server you use. On this server the file 'config.php' will be used.
 *
 * If needed for any of these, add the :<port> to it when needed.
 *
 * @version 1.0.1
 */
define('SERVER_DEVELOP', 'localhost');
define('SERVER_PRODUCTION', 'example.com');

/*
 * Define the time_zone the server should work on
 *
 * More information about timezones can be found at: http://php.net/manual/en/timezones.php
 */
define('TIME_ZONE', 'Europe/Brussels');
