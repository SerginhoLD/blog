<?php
namespace Blog\Markdown;

/**
 * Interface ParserInterface
 * @package Blog\Markdown
 */
interface ParserInterface
{
    /**
     * @param string $s
     * @return string
     */
    public function parse($s): string;
}
