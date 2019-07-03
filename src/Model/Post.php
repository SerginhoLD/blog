<?php
declare(strict_types = 1);

namespace Blog\Model;

use Phalcon\Mvc\Model;

class Post extends Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type='integer', nullable=false)
     */
    public $id;

    /**
     * @Column(type='string', nullable=false)
     */
    public $slug;

    /**
     * @Column(type='string', nullable=false)
     */
    public $name;

    public function initialize()
    {
        $this->setSource('post');
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
