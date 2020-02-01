<?php
declare(strict_types = 1);

namespace Blog\Repository;

use Blog\Model\PostInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * @method PostInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostInterface[]    findAll()
 * @method PostInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends EntityRepository
{
    /**
     * @param int $tagId
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return iterable
     */
    public function findByTagId(int $tagId, array $orderBy = null, int $limit = null, int $offset = null): iterable
    {
        $builder = $this->createQueryByTagId($tagId)->setMaxResults($limit);

        foreach ($orderBy ?? [] as $by => $order)
        {
            $builder->addOrderBy($by, $order);
        }

        if ($offset !== null)
            $builder->setFirstResult($offset);

        return $builder->getQuery()->getResult();
    }

    /**
     * @param int $tagId
     * @return QueryBuilder
     */
    private function createQueryByTagId(int $tagId)
    {
        $builder = $this->createQueryBuilder('post');
        return $builder->innerJoin('post.tags', 'tag')->where($builder->expr()->eq('tag.id', $tagId));
    }

    /**
     * @param int $tagId
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countByTagId(int $tagId): int
    {
        return (int)$this->createQueryByTagId($tagId)->select('COUNT(post.id)')->getQuery()->getSingleScalarResult();
    }
}
