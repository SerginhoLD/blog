<?php
declare(strict_types = 1);

namespace Blog\Security;

/**
 * Class User
 * @package Blog\Security
 */
class User implements UserInterface
{
    /** @var string */
    private $login;

    /** @var string */
    private $passwordHash;

    /**
     * @param string $login
     * @param string $passwordHash
     */
    public function __construct(string $login, string $passwordHash)
    {
        $this->login = $login;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}
