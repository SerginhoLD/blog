<?php
use Blog\Controller\BlogController;

/** @var \Slim\App $app */

$app->get('/[page/{page:\d+}]', BlogController::class . ':blog')->setName('blog');

$app->get('/post/{slug}', BlogController::class . ':post')->setName('post');
