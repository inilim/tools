<?php

namespace Inilim\Tool;

abstract class LazyMethodAbstract
{
    protected const NAME = '',
        ALIAS            = [],
        IDX              = -1;

    /**
     * @var array<string,array<string,\Closure>>
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
                throw new \RuntimeException('Undefined method ' . static::NAME . '::' . $n);
            } else {
                $result[] = $fn;
            }
        }

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

        throw new \RuntimeException('Call to undefined method ' . static::NAME . '::' . $name);
    }

    /**
     * @return \CLosure|false
     */
    static protected function init(string $name, bool $include = true)
    {
        $n  = (string)(static::ALIAS[$name] ?? $name);

        if (isset(self::$map[static::IDX][$n])) {
            return self::$map[static::IDX][$n];
        }

        $file = __DIR__ . '/MethodMin/' . static::NAME . '/' . $n . '.php';

        if (\is_file($file)) {
            require $file;

            $fn = 'Inilim\\Tool\\Method\\' . static::NAME . '\\' . $n;
            if (\function_exists($fn)) {
                self::$map[static::IDX] ??= [];
                return self::$map[static::IDX][$n] = \Closure::fromCallable($fn);
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
            self::init($name, false);
        }

        return $status;
    }
}
