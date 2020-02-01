<?php
namespace Blog\Nav;

use Slim\Interfaces\RouteParserInterface;

/**
 * Interface PaginationInterface
 * @package Blog\Nav
 */
interface PaginationInterface
{
    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page);

    /**
     * @return int|null
     */
    public function getOffset(): ?int;

    /**
     * @return int
     */
    public function getLimit(): int;

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit);

    /**
     * @return int
     */
    public function getCount(): int;

    /**
     * @param int $count
     * @return $this
     */
    public function setCount(int $count);

    /**
     * @return int
     */
    public function getTotalPages(): int;
}
