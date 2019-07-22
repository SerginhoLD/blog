<?php
use UltraLite\Container\Container;
use Blog\Controller;

/**
 * @var string $projectDir
 * @var Container $di
 */

require_once __DIR__ . '/db.php';

$di->set(Controller\BlogController::class, function() {
    return new Controller\BlogController();
});
