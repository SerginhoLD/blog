<?php
declare(strict_types = 1);

namespace Blog\Model;

use Phalcon\Mvc\Model;

class PostTag extends Model
{
    /**
     * @Primary
     * @Column(type='integer', nullable=false)
     */
    private $post_id;

    /**
     * @Primary
     * @Column(type='integer', nullable=false)
     */
    private $tag_Id;

    public function initialize()
    {
        $this->setSource('post_tag');

        $this->belongsTo(
            'post_id',
            Post::class,
            'id'
        );

        $this->belongsTo(
            'tag_id',
            Tag::class,
            'id'
        );
    }
}
