<?php
declare(strict_types = 1);

namespace Blog\Lists;

/**
 * Class AbstractList
 * @package Blog\Lists
 */
abstract class AbstractList implements ListInterface
{
    /** @var int|null */
    protected $limit;

    /** @var array */
    protected $parameters = [];

    /** @var int */
    private $page = 1;

    /** @var int */
    private $count = 0;

    /** @var int */
    private $totalPages = 0;

    /** @var iterable|null */
    private $items;

    /** @var bool */
    private $isBuilt = false;

    /**
     * @param array|null $parameters
     * @param int $limit
     * @param int $page
     */
    public function __construct(array $parameters = null, int $limit = null, int $page = null)
    {
        if ($parameters !== null)
            $this->setParameters($parameters);

        if ($limit !== null)
            $this->setLimit($limit);

        if ($page !== null)
            $this->setPage($page);
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
    public function setPage(int $page): ListInterface
    {
        $this->page = $page > 0 ? $page : 1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     * @return $this
     */
    public function setLimit(?int $limit): ListInterface
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        $limit = $this->getLimit();

        if ($limit < 1)
            return null;

        return ($this->getPage() - 1) * $limit;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    protected function setCount(int $count): ListInterface
    {
        $this->count = $count;

        $limit = $this->getLimit();
        $this->totalPages = $limit > 0 ? intval(ceil($count / $limit)) : 1;

        if ($count < 1)
        {
            $this->setItems(null);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters): ListInterface
    {
        foreach ($parameters as $key => $value)
        {
            $this->parameters[$key] = $value;
        }

        return $this;
    }

    /**
     * @return iterable|null
     */
    public function getItems(): ?iterable
    {
        return $this->items;
    }

    /**
     * @param iterable|null $items
     * @return ListInterface
     */
    protected function setItems(?iterable $items): ListInterface
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBuilt(): bool
    {
        return $this->isBuilt;
    }

    /**
     * @param bool $built
     * @return $this
     */
    protected function setBuilt(bool $built): ListInterface
    {
        $this->isBuilt = $built;
        return $this;
    }

    /**
     * @return $this
     */
    public function build(): ListInterface
    {
        $this->execute();
        $this->setBuilt(true);
        return $this;
    }

    /**
     * @return $this
     */
    abstract protected function execute(): ListInterface;
}
