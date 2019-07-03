<?php
namespace Blog\Model;

/**
 * Interface PostInterface
 * @package Blog\Model
 *
 * @method TagInterface[] getTags()
 */
interface PostInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getSlug(): ?string;

    /**
     * @return string|null
     */
    public function getName(): ?string;
}
