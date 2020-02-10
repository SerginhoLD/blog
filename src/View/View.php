<?php
declare(strict_types = 1);

namespace Blog\View;

use Psr\Http\Message\ResponseInterface;

/**
 * Class View
 * @package Blog\View
 */
class View implements ViewInterface
{
    /** @var string */
    private string $templatePath;

    /** * @var array */
    private array $attributes;

    /** * @var string|null */
    private ?string $layout;

    /**
     * @param string $templatePath
     * @param array $attributes
     * @param string|null $layout
     */
    public function __construct(string $templatePath, array $attributes = [], string $layout = null)
    {
        $this->templatePath = rtrim($templatePath, '/') . '/';
        $this->attributes = $attributes;
        $this->layout = $layout;
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     * @throws \Throwable
     */
    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        $response->getBody()->write($this->renderTpl($template, $data, true));
        return $response;
    }

    /**
     * @param string $template
     * @param array $data
     * @param bool $withLayout
     * @return string
     * @throws \Throwable
     */
    public function renderTpl(string $template, array $data = [], bool $withLayout = false): string
    {
        $file = $this->templatePath . $template;

        $data = array_merge($this->attributes, $data);
        $content = $this->includeTpl($file, $data);

        if ($withLayout && $this->layout !== null)
        {
            $file = $this->templatePath . $this->layout;
            $data['content'] = $content;
            $content = $this->includeTpl($file, $data);
        }

        return $content;
    }


    /**
     * @param string $file
     * @param array $data
     * @return string
     * @throws \Throwable
     */
    private function includeTpl(string $file, array $data): string
    {
        try
        {
            ob_start();
            extract($data);

            require $file;

            $content = ob_get_clean();
            return $content === false ? '' : $content;
        }
        catch(\Throwable $e)
        {
            ob_end_clean();
            throw $e;
        }
    }
}
