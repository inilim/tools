<?php

abstract class LazyMethodAbstract
{
    protected const NAME = 'Arr',
        ALIAS            = [],
        IDX              = 1;

    /**
     * @var array<string,array<string,true>>
     */
    static protected array $exists = [];

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
        $cN = static::NAME;
        $fn = 'Inilim\\Tool\\Method\\' . $cN . '\\' . $n;
        $cI = static::IDX;
        $e = &self::$exists;

        if (isset($e[$cI][$n])) {
            return $fn;
        }

        $file = __DIR__ . '/MethodMin/' . $cN . '/' . $n . '.php';

        if (\is_file($file)) {
            require $file;

            if (\function_exists($fn)) {
                $e[$cI] ??= [];
                $e[$cI][$n] = true;
                return $fn;
            }
        }

        return false;
    }
}


$a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];

$start = \microtime(true);
for ($i = 0; $i <= 10_000; $i++) {
    LazyMethodAbstract::__callStatic('get', [$a, 4]);
}
echo \microtime(true) - $start;
