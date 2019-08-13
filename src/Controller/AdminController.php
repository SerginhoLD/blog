<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Blog\Nav\NavInterface;

/**
 * Class AdminController
 * @package Blog\Controller
 */
class AdminController extends AbstractController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->container->get(NavInterface::class)->setStrategy(NavInterface::STRATEGY_ADMIN);
    }

    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'admin/index.phtml');
    }
}
