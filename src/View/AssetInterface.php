<?php
namespace Blog\View;

/**
 * Interface AssetInterface
 * @package Blog\View
 */
interface AssetInterface
{
    /**
     * @param string $src
     * @return string
     */
    public function src(string $src): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string|string[] $title
     * @return AssetInterface
     */
    public function setTitle($title): AssetInterface;
}
