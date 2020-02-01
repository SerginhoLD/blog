<?php
namespace Blog\Model;

use Doctrine\Common\Collections\Collection;

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
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface;

    /**
     * @return string|null
     */
    public function getFullText(): ?string;

    /**
     * @return Collection|TagInterface[]
     */
    public function getTags(): Collection;
}
