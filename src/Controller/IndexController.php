<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Blog\Model\Post;
use Phalcon\Mvc\Controller;

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
            $this->view->setVars([
                'test' => [
                    'page' => $page,
                    'test2',
                ]
            ]);
        }
    }

    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }
}
