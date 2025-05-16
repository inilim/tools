<?php

namespace Inilim\Tool;

abstract class LazyMethodAbstract1
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
    static function __callStatic(string $name, array $args)
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
     */
    static function __definedIfNot(string $name): bool
    {
        $status = isset(self::$exists[static::IDX][$name]);

        if (!$status) {
            self::$exists[static::IDX] ??= [];
            self::$exists[static::IDX][$name] = true;
        }

        return $status;
    }
}
