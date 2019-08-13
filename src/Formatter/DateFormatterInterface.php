<?php
namespace Blog\Formatter;

/**
 * Interface DateFormatterInterface
 * @package Blog\Formatter
 */
interface DateFormatterInterface
{
    /**
     * @param $date
     * @return string
     */
    public function format($date): string;
}
