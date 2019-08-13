<?php
namespace Blog\View;

/**
 * Interface MetaInterface
 * @package Blog\View
 */
interface MetaInterface
{
    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string|string[] $title
     * @return MetaInterface
     */
    public function setTitle($title): MetaInterface;
}
