<?php
namespace Blog\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use RedBeanPHP\R;
use Blog\Lists\PostList;
use Blog\Model\PostInterface;

/**
 * Class BlogController
 * @package Blog\Controller
 */
class BlogController extends AbstractController
{
    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $page = (int)$args['page'];

        if ($page === 1)
        {
            # /blog/page/1 => /blog
            return $this->redirect($this->getRouteParser()->urlFor('blog'));
        }

        /** @var PostList $posts */
        $posts = $this->container->get(PostList::class);

        if ($page > 1)
            $posts->setPage($page);

        $posts->build();

        if ($posts->getPage() > $posts->getTotalPages())
            throw new HttpNotFoundException($request);

        $title = ['Блог'];

        if ($page > 1)
            $title[] = 'Страница ' . $page;

        $this->getAsset()->setTitle($title);

        return $this->render($response, 'blog/index.phtml', [
            'page' => $posts->getPage(),
            'totalPages' => $posts->getTotalPages(),
            'posts' => $posts->getItems(),
        ]);
    }

    public function post(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $slug = $args['slug'];

        $post = R::findOne('post', 'slug = :slug', [
            'slug' => $slug,
        ]);

        if (!$post)
            throw new HttpNotFoundException($request);

        /** @var PostInterface $post */
        $post = $post->box();
        $this->getAsset()->setTitle($post->getName());

        return $this->render($response, 'blog/post.phtml', [
            'post' => $post,
        ]);
    }

    public function contacts(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'blog/contacts.phtml');
    }
}
