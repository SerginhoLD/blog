<?php
declare(strict_types = 1);

namespace Blog\Nav;

/**
 * Class Pagination
 * @package Blog\Nav
 */
class Pagination implements PaginationInterface
{
    /** @var int */
    private int $limit;

    /** * @var int */
    private int $page;

    /** * @var int */
    private int $count = 0;

    /**
     * @param int $limit
     * @param int $page
     */
    public function __construct(int $page = 1, int $limit = 1)
    {
        $this->page = $page;
        $this->limit = $limit;
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
    public function setPage(int $page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        $limit = $this->getLimit();
        $page = $this->getPage();

        if ($limit < 1 || $page < 1)
            return null;

        return ($page - 1) * $limit;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount(int $count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        $limit = $this->getLimit();
        return $limit > 0 ? intval(ceil($this->getCount() / $limit)) : 0;
    }
}
