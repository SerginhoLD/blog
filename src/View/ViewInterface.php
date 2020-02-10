<?php
namespace Blog\View;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface ViewInterface
 * @package Blog\View
 */
interface ViewInterface
{
    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface;

    /**
     * @param string $template
     * @param array $data
     * @param string|null $layout
     * @return string
     */
    public function renderTpl(string $template, array $data = [], string $layout = null): string;
}
