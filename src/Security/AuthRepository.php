<?php
declare(strict_types = 1);

namespace Blog\Security;

/**
 * Class AuthRepository
 * @package Blog\Security
 */
class AuthRepository
{
    /** @var string */
    private $file;

    /** @var array|mixed */
    private $list = [];

    /**
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;

        if (is_file($file))
        {
            $auth = @json_decode(file_get_contents($file), true);

            if (json_last_error() === JSON_ERROR_NONE)
                $this->list = $auth;
        }
    }

    /**
     * @param string $hash
     * @return AuthInterface|null
     */
    public function getByHash(string $hash): ?AuthInterface
    {
        $data = current(array_filter($this->list, function (array $item) use ($hash) {
            return $item['hash'] === $hash;
        }));

        return !empty($data) ? new Auth($data['login'], $data['hash']) : null;
    }

    /**
     * @param AuthInterface $auth
     * @throws \RuntimeException
     */
    public function save(AuthInterface $auth)
    {
        $this->list = array_filter($this->list, function (array $item) use ($auth) {
            return !($item['login'] === $auth->getLogin() && $item['hash'] === $auth->getHash());
        });

        $this->list[] = [
            'login' => $auth->getLogin(),
            'hash' => $auth->getHash(),
        ];

        $this->saveJson();
    }

    private function saveJson()
    {
        $data = json_encode($this->list, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $result = file_put_contents($this->file, $data);

        if ($result === false)
            throw new \RuntimeException("File {$this->file} not writable");
    }

    public function clear()
    {
        $this->list = [];
        $this->saveJson();
    }
}
