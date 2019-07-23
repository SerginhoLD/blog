<?php
declare(strict_types = 1);

namespace Blog\Lists;

use RedBeanPHP\R;

/**
 * Class PostList
 * @package Blog\Lists
 */
class PostList extends AbstractList
{
    /** @var int */
    protected $limit = 1;

    /**
     * @return ListInterface
     */
    protected function execute(): ListInterface
    {
        $parameters = $this->getParameters();
        $sql = $parameters['sql'] ?? null;
        $bind = $parameters['bind'] ?? [];

        $count = R::count('post', $sql, $bind);

        if ($count < 1)
            return $this;

        $this->setCount($count);

        $bind['offset'] = (int)$this->getOffset();
        $bind['limit'] = (int)$this->getLimit();

        $rList = R::find('post', $sql . ' ORDER BY id DESC LIMIT :offset, :limit', $bind);
        $items = [];

        foreach ($rList as $item)
        {
            $items[] = $item->box();
        }

        $this->setItems($items);
        return $this;
    }
}
