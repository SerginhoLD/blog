<?php
declare(strict_types = 1);

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
    public function parse(string $s): string
    {
        return $this->parsedown->text($s);
    }
}
