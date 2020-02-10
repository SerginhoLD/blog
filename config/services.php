<?php
use Blog\Controller;
use Blog\Formatter;
use Blog\Markdown;
use Blog\Nav;
use Blog\View;
use Doctrine\ORM;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Interfaces\CallableResolverInterface;
use Slim\CallableResolver;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Routing\RouteCollector;
use UltraLite\Container\Container;

/**
 * @var string $projectDir
 * @var Container $di
 */

$di->set('config', function () use ($projectDir) {
    return require __DIR__ . '/config.php';
});

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

$di->set(ORM\EntityManagerInterface::class, function () use ($di, $projectDir) {
    $config = $di->get('config')['doctrine'];
    $metadataConfig = ORM\Tools\Setup::createAnnotationMetadataConfiguration($config['metadata_paths'], $config['dev_mode'], $config['proxy_dir'], null, false);
    //$metadataConfig->setProxyNamespace('Blog\Entity\Proxy');
    //$metadataConfig->setAutoGenerateProxyClasses($config['dev_mode']);
    return ORM\EntityManager::create($config['connection'], $metadataConfig);
});

$di->set(View\AssetInterface::class, function() use ($projectDir) {
    return new View\Asset($projectDir . '/html');
});

$di->set(View\MetaInterface::class, function() {
    return new View\Meta();
});

$di->set(Nav\NavInterface::class, function() use ($di) {
    return new Nav\Nav($di->get(RouteCollectorInterface::class)->getRouteParser());
});

$di->set(Markdown\ParserInterface::class, function() use ($di) {
    $parsedown = new \Parsedown();
    $parsedown->setSafeMode(true);
    return new Markdown\ParsedownParser($parsedown);
});

$di->set(Formatter\DateFormatterInterface::class, function() {
    return new Formatter\DateFormatter();
});

$di->set(View\ViewInterface::class, function() use ($projectDir, $di) {
    return new View\View($projectDir . '/views', [
        'asset' => $di->get(View\AssetInterface::class),
        'meta' => $di->get(View\MetaInterface::class),
        'markdown' => $di->get(Markdown\ParserInterface::class),
        'nav' => $di->get(Nav\NavInterface::class),
        'routeParser' => $di->get(RouteCollectorInterface::class)->getRouteParser(),
        'dateFormatter' => $di->get(Formatter\DateFormatterInterface::class),
    ], 'layout.phtml');
});

/*
$di->set(Controller\BlogController::class, function() use ($di) {
    return new Controller\BlogController($di);
});
*/
