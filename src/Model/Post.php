<?php
namespace Blog\Model;

use Phalcon\Mvc\Model;

/**
 * Class Post
 * @package Blog\Model
 *
 * @method static Post[]|Model\Resultset\Simple find($parameters = null)
 * @method static Post|false findFirst($parameters = null)
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

    /**
     * @Column(type='text', nullable=true)
     */
    private $preview;

    /**
     * @Column(type='text', nullable=false)
     */
    private $text;

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

    /**
     * @return string|null
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @return string|null
     */
    public function getPreviewHtml(): ?string
    {
        return $this->parseMarkdown($this->getPreview());
    }

    /**
     * @param $s
     * @return string|null
     */
    private function parseMarkdown($s): ?string
    {
        return $s !== null ? $this->getDI()->getShared('markdown')->parse($s) : null;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string|null
     */
    public function getTextHtml(): ?string
    {
        return $this->parseMarkdown($this->getText());
    }

    /**
     * @return string|null
     */
    public function getHtml(): ?string
    {
        $list = array_filter([$this->getPreviewHtml(), $this->getTextHtml()], function ($item) {
            return $item !== null;
        });

        return !empty($list) ? implode("\n", $list) : null;
    }
}
