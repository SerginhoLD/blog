<?php
use UltraLite\Container\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Interfaces\CallableResolverInterface;
use Slim\CallableResolver;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Routing\RouteCollector;
use Slim\Views\PhpRenderer;
use Blog\View;
use Blog\Markdown;
use Blog\Lists\PostList;
use Blog\Utils\DateFormatter;
use Blog\Controller;

/**
 * @var string $projectDir
 * @var Container $di
 */

require_once __DIR__ . '/db.php';

$di->set(ResponseFactoryInterface::class, function () {
    return AppFactory::determineResponseFactory();
});

$di->set(CallableResolverInterface::class, function () use ($di) {
    return new CallableResolver($di);
});

$di->set(RouteCollectorInterface::class, function () use ($di) {
    return new RouteCollector(
        $di->get(ResponseFactoryInterface::class),
        $di->get(CallableResolverInterface::class),
        $di
    );
});

$di->set(View\AssetInterface::class, function() use ($projectDir) {
    return new View\Asset($projectDir . '/html');
});

$di->set(Markdown\ParserInterface::class, function() use ($di) {
    return new Markdown\ParsedownParser(new \Parsedown());
});

$di->set(DateFormatter::class, function() {
    return new DateFormatter();
});

$di->set('renderer', function() use ($projectDir, $di) {
    return new PhpRenderer($projectDir . '/views', [
        'asset' => $di->get(View\AssetInterface::class),
        'markdown' => $di->get(Markdown\ParserInterface::class),
        'dateFormatter' => $di->get(DateFormatter::class),
    ], 'layout.phtml');
});

$di->set(PostList::class, function() use ($di) {
    return new PostList();
});

/*
$di->set(Controller\BlogController::class, function() use ($di) {
    return new Controller\BlogController($di);
});
*/
