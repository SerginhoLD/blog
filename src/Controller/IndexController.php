<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->view->setVars([
            'test' => 'indexPage',
        ]);
    }

    public function blogAction(int $page)
    {
        var_dump($page);
    }

    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }
}
