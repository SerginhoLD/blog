<?php
namespace Blog\Model;

/**
 * Interface PostInterface
 * @package Blog\Model
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

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @return string|null
     */
    public function getFullText(): ?string;

    /**
     * @return TagInterface[]
     */
    public function getTags(): array;
}
