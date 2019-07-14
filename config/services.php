<?php
use UltraLite\Container\Container;
use Blog\Controller;

/** @var Container $di */

$di->set(Controller\BlogController::class, function() {
    return new Controller\BlogController();
});
