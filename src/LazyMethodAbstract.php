<?php

namespace Inilim\Tool;

abstract class LazyMethodAbstract
{
    protected const NAME = '',
        ALIAS            = [],
        IDX              = -1;

    /**
     * @var array<string,array<string,true>>
     */
    protected static $exists = [];

    /**
     * @internal desc
     * @param string $name
     * @param mixed[] $args
     * @return mixed|void
     */
    static function __callStatic($name, $args)
    {
        $n  = static::ALIAS[$name] ?? $name;
        $fn = 'Inilim\\Tool\\Method\\' . static::NAME . '\\' . $n;

        if (isset(self::$exists[static::IDX][$n])) {
            return $fn(...$args);
        }

        $file = __DIR__ . '/MethodMin/' . static::NAME . '/' . $n . '.php';

        if (\is_file($file)) {
            require $file;

            if (\function_exists($fn)) {
                self::$exists[static::IDX] ??= [];
                self::$exists[static::IDX][$n] = true;
                return $fn(...$args);
            }
        }

        throw new \RuntimeException('Call to undefined method Inilim\\Tool\\Method\\' . static::NAME . '\\' . $name);
    }

    /**
     * @internal
     * @return bool
     */
    static function __definedIfNot(string $name)
    {
        $status = isset(self::$exists[static::IDX][$name]);

        if (!$status) {
            self::$exists[static::IDX] ??= [];
            self::$exists[static::IDX][static::ALIAS[$name] ?? $name] = true;
        }

        return $status;
    }
}
