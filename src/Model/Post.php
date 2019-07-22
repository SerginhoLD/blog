<?php
namespace Blog\Model;

use RedBeanPHP\SimpleModel;

/**
 * Class Post
 * @package Blog\Model
 */
class Post extends SimpleModel implements PostInterface
{
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
