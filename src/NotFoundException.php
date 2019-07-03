<?php
namespace Blog;

use Phalcon\Mvc\Dispatcher;
use Throwable;

/**
 * Class NotFoundException
 * @package App
 */
class NotFoundException extends Dispatcher\Exception
{
    /** @var int */
    protected $code = Dispatcher::EXCEPTION_HANDLER_NOT_FOUND;
    
    /**
     * NotFoundException constructor.
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Not found', Throwable $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }
}
