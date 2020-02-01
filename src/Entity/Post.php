<?php
//declare(strict_types = 1);

namespace Blog\Entity;

use Blog\Model\PostInterface;
use Blog\Model\TagInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Blog\Repository\PostRepository")
 */
class Post implements PostInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private ?string $slug = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $preview = null;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $text = null;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private \DateTimeInterface $created_at;

    /**
     * @var Collection|TagInterface[]
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts", fetch="EAGER")
     */
    private Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
     * @param string $slug
     * @return $this
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @param string|null $preview
     * @return $this
     */
    public function setPreview(?string $preview): self
    {
        $this->preview = $preview;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullText(): ?string
    {
        $list = array_filter([$this->getPreview(), $this->getText()], function ($text) {
            return $text !== null;
        });

        return !empty($list) ? implode(PHP_EOL . PHP_EOL, $list) : null;
    }

    /**
     * @return Collection|TagInterface[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }
}
