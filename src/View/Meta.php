<?php
declare(strict_types = 1);

namespace Blog\View;

/**
 * Class Meta
 * @package Blog\View
 */
class Meta implements MetaInterface
{
    /** @var string */
    private $title = 'Блог';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title . ' · SerginhoLD';
    }

    /**
     * @param string|string[] $title
     * @return MetaInterface
     */
    public function setTitle($title): MetaInterface
    {
        if (is_array($title))
        {
            $title = implode(' · ', $title);
        }

        $this->title = $title;
        return $this;
    }
}
