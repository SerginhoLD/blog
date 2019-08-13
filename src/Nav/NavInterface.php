<?php
namespace Blog\Nav;

/**
 * Interface NavInterface
 * @package Blog\Nav
 */
interface NavInterface
{
    const STRATEGY_PUBLIC = 0;
    const STRATEGY_ADMIN = 1;

    /**
     * @param int $strategy
     * @return NavInterface
     */
    public function setStrategy(int $strategy): NavInterface;

    /**
     * @return array [
     *   [
     *     'url' => (string),
     *     'name' => (string),
     *   ]
     * ]
     */
    public function getItems(): array;
}
