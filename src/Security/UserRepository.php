<?php
declare(strict_types = 1);

namespace Blog\Security;

/**
 * Class UserRepository
 * @package Blog\Security
 */
class UserRepository
{
    /** @var array|mixed */
    private $users = [];

    /**
     * @param string $usersFile
     */
    public function __construct(string $usersFile)
    {
        $users = @json_decode(file_get_contents($usersFile), true);

        if (json_last_error() === JSON_ERROR_NONE)
            $this->users = $users;
    }

    /**
     * @param string $login
     * @return UserInterface|null
     */
    public function getByLogin(string $login): ?UserInterface
    {
        $data = current(array_filter($this->users, function ($item) use ($login) {
            return $item['login'] === $login;
        }));

        return !empty($data) ? new User($data['login'], $data['password_hash']) : null;
    }
}
