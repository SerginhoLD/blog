<?php
namespace Blog\Controller;

use Blog\Model\PostInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RedBeanPHP\R;

class BlogController
{
    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        //$query = $this->conn->createQueryBuilder()->select('*')->from('post');
        //var_dump($query->execute()->fetchAll());

        /*echo '<hr>';

        $test = R::find('post');

        /** @var \RedBeanPHP\OODBBean $item * /
        foreach ($test as $item)
        {
            /** @var PostInterface $post * /
            $post = $item->box();
            var_dump($post);
            var_dump($post->getId());
            var_dump($post->getText());
        }

        //\R::setup();
        //\R::find();

        echo '<hr>';

        //$t = R::load('post', 1);
        //var_dump($t);*/

        $response->getBody()->write("blog list");
        return $response;
    }
}
