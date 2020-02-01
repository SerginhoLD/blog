<?php
declare(strict_types = 1);

namespace Blog\Repository;

use Blog\Model\TagInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method TagInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagInterface[]    findAll()
 * @method TagInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends EntityRepository
{
}
