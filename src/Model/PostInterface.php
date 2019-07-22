<?php
namespace Blog\Model;

/**
 * Interface PostInterface
 * @package Blog\Model
 *
 * @method2 TagInterface[] getTags()
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

    /**
     * @return string|null
     */
    public function getPreview(): ?string;

    /**
     * @return string|null
     */
    public function getText(): ?string;
}
