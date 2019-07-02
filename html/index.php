<?php
error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Db\Adapter\Pdo\Sqlite as Database;

try
{
    $config = require __DIR__ . '/../config/config.php';

    $loader = new Loader();
    $loader->registerNamespaces([
        'Blog' => $config->projectDir . '/src',
    ])->register();

    $di = new FactoryDefault();

    $di->set('router', function () use ($di, $config) {
        $eventsManager = $di->getShared('eventsManager');
        $router = new Router(false);
        $router->setEventsManager($eventsManager);
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

    $di->set('db', function () use ($config) {
        return new Database([
            'dbname' => $config->db->blog->dbname,
        ]);
    });

    $application = new Application($di);
    $response = $application->handle();
    $response->send();
}
catch (\Exception $e)
{
    var_dump($e);
}
