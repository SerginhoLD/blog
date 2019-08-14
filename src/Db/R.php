<?php
declare(strict_types = 1);

namespace Blog\Db;

use RedBeanPHP\Facade;
use RedBeanPHP\SimpleModel;
use RedBeanPHP\OODBBean;

/**
 * Class R
 * @package Blog\Db
 */
class R extends Facade
{
    /**
     * @param string $type
     * @param string|null $sql
     * @param array $bindings
     * @return SimpleModel[]
     * @throws \RuntimeException
     */
    public static function findObjects(string $type, string $sql = null, array $bindings = []): array
    {
        $items = static::find($type, $sql, $bindings);
        return static::beansToObjects($items);
    }

    /**
     * @param OODBBean[] $beans
     * @return SimpleModel[]
     * @throws \RuntimeException
     */
    private static function beansToObjects(array $beans): array
    {
        $objects = [];

        foreach ($beans as $k => $item)
        {
            $object = $item->box();

            if (!$object)
                throw new \RuntimeException("Model not found");

            $objects[$k] = $object;
        }

        return $objects;
    }

    /**
     * @param string $type
     * @param string|null $sql
     * @param array $bindings
     * @return SimpleModel|null
     * @throws \RuntimeException
     */
    public static function findOneObject(string $type, string $sql = null, array $bindings = [])
    {
        $item = static::findOne($type, $sql, $bindings);
        return $item ? current(static::beansToObjects([$item])) : null;
    }
}
