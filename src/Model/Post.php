<?php
namespace Blog\Model;

use RedBeanPHP\SimpleModel;

/**
 * Class Post
 * @package Blog\Model
 */
class Post extends SimpleModel implements PostInterface
{
    private $tags;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug ?? null;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getPreview(): ?string
    {
        return $this->preview ?? null;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text ?? null;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at ?? null;
    }

    /**
     * @return string|null
     */
    public function getFullText(): ?string
    {
        $list = array_filter([$this->getPreview(), $this->getText()], function ($text) {
            return $text !== null;
        });

        return !empty($list) ? implode(PHP_EOL . PHP_EOL, $list) : null;
    }

    /**
     * @return TagInterface[]
     */
    public function getTags(): array
    {
        if ($this->tags === null)
        {
            $this->tags = [];

            foreach ($this->sharedTag as $k => $item)
            {
                $this->tags[$k] = $item->box();
            }
        }

        return $this->tags;
    }
}
