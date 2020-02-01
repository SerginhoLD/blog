<?php
declare(strict_types = 1);

namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Entity\Tag;
use Blog\Nav\NavInterface;
use Blog\Repository\PostRepository;
use Blog\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
        $entityManager = $this->container->get(EntityManagerInterface::class);
        $queryParams = $request->getQueryParams();
        $id = isset($queryParams['id']) ? (int)$queryParams['id'] : null;
        $post = null;

        /** @var PostRepository $repository */
        $repository = $entityManager->getRepository(Post::class);

        /** @var TagRepository $tagsRepository */
        $tagsRepository = $entityManager->getRepository(Tag::class);

        if ($id)
            $post = $repository->find($id);

        if (!$post)
            $post = new Post();

        if ($request->getMethod() === 'POST')
        {
            $parsedBody = $request->getParsedBody();

            $post->setSlug($parsedBody['slug'])
                ->setName($parsedBody['name'])
                ->setPreview($parsedBody['preview'])
                ->setText($parsedBody['text']);

            $post->getTags()->clear();

            if (isset($parsedBody['tags']))
            {
                $tags = $tagsRepository->findBy([
                    'id' => $parsedBody['tags'],
                ]);

                /** @var Tag $tag */
                foreach ($tags as $tag)
                {
                    $post->getTags()->add($tag);
                }
            }

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirect($this->getRouteParser()->urlFor('post-edit', [], ['id' => $post->getId()]));
        }

        return $this->render($response, 'admin/post-edit.phtml', [
            'post' => $post,
            'tags' => $tagsRepository->findAll(),
        ]);
    }

    public function tagEdit(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $entityManager = $this->container->get(EntityManagerInterface::class);
        $queryParams = $request->getQueryParams();
        $id = isset($queryParams['id']) ? (int)$queryParams['id'] : null;
        $tag = null;

        /** @var TagRepository $tagsRepository */
        $repository = $entityManager->getRepository(Tag::class);

        if ($id)
            $tag = $repository->find($id);

        if (!$tag)
            $tag = new Tag();

        if ($request->getMethod() === 'POST')
        {
            $parsedBody = $request->getParsedBody();

            $tag->setName($parsedBody['name'])
                ->setTitle(!empty($parsedBody['title']) ? $parsedBody['title'] : null);

            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirect($this->getRouteParser()->urlFor('tag-edit', [], ['id' => $tag->getId()]));
        }

        return $this->render($response, 'admin/tag-edit.phtml', [
            'tag' => $tag,
        ]);
    }
}
