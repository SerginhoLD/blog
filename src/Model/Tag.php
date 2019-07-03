<?php
namespace Blog\Model;

use Phalcon\Mvc\Model;

/**
 * Class Tag
 * @package Blog\Model
 *
 * @method static Tag[] find($parameters = null)
 */
class Tag extends Model implements TagInterface
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
    private $name;

    /**
     * @Column(type='varchar', length=45, nullable=true)
     */
    private $title;

    public function initialize()
    {
        $this->setSource('tag');
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
}
