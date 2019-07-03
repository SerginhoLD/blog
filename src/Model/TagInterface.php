<?php
namespace Blog\Model;

/**
 * Interface TagInterface
 * @package Blog\Model
 */
interface TagInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return string|null
     */
    public function getTitle(): ?string;
}
