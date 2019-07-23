<?php
namespace Blog\Lists;

/**
 * Interface ListInterface
 * @package Blog\Lists
 */
interface ListInterface extends \Countable
{
    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): ListInterface;

    /**
     * @return int|null
     */
    public function getLimit(): ?int;

    /**
     * @param int|null $limit
     * @return $this
     */
    public function setLimit(?int $limit): ListInterface;

    /**
     * @return int|null
     */
    public function getOffset(): ?int;

    /**
     * @return int
     */
    public function getTotalPages(): int;

    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters): ListInterface;

    /**
     * @return iterable
     */
    public function getItems(): ?iterable;

    /**
     * @return $this
     */
    public function build(): ListInterface;

    /**
     * @return bool
     */
    public function isBuilt(): bool;
}
