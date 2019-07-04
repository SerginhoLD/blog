<?php
declare(strict_types = 1);

namespace Blog\Console;

class UserTask extends Task
{
    public function mainAction(array $params)
    {
        $login = $params[0] ?? null;
        $password = $params[1] ?? null;

        /**
         * @var string|null $login
         * @var string|null $password
         */

        if ($login === null)
            $this->writeln('Не задано имя пользователя');

        if ($password === null)
            $this->writeln('Не задан пароль');

        if ($login !== null && $password !== null)
            $this->registerUser($login, $password);
    }

    private function registerUser(string $login, string $password)
    {
        $data = json_encode([
            [
                'login' => $login,
                'password_hash' => $this->security->hash($password),
            ]
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $result = file_put_contents($this->getProjectDir() . '/.phalcon/users.json', $data);

        $this->writeln($result === false ? 'Произошла ошибка' : 'Пользователь сохранен');
    }
}
