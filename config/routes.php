<?php
/** @var \Phalcon\Mvc\Router $router */

$router->notFound([
    'action' => 'notFound',
]);

$router->addGet('/', [
    'action' => 'index',
]);

$router->addGet('/page/{page:\d+}', [
    'action' => 'blog',
]);

$router->addGet('/post/{slug:[a-z0-9]+}', [
    'action' => 'post',
]);
