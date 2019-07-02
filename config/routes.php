<?php
/** @var \Phalcon\Mvc\Router $router */

$router->notFound([
    'action' => 'notFound',
]);

$router->addGet('/', [
    'action' => 'index',
]);

$router->addGet('/page/{page:[0-9]+}', [
    'action' => 'blog',
]);
