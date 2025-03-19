<?php

namespace Inilim\Tool;

abstract class LazyMethodAbstract
{
    const IDX                   = -1;
    protected const NAMESPACE   = '',
        PATH_TO_DIR             = '',
        ALIAS                   = [];

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
    function __call($name, $args)
    {
        return self::__callStatic($name, $args);
    }

    /**
     * @internal desc
     * @param string $name
     * @param mixed[] $args
     * @return mixed|void
     */
    static function __callStatic($name, $args)
    {
        $n  = static::ALIAS[$name] ?? $name;
        $fn = static::NAMESPACE . '\\' . $n;

        if (isset(self::$exists[static::IDX][$n])) {
            return $fn(...$args);
        }

        $file = static::PATH_TO_DIR . '/' . $n . '.php';

        if (\is_file($file)) {
            require $file;

            if (\function_exists($fn)) {
                self::$exists[static::IDX] ??= [];
                self::$exists[static::IDX][$n] = true;
                return $fn(...$args);
            }
        }

        throw new \RuntimeException('Call to undefined method ' . static::NAMESPACE . '\\' . $name);
    }

    /**
     * @template T of mixed
     * @param T $value
     * @return object{value:T}&\stdClass
     */
    static function stdWrap($value)
    {
        $std = new \stdClass;
        $std->value = $value;
        return $std;
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
