<?php
/**
 * This file is used to configure all the routes of your website
 * and to load the classes which are used by EasyMVC
 */

use EasyMVC\Email\Email;
use EasyMVC\HttpRequest\HttpRequest;
use EasyMVC\Login\Login;
use RudyMas\Manipulator\Text;
use RudyMas\XML_JSON\XML_JSON;

/**
 * Following classes belong to the EasyMVC framework. They are not loaded by default! You can activate them inside
 * the config.php file. (Don't change this part of the router.php file!)
 */
# Loading the EasyMVC Login Class
if (USE_LOGIN && isset($database)) {
    $LoginDB = $database[0]['objectName'];
    $Text = new Text();
    $Login = new Login($$LoginDB, $Text, USE_EMAIL_LOGIN);
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
 *                   'Array of Repositories to inject'
 *                   'Mobile Detection')
 *
 * - HTTP method: Can be anything, but in most cases, it will be GET or POST
 * - Route to use:
 *      - /something/anything -> This is the route to follow (case-insensitive)
 *      - /{textSomething} -> This will create a variable 'textSomething' for you. (case-sensitive)
 *      => You can use anything as a route, for example: /users/get/{userId}/city/{city}
 *          -> <URL>/users/get/1/city/Hasselt will create the variables $var['userId'] = 1 $var['city'] = 'Hasselt'
 * - Controller[:Function]:
 *      - 'Controller' -> This will load the class Controller
 *                     The Controller will receive 'Array of Classes, Array of Repositories, $var[], $html_body (JSON/XML/...)'
 *      - 'Controller:Function' -> This will load the class Controller and the Function inside the class
 *                              The Controller will receive 'Array of Classes'
 *                              The Function will receive 'Repository1, Repository2, RepositoryX..., $var[], $html_body (JSON/XML/...)'
 * - Array of Classes to inject: (OPTIONAL)
 *      This can be any class you want to pass on to the controller
 *      You can use the following syntax:
 *          ['DBconnect' => $DBconnect, 'someClass' => new SomeClass(), ...]
 * - Array of Repositories to inject: (OPTIONAL)
 *      This can be any repository you have created
 *          ['User', 'submap\Something', ...]
 *              'User' will inject the UserRepository into the Class/Function
 *              'submap\Something' will inject the SomethingRepository into the Class/Function located in the
 *                  folder submap under src/Repositories
 * - Mobile Detection: ('auto', 'web', 'api', 'mobile') (OPTIONAL) (DEFAULT = auto)
 *      'auto' : Every call to the website will be checked. If a mobile device is detected, the mobile app will start
 *      'web|api' : Every call to the website will always be handled by the website. (Website or API)
 *      'mobile' : Every call to the website will always be handled by the mobile app (URL info will be transferred to the App)
 */
$router->addRoute('GET', '/', 'Example:help');
$router->addRoute('GET', '/help', 'Example:help', [], [], 'web');
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
$router->addRoute('GET', '/model', 'ModelExample:model', [], ['User']);
$router->addRoute('GET', '/model/{text}', 'ModelExample:modelAndVariable', [], ['User']);
$router->addRoute('GET', '/headers', 'Example:headers');

$router->addRoute('GET', '/heroes', '', [], [], 'mobile');
$router->addRoute('GET', '/dashboard', '', [], [], 'mobile');
$router->addRoute('GET', '/detail/{id}', '', [], [], 'mobile');

if (isset($http)) {
    $router->addRoute('GET', '/api/overview', 'ApiExample:getOverview', ['http' => $http, 'xmlJson' => new XML_JSON()]);
    $router->addRoute('GET', '/api/habits/{userId}', 'ApiExample:getHabitsUser', ['http' => $http, 'xmlJson' => new XML_JSON()]);
    $router->addRoute('GET', '/api/setHabit/{userId}', 'ApiExample:setHabit', ['http' => $http, 'xmlJson' => new XML_JSON()]);
}

$router->setDefault('/');

// $router->setMobileDetection('auto');
// $router->setDefaultMobileApp('http://m.localhost');

/** End of File: router.php **/