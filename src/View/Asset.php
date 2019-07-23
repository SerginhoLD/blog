<?php
declare(strict_types = 1);

namespace Blog\View;

/**
 * Class Asset
 * @package Blog\View
 */
class Asset implements AssetInterface
{
    /** @var string */
    private $publicDir;

    /** @var string */
    private $title = 'Блог';

    /**
     * @param string $publicDir
     */
    public function __construct(string $publicDir)
    {
        $this->publicDir = $publicDir;
    }

    /**
     * @param string $src
     * @return string
     */
    public function src(string $src): string
    {
        $file = $this->publicDir . $src;

        if (!is_file($file))
            return $src;

        $version = hash('crc32', filemtime($file) . filesize($file));
        return $src . '?' . $version;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title . ' · SerginhoLD';
    }

    /**
     * @param string|string[] $title
     * @return $this
     */
    public function setTitle($title): AssetInterface
    {
        if (is_array($title))
        {
            $title = implode(' · ', $title);
        }

        $this->title = $title;
        return $this;
    }
}
