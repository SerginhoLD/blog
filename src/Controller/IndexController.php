<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;
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
        $this->view->pick('index/index');

        $this->view->cache([
            'key' => $cacheKey,
        ]);

        if (!$this->view->getCache()->exists($cacheKey))
        {
            $this->view->setVars($this->getBlogVars($page));
        }
    }

    private function getBlogVars(int $page): array
    {
        $limit = 1; // todo

        $data = (new Paginator([
            'data'  => Post::find([
                'order' => 'id DESC',
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

    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }
}
