<?php
use Slim\Middleware\ErrorMiddleware;

/** @var \Slim\App $app */

$responseFactory = $app->getResponseFactory();
$app->add(new ErrorMiddleware($app->getCallableResolver(), $responseFactory, true, false, false));
