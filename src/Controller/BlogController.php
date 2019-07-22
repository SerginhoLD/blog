<?php
namespace Blog\Controller;

use Slim\Exception\HttpNotFoundException;
use Slim\Views\PhpRenderer;
use Blog\Lists\PostList;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class BlogController
 * @package Blog\Controller
 */
class BlogController
{
    /** @var PhpRenderer */
    private $renderer;

    /** @var PostList */
    private $posts;

    public function __construct(PhpRenderer $renderer, PostList $posts)
    {
        $this->renderer = $renderer;
        $this->posts = $posts;
    }

    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $page = (int)$args['page'];
        $posts = $this->posts;

        if ($page > 1)
            $posts->setPage($page);

        $posts->build();

        if ($posts->getPage() > $posts->getTotalPages())
            throw new HttpNotFoundException($request);

        return $this->renderer->render($response, 'blog/index.phtml', [
            'page' => $posts->getPage(),
            'totalPages' => $posts->getTotalPages(),
            'posts' => $posts->getItems(),
        ]);
    }
}
