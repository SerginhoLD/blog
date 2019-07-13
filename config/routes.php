<?php
use Blog\Controller\BlogController;

/** @var \Slim\App $app */

$app->get('/', BlogController::class . ':blog')->setName('blog');
