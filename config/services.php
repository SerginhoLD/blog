<?php
use UltraLite\Container\Container;
use Slim\Views\PhpRenderer;
use Blog\Controller;

/**
 * @var string $projectDir
 * @var Container $di
 */

require_once __DIR__ . '/db.php';

$di->set('renderer', function() use ($projectDir) {
    return new PhpRenderer($projectDir . '/views', [], 'layout.phtml');
});

$di->set(Controller\BlogController::class, function() use ($di) {
    return new Controller\BlogController($di->get('renderer'));
});
