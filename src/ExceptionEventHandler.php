<?php
declare(strict_types = 1);

namespace Blog;

use Phalcon\Mvc\DispatcherInterface;

/**
 * Class ExceptionEventHandler
 * @package Blog
 */
class ExceptionEventHandler
{
    /**
     * @param $event
     * @param DispatcherInterface $dispatcher
     * @param $exception
     * @return void|false
     */
    public function beforeException($event, DispatcherInterface $dispatcher, $exception)
    {
        if ($exception instanceof NotFoundException)
        {
            $dispatcher->forward([
                'controller' => 'index',
                'action' => 'notFound',
            ]);

            return false;
        }
    }
}
