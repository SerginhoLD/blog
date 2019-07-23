<?php
namespace Blog\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use RedBeanPHP\R;
use Blog\Lists\PostList;
use Blog\Model\PostInterface;
use Blog\Model\TagInterface;

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

    // todo: надо бы отрефакторить, почти одинаково с :blog
    public function tag(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $name = $args['name'];
        $page = (int)$args['page'];

        if ($page === 1)
        {
            # /tag/name/page/1 => /tag/name
            return $this->redirect($this->getRouteParser()->urlFor('tag', ['name' => $name]));
        }

        $tag = R::findOne('tag', 'name = :name', [
            'name' => $name,
        ]);

        if (!$tag)
            throw new HttpNotFoundException($request);

        /** @var TagInterface $tag */
        $tag = $tag->box();

        /** @var PostList $posts */
        $posts = $this->container->get(PostList::class);

        if ($page > 1)
            $posts->setPage($page);

        $posts->setParameters([
            'sql' => "
            join post_tag l
                on l.post_id = post.id
                and l.tag_id = :tag_id
            ",
            'bind' => [
                'tag_id' => $tag->getId(),
            ],
        ]);

        $posts->build();

        if ($posts->getPage() > $posts->getTotalPages())
            throw new HttpNotFoundException($request);

        $title = [$tag->getTitle() ?? $tag->getName()];

        if ($page > 1)
            $title[] = 'Страница ' . $page;

        $this->getAsset()->setTitle($title);

        return $this->render($response, 'blog/index.phtml', [
            'page' => $posts->getPage(),
            'totalPages' => $posts->getTotalPages(),
            'posts' => $posts->getItems(),
        ]);
    }

    public function contacts(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'blog/contacts.phtml');
    }
}
