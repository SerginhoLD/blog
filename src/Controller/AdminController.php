<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Blog\Db\R;
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

    public function postEdit(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $id = isset($queryParams['id']) ? (int)$queryParams['id'] : null;

        $post = R::findOneOrDispense('post', 'id = :id', [
            'id' => $id,
        ]);

        if ($request->getMethod() === 'POST')
        {
            $parsedBody = $request->getParsedBody();
            $post->import($parsedBody, 'slug,name,preview,text');
            $tags = [];

            if (isset($parsedBody['tags']))
            {
                $tags = R::find('tag', ' id IN ('.R::genSlots($parsedBody['tags']).')', $parsedBody['tags']);
            }

            $post->sharedTag = $tags;
            $newId = R::store($post);
            return $this->redirect($this->getRouteParser()->urlFor('post-edit', [], ['id' => $newId]));
        }

        /** @var Post $post */
        $post = $post ? $post->box() : new Post();
        $tags = R::findObjects('tag');

        return $this->render($response, 'admin/post-edit.phtml', [
            'post' => $post,
            'tags' => $tags,
        ]);
    }
}
