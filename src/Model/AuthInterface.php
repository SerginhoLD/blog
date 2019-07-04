<?php
namespace Blog\Model;

/**
 * Interface AuthInterface
 * @package Blog\Model
 */
interface AuthInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getLogin(): ?string;

    /**
     * @return string|null
     */
    public function getHash(): ?string;
}
