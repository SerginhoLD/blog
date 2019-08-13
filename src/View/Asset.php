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
}
