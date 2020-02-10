<?php
namespace Blog\Nav;

use Slim\Interfaces\RouteParserInterface;

/**
 * Interface PaginatorInterface
 * @package Blog\Nav
 */
interface PaginatorInterface extends \Countable, \IteratorAggregate
{
    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self;

    /**
     * @return int
     */
    public function getTotalPages(): int;

    /**
     * @return string|null
     */
    public function getRoute(): ?string;

    /**
     * @param string $route
     * @return $this
     */
    public function setRoute(string $route): self;

    /**
     * @return array
     */
    public function getRouteData(): array;

    /**
     * @param array $data
     * @return $this
     */
    public function setRouteData(array $data): self;

    /**
     * @param RouteParserInterface $routeParser
     * @param int $page
     * @return string
     */
    public function getUrl(RouteParserInterface $routeParser, int $page): string;
}
