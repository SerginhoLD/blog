<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Entity\Tag;
use Blog\Nav\QueryPaginator;
use Blog\Repository\PostRepository;
use Blog\Repository\TagRepository;
use Blog\View\MetaInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

/**
 * Class BlogController
 * @package Blog\Controller
 */
class BlogController extends AbstractController
{
    public function blog(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $page = isset($args['page']) ? (int)$args['page'] : null;

        if ($page === 1)
        {
            # /blog/page/1 => /blog
            return $this->redirect($this->getRouteParser()->urlFor('blog'));
        }

        /** @var PostRepository $repository */
        $repository = $this->container->get(EntityManagerInterface::class)->getRepository(Post::class);
        $paginator = new QueryPaginator($repository->createQueryBuilder('post')->orderBy('post.id', 'DESC'));
        $count = $paginator->count();

        if ($count < 1)
            throw new HttpNotFoundException($request);

        $paginator->setPage($page > 1 ? $page : 1);

        if ($paginator->getPage() > $paginator->getTotalPages())
            throw new HttpNotFoundException($request);

        $paginator->setRoute('blog');
        $title = ['Блог'];

        if ($page > 1)
            $title[] = 'Страница ' . $page;

        $this->container->get(MetaInterface::class)->setTitle($title);

        return $this->render($response, 'blog/index.phtml', [
            'paginator' => $paginator,
        ]);
    }

    public function post(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $slug = $args['slug'];
        $repository = $this->container->get(EntityManagerInterface::class)->getRepository(Post::class);

        $post = $repository->findOneBy([
            'slug' => $slug,
        ]);

        if (!$post)
            throw new HttpNotFoundException($request);

        $this->container->get(MetaInterface::class)->setTitle($post->getName());

        return $this->render($response, 'blog/post.phtml', [
            'post' => $post,
        ]);
    }

    public function tag(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $name = $args['name'];
        $page = isset($args['page']) ? (int)$args['page'] : null;

        if ($page === 1)
        {
            # /tag/name/page/1 => /tag/name
            return $this->redirect($this->getRouteParser()->urlFor('tag', ['name' => $name]));
        }

        /** @var TagRepository $tagsRepository */
        $tagsRepository = $this->container->get(EntityManagerInterface::class)->getRepository(Tag::class);

        $tag = $tagsRepository->findOneBy([
            'name' => $name,
        ]);

        if (!$tag)
            throw new HttpNotFoundException($request);

        /** @var PostRepository $repository */
        $repository = $this->container->get(EntityManagerInterface::class)->getRepository(Post::class);
        $paginator = new QueryPaginator($repository->createQueryByTagId($tag->getId())->orderBy('post.id', 'DESC'));
        $count = $paginator->count();

        if ($count < 1)
            throw new HttpNotFoundException($request);

        $paginator->setPage($page > 1 ? $page : 1);

        if ($paginator->getPage() > $paginator->getTotalPages())
            throw new HttpNotFoundException($request);

        $paginator->setRoute('tag')->setRouteData([
            'name' => $tag->getName(),
        ]);

        $title = [$tag->getTitle() ?? $tag->getName()];

        if ($page > 1)
            $title[] = 'Страница ' . $page;

        $this->container->get(MetaInterface::class)->setTitle($title);

        return $this->render($response, 'blog/tag.phtml', [
            'tag' => $tag,
            'paginator' => $paginator,
        ]);
    }

    public function contacts(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $this->container->get(MetaInterface::class)->setTitle('Контакты');
        return $this->render($response, 'blog/contacts.phtml');
    }
}
