<?php
declare(strict_types = 1);

namespace Blog\Security;

/**
 * Class Auth
 * @package Blog\Model
 */
class Auth implements AuthInterface
{
    /** @var */
    private $login;

    /** @var */
    private $hash;

    /**
     * @param string $login
     * @param string $hash
     */
    public function __construct(string $login, string $hash)
    {
        $this->login = $login;
        $this->hash = $hash;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }
}
