<?php
use Phalcon\DI;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Db\Adapter\Pdo\Sqlite as Database;

/** @var DI\FactoryDefault $di */

$di->set('router', function () use ($di, $config) {
    $router = new Router(false);
    $router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);
    require $config->projectDir . '/config/routes.php';
    return $router;
});

$di->setShared('dispatcher', function() use ($di) {
    $eventsManager = $di->getShared('eventsManager');
    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace('Blog\Controller');
    return $dispatcher;
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

$di->set('modelsMetadata', function() {
    $metaData = new MetaData\Memory();
    $metaData->setStrategy(new MetaData\Strategy\Annotations());
    return $metaData;
});

$di->set('db', function () use ($config) {
    $db = new Database([
        'dbname' => $config->database->dbname,
        'options' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => true,
        ],
    ]);

    $db->execute('PRAGMA foreign_keys = ON;');
    return $db;
});
