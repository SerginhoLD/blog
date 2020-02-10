<?php
declare(strict_types = 1);

namespace Blog\Nav;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Slim\Interfaces\RouteParserInterface;

/**
 * Class QueryPaginator
 * @package Blog\Nav
 */
class QueryPaginator extends Paginator implements PaginatorInterface
{
    /** @var int */
    private int $page = 1;

    /** @var string|null */
    private ?string $route = null;

    /** @var array */
    private array $routeData = [];

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

    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param string|null $route
     * @return $this
     */
    public function setRoute(string $route): self
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return array
     */
    public function getRouteData(): array
    {
        return $this->routeData;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setRouteData(array $data): self
    {
        $this->routeData = $data;
        return $this;
    }

    /**
     * @param RouteParserInterface $routeParser
     * @param int $page
     * @return string
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getUrl(RouteParserInterface $routeParser, int $page): string
    {
        $data = $this->routeData;
        $data['page'] = $page;
        return $routeParser->urlFor($this->route, $data);
    }
}
