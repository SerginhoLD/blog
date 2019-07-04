<?php
use Phalcon\DI;
use Phalcon\Cache;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Db\Adapter\Pdo\Sqlite as Database;
use Phalcon\Http\Response\Cookies;
use Blog\Markdown;

/** @var DI\FactoryDefault $di */

$di->set('cache', function() use ($config) {
    $frontCache = new Cache\Frontend\Igbinary([
        'lifetime' => 86400,
    ]);

    return new Cache\Backend\File($frontCache, [
        'cacheDir' => $config->cacheDir . '/data/',
    ]);
});

$di->setShared('router', function () use ($di, $config) {
    $router = new Router(false);
    $router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);
    require $config->projectDir . '/config/routes.php';
    return $router;
});

$di->setShared('dispatcher', function() use ($di) {
    $eventsManager = $di->getShared('eventsManager');

    $eventsManager->attach('dispatch:beforeException', function ($event, Dispatcher $dispatcher, $exception) {
        if ($exception instanceof \Blog\NotFoundException)
        {
            $dispatcher->forward([
                'controller' => 'index',
                'action' => 'notFound',
            ]);

            return false;
        }
    });

    $eventsManager->attach('dispatch:beforeExecuteRoute', $di->getShared('auth'));

    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace('Blog\Controller');
    return $dispatcher;
});

$di->set('viewCache', function () use ($config) {
    $frontCache = new Cache\Frontend\Output([
        'lifetime' => 86400,
    ]);

    return new Cache\Backend\File($frontCache, [
        'cacheDir' => $config->cacheDir . '/views/',
    ]);
});

$di->set('view', function () use ($di, $config) {
    $view = new View();
    $view->setDI($di);
    $view->setViewsDir($config->projectDir . '/views/');

    $view->registerEngines([
        '.phtml' => View\Engine\Php::class
    ]);

    return $view;
});

$di->setShared('modelsMetadata', function() {
    $metaData = new MetaData\Memory();
    $metaData->setStrategy(new MetaData\Strategy\Annotations());
    return $metaData;
});

$di->setShared('db', function () use ($config) {
    $db = new Database([
        'dbname' => $config->database->dbname,
        'options' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            //\PDO::ATTR_PERSISTENT => true,
        ],
    ]);

    $db->execute('PRAGMA foreign_keys = ON;');
    return $db;
});

$di->setShared('users', function() use ($config) {
    return new \Blog\Security\UserRepository($config->usersFile);
});

$di->setShared('AuthRepository', function() use ($config) {
    return new \Blog\Security\AuthRepository($config->authFile);
});

$di->setShared('cookies', function() {
    $cookies = new Cookies();
    $cookies->useEncryption(false);
    return $cookies;
});

$di->setShared('auth', function () {
    return new \Blog\Security\AuthPlugin();
});

$di->setShared('markdown', function () {
    return new Markdown\ParsedownParser(new \Parsedown());
});
