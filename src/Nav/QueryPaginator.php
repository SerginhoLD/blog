<?php
declare(strict_types = 1);

namespace Blog\Nav;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class QueryPaginator
 * @package Blog\Nav
 */
class QueryPaginator extends Paginator
{
    /** @var int */
    private int $page = 1;

    /**
     * @param Query|QueryBuilder $query
     * @param int $limit
     * @param bool $fetchJoinCollection
     */
    public function __construct($query, int $limit = 1, bool $fetchJoinCollection = true)
    {
        $query->setMaxResults($limit);
        parent::__construct($query, $fetchJoinCollection);
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self
    {
        $limit = (int)$this->getQuery()->getMaxResults();
        $offset = ($page - 1) * $limit;
        $this->getQuery()->setFirstResult($offset);
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        $limit = (int)$this->getQuery()->getMaxResults();
        return $limit > 0 ? intval(ceil($this->count() / $limit)) : 0;
    }
}
