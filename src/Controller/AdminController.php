<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RedBeanPHP\R;
use Blog\Nav\NavInterface;
use Blog\Model\Post;

/**
 * Class AdminController
 * @package Blog\Controller
 */
class AdminController extends AbstractController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->container->get(NavInterface::class)->setStrategy(NavInterface::STRATEGY_ADMIN);
    }

    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'admin/index.phtml');
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $id = (int)$queryParams['id'];
        $post = null;

        if ($id)
        {
            $post = R::findOne('post', 'id = :id', [
                'id' => $id,
            ]);
        }

        if ($request->getMethod() === 'POST')
        {
            $post = $post ?? R::dispense('post');
            $post->import($request->getParsedBody(), 'slug,name,preview,text');
            $newId = R::store($post);
            return $this->redirect($this->getRouteParser()->urlFor('create', [], ['id' => $newId]));
        }

        /** @var Post $post */
        $post = $post ? $post->box() : new Post();

        return $this->render($response, 'admin/create.phtml', [
            'post' => $post,
        ]);
    }
}
