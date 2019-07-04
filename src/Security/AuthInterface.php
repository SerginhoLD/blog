<?php
namespace Blog\Security;

/**
 * Interface AuthInterface
 * @package Blog\Model
 */
interface AuthInterface
{
    /**
     * @return string|null
     */
    public function getLogin(): ?string;

    /**
     * @return string|null
     */
    public function getHash(): ?string;
}
