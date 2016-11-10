<?php
/**
 * Here you can prepare all the routes you want to use on your website
 */
use RudyMas\Router\EasyRouter;

$router = new EasyRouter();
$router->addRoute('GET', '/', 'Example');
$router->addRoute('GET', '/test', 'Example:test');
$router->addRoute('GET', '/test/{name}', 'Example:test');

// Start processing the user input
try {
    $router->execute();
} catch (Exception $exception) {
    http_response_code($exception->getCode());
    print($exception->getMessage());
}