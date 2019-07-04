<?php
declare(strict_types = 1);

namespace Blog\Security;

use Phalcon\Mvc\User\Plugin;

/**
 * Class AuthPlugin
 * @package Blog\Security
 *
 * @property-read UserRepository $users
 * @property-read AuthRepository $AuthRepository
 */
class AuthPlugin extends Plugin
{
    private const COOKIE_TTL = 86400 * 7;

    /**
     * @param string $login
     * @param string $password
     * @return bool
     * @throws \RuntimeException
     */
    public function login(string $login, string $password): bool
    {
        $user = $this->users->getByLogin($login);

        if (!$user || !$this->security->checkHash($password, $user->getPasswordHash()))
            return false;

        $authHash = $this->security->hash($user->getPasswordHash());

        $auth = new Auth($login, $authHash);
        $this->AuthRepository->save($auth);

        $this->cookies->set('i', $authHash, time() + self::COOKIE_TTL);

        return true;
    }

    /**
     * @return bool
     */
    public function authByCookie(): bool
    {
        /** @var string|null $authHash */
        $authHash = $this->cookies->has('i') ? $this->cookies->get('i')->getValue() : null;

        if (empty($authHash))
            return false;

        $auth = $this->AuthRepository->getByHash($authHash);

        if (!$auth)
            return false;

        $user = $this->users->getByLogin($auth->getLogin());
        return $user && $this->security->checkHash($user->getPasswordHash(), $authHash);
    }
}
