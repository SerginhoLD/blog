<?php
namespace Blog\Markdown;

use Parsedown;

/**
 * Class ParsedownParser
 * @package Blog\Markdown
 */
class ParsedownParser implements ParserInterface
{
    /** @var Parsedown */
    private $parsedown;

    /**
     * @param Parsedown $parsedown
     */
    public function __construct(Parsedown $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    /**
     * @param string $s
     * @return string
     */
    public function parse($s): string
    {
        return $this->parsedown->text($s ?? '');
    }
}
