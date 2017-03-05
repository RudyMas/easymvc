<?php
/**
 * This file is used to configure all the routes of your website
 *
 * You can add routes like this:
 *
 * $router->addRoute('HTTP method', 'Route to use', 'Controller[:Function]', 'Array of Objects')
 * - HTTP method: Can be anything, but in most cases, it will be GET or POST
 * - Route to use: - /something/anything -> This is the route to follow (case-insensitive)
 *                 - /{textSomething} -> This will create a variable 'textSomething' for you. (case-sensitive)
 *                 => You can use anything as a route, for example: /users/get/{userId}/city/{city}
 *                    -> <URL>/users/get/1/city/Hasselt will create the variables $var['userId'] = 1
 *                                                                                $var['city'] = 'Hasselt'
 * - Controller[:Function]:
 *      - 'Controller' -> This will load the class Controller
 *                     The Controller will receive '$var, $html_body (JSON/XML/...), Array of Object')
 *      - 'Controller:Function' -> This will load the class Controller
 *                                 and also load the Function inside the class
 *                              The Controller will receive 'Array of Objects'
 *                              The Function will receive '$var, $html_body (JSON/XML/...)'
 * - Array of Objects: This can be any object you want to pass on to the controller
 *                     In most cases, it will be the database object(s)
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
    $router->addRoute('GET', '/api/overview', 'ApiExample:getOverview', ['http' => $http]);
    $router->addRoute('GET', '/api/habits/{userId}', 'ApiExample:getHabitsUser', ['http' => $http]);
    $router->addRoute('GET', '/api/setHabit/{userId}', 'ApiExample:setHabit', ['http' => $http]);
}

$router->setDefault('/');
/** End of File: router.php **/