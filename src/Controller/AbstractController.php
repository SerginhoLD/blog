<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Blog\View\AssetInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\PhpRenderer;

/**
 * Class AbstractController
 * @package Blog\Controller
 */
abstract class AbstractController
{
    /** @var ContainerInterface */
    protected $container;

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
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    protected function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        /** @var PhpRenderer $renderer */
        $renderer = $this->container->get('renderer');
        return $renderer->render($response, $template, $data);
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

    /**
     * @return AssetInterface
     */
    protected function getAsset(): AssetInterface
    {
        return $this->container->get(AssetInterface::class);
    }
}
