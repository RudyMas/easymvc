<?php
/**
 * This file is used to configure all the routes of your website
 *
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
$router->addRoute('GET', '/', 'EmvcHelp:welcome');

$router->addRoute('GET', '/mobile', '', [], [], 'mobile');
$router->addRoute('GET', '/dashboard', '', [], [], 'mobile');
$router->addRoute('GET', '/heroes', '', [], [], 'mobile');

$router->setDefault('/');

$router->setMobileDetection(true); // Comment this line if you don't provide a Mobile App (Angular, REACT, ...)
// $router->setDefaultMobileApp('http://m.website.com'); // Uncomment this when you want a different path to your mobile app

/** End of File: router.php **/