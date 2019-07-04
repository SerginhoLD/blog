<?php
namespace Blog\Security;

/**
 * Interface UserInterface
 * @package Blog\Security
 */
interface UserInterface
{
    /**
     * @return string
     */
    public function getLogin(): string;

    /**
     * @return string
     */
    public function getPasswordHash(): string;
}
