<?php
declare(strict_types = 1);

namespace Blog\Console;

use Phalcon\Cli;

/**
 * Class Task
 * @package Blog\Console
 */
abstract class Task extends Cli\Task
{
    /**
     * @param string $s
     */
    protected function writeln(string $s)
    {
        fwrite(STDOUT, $s . PHP_EOL);
    }

    /**
     * @return string
     */
    protected function getProjectDir(): string
    {
        return realpath(__DIR__ . '/../..');
    }
}
