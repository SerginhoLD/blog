<?php
declare(strict_types = 1);

namespace Blog\Formatter;

use DateTimeInterface;
use DateTime;

/**
 * Class DateFormatter
 * @package Blog\Formatter
 */
class DateFormatter implements DateFormatterInterface
{
    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function format($date): string
    {
        if (!$date instanceof DateTimeInterface)
            $date = new DateTime($date);

        return $date->format('d.m.Y');
    }
}
