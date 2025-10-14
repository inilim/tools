<?php

namespace Inilim\Tool;

abstract class LazyMethodAbstract
{
    protected const NAME = '',
        /** @var array<string,string> from => to | example: nameFn => myCustomNewName */
        ALIAS            = [],
        IDX              = -1;

    /**
     * @var array<string,array<string,true>>
     */
    static protected array $map = [];

    /**
     * @param string ...$name
     * @return \Closure|\Closure[]
     */
    static function __asClosure(string ...$name)
    {
        $result = [];
        foreach ($name as $n) {
            $fn = self::init($n);
            if ($fn === false) {
                throw new \RuntimeException('Undefined method Inilim\\Tool\\Method\\' . static::NAME . '\\' . $n);
            } else {
                $result[] = \Closure::fromCallable($fn);
            }
        }

        // if true more one
        return isset($result[1]) ? $result : $result[0];
    }

    /**
     * @internal desc
     * @param string $name
     * @param mixed[] $args
     * @return mixed|void
     */
    static function __callStatic(string $name, array $args)
    {
        $fn = self::init($name);

        if ($fn !== false) {
            return $fn(...$args);
        }

        throw new \RuntimeException('Call to undefined method Inilim\\Tool\\Method\\' . static::NAME . '\\' . $name);
    }

    /**
     * @return callable|false
     */
    static protected function init(string $name)
    {
        $n  = (string)(static::ALIAS[$name] ?? $name);
        $fn = 'Inilim\\Tool\\Method\\' . static::NAME . '\\' . $n;

        if (isset(self::$map[static::IDX][$n])) {
            return $fn;
        }

        $file = __DIR__ . '/MethodMin/' . static::NAME . '/' . $n . '.php';

        if (\is_file($file)) {
            require $file;

            if (\function_exists($fn)) {
                self::$map[static::IDX] ??= [];
                self::$map[static::IDX][$n] = true;
                return $fn;
            }
        }

        return false;
    }

    /**
     * @internal
     */
    static function __definedIfNot(string $name): bool
    {
        $status = isset(self::$map[static::IDX][$name]);

        if (!$status) {
            self::$map[static::IDX] ??= [];
            self::$map[static::IDX][$name] = true;
        }

        return $status;
    }
}
