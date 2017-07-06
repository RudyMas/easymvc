<?php
/**
 * This file is used to configure all the routes of your website (See the information at the bottom of the file)
 * and to load the classes which are used by EasyMVC
 */
use Library\Email;
use Library\HttpRequest;
use Library\Login;
use RudyMas\PDOExt\DBconnect;
use RudyMas\XML_JSON\XML_JSON;

/**
 * Following classes belong to the EasyMVC framework. They are not loaded by default! You can activate them inside
 * the config.php file. (Don't change this part of the router.php file!)
 */
# Loading the Database configured in database.php
if (USE_DATABASE) {
    $database = [];
    include(__DIR__ . '/database.php');
    foreach ($database as $connect) {
        $object = $connect['objectName'];
        $$object = new DBconnect($connect['dbHost'], $connect['port'], $connect['dbUsername'],
            $connect['dbPassword'], $connect['dbName'], $connect['dbCharset'], $connect['dbType']);
    }
}

# Loading the EasyMVC Login Class
if (USE_LOGIN && isset($database)) {
    $loginDB = $database[0]['objectName'];
    $login = new Login($$loginDB, USE_EMAIL_LOGIN);
}

# Loading the EasyMVC HttpRequest Class
if (USE_HTTP_REQUEST) {
    $http = new HttpRequest();
}

# Loading the EasyMVC Email Class
if (USE_EMAIL) {
    $email = new Email();
}

/**
 * You can add routes like this:
 *
 * $router->addRoute('HTTP method',
 *                   'Route to use',
 *                   'Controller[:Function]',
 *                   'Array of Classes to inject',
 *                   'Array of Repositories to inject')
 *
 * - HTTP method: Can be anything, but in most cases, it will be GET or POST
 * - Route to use: - /something/anything -> This is the route to follow (case-insensitive)
 *                 - /{textSomething} -> This will create a variable 'textSomething' for you. (case-sensitive)
 *                 => You can use anything as a route, for example: /users/get/{userId}/city/{city}
 *                    -> <URL>/users/get/1/city/Hasselt will create the variables $var['userId'] = 1
 *                                                                                $var['city'] = 'Hasselt'
 * - Controller[:Function]:
 *      - 'Controller' -> This will load the class Controller
 *                     The Controller will receive 'Array of Classes, Array of Repositories', $var[], $html_body (JSON/XML/...))
 *      - 'Controller:Function' -> This will load the class Controller and the Function inside the class
 *                              The Controller will receive 'Array of Classes'
 *                              The Function will receive 'Array of Repositories, $var[], $html_body (JSON/XML/...)'
 * - Array of Classes to inject: This can be any class you want to pass on to the controller
 *                               You can use the following syntax:
 *                                  ['dbconnect' => $dbconnect, 'someClass' => new SomeClass(), ...]
 * - Array of Repositories to inject: This can be any repository you have created
 *                                      ['User', 'submap\Something', ...]
 *                                      'User' will inject the UserRepository into the Class/Function
 *                                      'submap\Something' will inject the SomethingRepository into the Class/Function
 *                                          located in the folder submap under src/repositories
 */
$router->addRoute('GET', '/', 'Example:help');
$router->addRoute('GET', '/help', 'Example:help');
$router->addRoute('GET', '/text', 'Example:test');
$router->addRoute('GET', '/text/{name}', 'Example:test');
$router->addRoute('GET', '/redirect', 'Example:redirect');
$router->addRoute('GET', '/json', 'Example:showJSON');
$router->addRoute('GET', '/xml', 'Example:showXML');
$router->addRoute('GET', '/php', 'Example:showPHP');
$router->addRoute('GET', '/php/info', 'Example:infoPHP');
$router->addRoute('GET', '/php/table', 'Example:tablePHP');
$router->addRoute('GET', '/twig', 'Example:showTwig');
$router->addRoute('GET', '/twig/info', 'Example:infoTwig');
$router->addRoute('GET', '/twig/table', 'Example:tableTwig');
$router->addRoute('GET', '/model', 'ModelExample:model');

if (isset($http)) {
    $router->addRoute('GET', '/api/overview', 'ApiExample:getOverview', ['http' => $http, 'xmlJson' => new XML_JSON()]);
    $router->addRoute('GET', '/api/habits/{userId}', 'ApiExample:getHabitsUser', ['http' => $http, 'xmlJson' => new XML_JSON()]);
    $router->addRoute('GET', '/api/setHabit/{userId}', 'ApiExample:setHabit', ['http' => $http, 'xmlJson' => new XML_JSON()]);
}

$router->setDefault('/');

/** End of File: router.php **/