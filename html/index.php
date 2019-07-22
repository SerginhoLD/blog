<?php
use UltraLite\Container\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Factory\AppFactory;

$projectDir = dirname(__DIR__);

require_once $projectDir . '/vendor/autoload.php';

$di = new Container();
require_once $projectDir . '/config/services.php';

$app = AppFactory::create(
    $di->get(ResponseFactoryInterface::class),
    $di,
    $di->get(CallableResolverInterface::class),
    $di->get(RouteCollectorInterface::class)
);

require_once $projectDir . '/config/middleware.php';
require_once $projectDir . '/config/routes.php';

$app->run();
