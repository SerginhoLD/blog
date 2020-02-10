<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Blog\View\ViewInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Interfaces\RouteParserInterface;

/**
 * Class AbstractController
 * @package Blog\Controller
 */
abstract class AbstractController
{
    /** @var ContainerInterface */
    protected ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $to
     * @param int $code
     * @return ResponseInterface
     * @throws \InvalidArgumentException
     */
    protected function redirect($to, int $code = 302): ResponseInterface
    {
        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $this->container->get(ResponseFactoryInterface::class);
        return $responseFactory->createResponse($code)->withHeader('Location', (string)$to);
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     */
    protected function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        $view = $this->container->get(ViewInterface::class);
        return $view->render($response, $template, $data);
    }

    /**
     * @return RouteParserInterface
     */
    protected function getRouteParser(): RouteParserInterface
    {
        /** @var RouteCollectorInterface $collector */
        $collector = $this->container->get(RouteCollectorInterface::class);
        return $collector->getRouteParser();
    }
}
