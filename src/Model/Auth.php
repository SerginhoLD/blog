<?php
declare(strict_types = 1);

namespace Blog\Model;

use Phalcon\Mvc\Model;

/**
 * Class Auth
 * @package Blog\Model
 *
 * @method static static|false findFirst($parameters = null)
 */
class Auth extends Model implements AuthInterface
{
    /**
     * @Primary
     * @Identity
     * @Column(type='integer', nullable=false)
     */
    private $id;

    /**
     * @Column(type='varchar', length=45, nullable=false)
     */
    private $login;

    /**
     * @Column(type='varchar', length=255, nullable=false)
     */
    private $hash;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @param string $hash
     * @return static|false
     */
    public static function findByHash(string $hash)
    {
        return static::findFirst([
            'conditions' => 'hash = :hash:',
            'bind' => [
                'hash' => $hash,
            ],
        ]);
    }
}
