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
        $count = R::count('post');

        if ($count < 1)
            return $this;

        $this->setCount($count);

        $rList = R::find('post', 'ORDER BY id DESC LIMIT :offset, :limit', [
            'offset' => (int)$this->getOffset(),
            'limit' => (int)$this->getLimit(),
        ]);

        $items = [];

        foreach ($rList as $item)
        {
            $items[] = $item->box();
        }

        $this->setItems($items);
        return $this;
    }
}
