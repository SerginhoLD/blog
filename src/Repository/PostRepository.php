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
     * @return QueryBuilder
     */
    public function createQueryByTagId(int $tagId)
    {
        $builder = $this->createQueryBuilder('post');
        $builder->innerJoin('post.tags', 'tag')->where($builder->expr()->eq('tag.id', $tagId));
        return $builder;
    }
}
