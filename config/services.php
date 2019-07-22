<?php
use UltraLite\Container\Container;
use Slim\Views\PhpRenderer;
use Blog\Markdown;
use Blog\Lists;
use Blog\Controller;

/**
 * @var string $projectDir
 * @var Container $di
 */

require_once __DIR__ . '/db.php';

$di->set('markdown', function() use ($di) {
    return new Markdown\ParsedownParser(new \Parsedown());
});

$di->set('renderer', function() use ($projectDir, $di) {
    return new PhpRenderer($projectDir . '/views', [
        'markdown' => $di->get('markdown'),
    ], 'layout.phtml');
});

$di->set(Lists\PostList::class, function() use ($di) {
    return new Lists\PostList();
});

$di->set(Controller\BlogController::class, function() use ($di) {
    return new Controller\BlogController($di->get('renderer'), $di->get(Lists\PostList::class));
});
