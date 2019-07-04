<?php
declare(strict_types = 1);

namespace Blog\Security;

use Phalcon\Mvc\User\Plugin;
use Blog\Model\Auth;

/**
 * Class AuthPlugin
 * @package Blog\Security
 */
class AuthPlugin extends Plugin
{
    private const COOKIE_TTL = 86400 * 7;

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function login(string $login, string $password): bool
    {
        /** @var UserRepository $users */
        $users = $this->getDI()->getShared('users');
        $user = $users->getByLogin($login);

        if (!$user || !$this->security->checkHash($password, $user->getPasswordHash()))
            return false;

        $authHash = $this->security->hash($user->getPasswordHash());

        $auth = new Auth();
        $auth->setLogin($login);
        $auth->setHash($authHash);
        $auth->save();

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

        $auth = Auth::findByHash($authHash);

        if (!$auth)
            return false;

        /** @var UserRepository $users */
        $users = $this->getDI()->getShared('users');
        $user = $users->getByLogin($auth->getLogin());

        return $user && $this->security->checkHash($user->getPasswordHash(), $authHash);
    }
}
