<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->view->setVars([
            'test' => 134,
        ]);
    }
}
