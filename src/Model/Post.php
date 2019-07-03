<?php
namespace Blog\Model;

use Phalcon\Mvc\Model;

/**
 * Class Post
 * @package Blog\Model
 *
 * @method static Post[]|Model\Resultset\Simple find($parameters = null)
 * @method Tag[]|Model\Resultset\Simple getTags()
 */
class Post extends Model implements PostInterface
{
    /**
     * @Primary
     * @Identity
     * @Column(type='integer', nullable=false)
     */
    private $id;

    /**
     * @Column(type='varchar', length=255, nullable=false)
     */
    private $slug;

    /**
     * @Column(type='varchar', length=255, nullable=false)
     */
    private $name;

    public function initialize()
    {
        $this->setSource('post');

        $this->hasManyToMany(
            'id',
            PostTag::class,
            'post_id', 'tag_id',
            Tag::class,
            'id',
            [
                'alias' => 'tags',
            ]
        );
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
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
