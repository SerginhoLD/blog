<?php
error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
//use Phalcon\Db\Adapter\Pdo\Mysql as Database;

try
{
    $config = require __DIR__ . '/../blog/config/config.php';

    $loader = new Loader();
    $loader->registerNamespaces([
        'Blog' => $config->blog->projectDir . '/blog/src',
    ])->register();

    $di = new FactoryDefault();

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
        $view->setViewsDir($config->blog->projectDir . '/blog/views/');

        $view->registerEngines([
            '.phtml' => View\Engine\Php::class
        ]);

        return $view;
    });

    /*
    $di->set('db', function () use ($config) {
        return new Database(
            [
                "host"     => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname"   => $config->database->name
            ]
        );
    });*/

    $application = new Application($di);
    $response = $application->handle();
    $response->send();
}
catch (\Exception $e)
{
    var_dump($e);
}
