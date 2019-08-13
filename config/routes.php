<?php
use Blog\Controller\BlogController;
use Blog\Controller\AdminController;

/** @var \Slim\App $app */

$app->get('/[page/{page:\d+}]', BlogController::class . ':blog')->setName('blog');

$app->get('/post/{slug}', BlogController::class . ':post')->setName('post');

$app->get('/tag/{name}[/page/{page:\d+}]', BlogController::class . ':tag')->setName('tag');

$app->get('/contacts', BlogController::class . ':contacts')->setName('contacts');


// admin:

$app->get('/admin', AdminController::class . ':blog')->setName('admin');
