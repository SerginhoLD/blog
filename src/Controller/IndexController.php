<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Blog\NotFoundException;
use Blog\Model\Post;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->blogAction();
    }

    public function blogAction(int $page = 1)
    {
        $cacheKey = 'blog-' . $page;
        $vars = $this->getBlogVars($page, $cacheKey);

        if ($page > $vars['totalPages'])
            throw new NotFoundException();

        $this->view->pick('index/index');

        $this->view->cache([
            'key' => $cacheKey,
        ]);

        if (!$this->view->getCache()->exists($cacheKey))
        {
            $this->view->setVars($vars);
        }
    }

    private function getBlogVars(int $page, string $cacheKey): array
    {
        $limit = 1; // todo

        $data = (new Paginator([
            'data'  => Post::find([
                'order' => 'id DESC',
                'cache' => [
                    'key' => $cacheKey,
                    'service' => 'cache',
                ],
            ]),
            'limit' => $limit,
            'page'  => $page,
        ]))->paginate();

        return [
            'posts' => $data->items,
            'page' => $page,
            'totalPages' => $data->total_pages,
        ];
    }

    public function postAction(string $slug)
    {
        $cacheKey = 'post-' . $slug;
        $vars = $this->getPostVars($slug, $cacheKey);

        if (!$vars['post'])
            throw new NotFoundException();

        $this->view->cache([
            'key' => $cacheKey,
        ]);

        if (!$this->view->getCache()->exists($cacheKey))
        {
            $this->view->setVars($vars);
        }
    }

    private function getPostVars(string $slug, string $cacheKey): array
    {
        $post = Post::findFirst([
            'conditions' => 'slug = :slug:',
            'bind' => [
                'slug' => $slug,
            ],
            'cache' => [
                'key' => $cacheKey,
                'service' => 'cache',
            ],
        ]);

        return [
            'post' => $post,
        ];
    }

    public function loginAction()
    {
    }

    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }
}
