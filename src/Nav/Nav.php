<?php
declare(strict_types = 1);

namespace Blog\Nav;

use Slim\Interfaces\RouteParserInterface;

/**
 * Class Nav
 * @package Blog\Nav
 */
class Nav implements NavInterface
{
    /** @var int */
    private $strategy = self::STRATEGY_PUBLIC;

    /** @var RouteParserInterface */
    private $routeParser;

    /**
     * @param RouteParserInterface $routeParser
     */
    public function __construct(RouteParserInterface $routeParser)
    {
        $this->routeParser = $routeParser;
    }

    /**
     * @param int $strategy
     * @return NavInterface
     */
    public function setStrategy(int $strategy): NavInterface
    {
        $this->strategy = $strategy;
        return $this;
    }

    /**
     * @return array [
     *   [
     *     'url' => (string),
     *     'name' => (string),
     *   ]
     * ]
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getItems(): array
    {
        return $this->strategy === self::STRATEGY_PUBLIC
            ? [
                [
                    'url' => $this->routeParser->urlFor('blog'),
                    'name' => 'Блог',
                ],
                [
                    'url' => $this->routeParser->urlFor('contacts'),
                    'name' => 'Контакты',
                ],
            ]
            : [
                [
                    'url' => $this->routeParser->urlFor('admin'),
                    'name' => 'Админ.панель',
                ],
                [
                    'url' => $this->routeParser->urlFor('post-edit'),
                    'name' => 'Добавить запись',
                ],
                [
                    'url' => $this->routeParser->urlFor('tag-edit'),
                    'name' => 'Добавить тег',
                ],
            ];
    }
}
