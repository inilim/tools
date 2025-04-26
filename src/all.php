<?php

declare(strict_types=1);

namespace Inilim\Tool;

abstract class LazyMethodAbstract
{
    protected const NAMESPACE = '', PATH_TO_DIR = '', ALIAS = [], IDX = -1;
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
        $n = static::ALIAS[$name] ?? $name;
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
final class File extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\File', PATH_TO_DIR = __DIR__ . '/MethodMin/File', IDX = 3;
}
final class Path extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Path', PATH_TO_DIR = __DIR__ . '/MethodMin/Path', IDX = 8;
}
final class Arr extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Arr', PATH_TO_DIR = __DIR__ . '/MethodMin/Arr', IDX = 0, ALIAS = ['head' => 'first'];
}
final class Integer extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Integer', PATH_TO_DIR = __DIR__ . '/MethodMin/Integer', IDX = 5;
    // TINYINT: представляет целые числа от -128 до 127, занимает 1 байт
    // TINYINT UNSIGNED: представляет целые числа от 0 до 255, занимает 1 байт
    const TINY_INT_MAX = 127, TINY_INT_MIN = -127, TINY_INT_UNSIGNED_MAX = 255, TINY_INT_UNSIGNED_MIN = 0, TINY_INT_MAX_LENGHT = 3, TINY_INT_MIN_LENGHT = 3, TINY_INT_UNSIGNED_MAX_LENGHT = 3, TINY_INT_UNSIGNED_MIN_LENGHT = 1, SMALL_INT_MAX = 32767, SMALL_INT_MIN = -32768, SMALL_INT_UNSIGNED_MAX = 65535, SMALL_INT_UNSIGNED_MIN = 0, SMALL_INT_MAX_LENGHT = 5, SMALL_INT_MIN_LENGHT = 5, SMALL_INT_UNSIGNED_MAX_LENGHT = 5, SMALL_INT_UNSIGNED_MIN_LENGHT = 1, MEDIUM_INT_MAX = 8388607, MEDIUM_INT_MIN = -8388608, MEDIUM_INT_UNSIGNED_MAX = 16777215, MEDIUM_INT_UNSIGNED_MIN = 0, MEDIUM_INT_MAX_LENGHT = 7, MEDIUM_INT_MIN_LENGHT = 7, MEDIUM_INT_UNSIGNED_MAX_LENGHT = 8, MEDIUM_INT_UNSIGNED_MIN_LENGHT = 1, INT_MAX = 2147483647, INT_MIN = -2147483648, INT_MAX_LENGHT = 10, INT_MIN_LENGHT = 10, INT_MAX_UNSIGNED_LENGHT = 10, INT_MIN_UNSIGNED_LENGHT = 1, BIG_INT_MAX_LENGHT = 19, BIG_INT_MIN_LENGHT = 19, BIG_INT_MAX_UNSIGNED_LENGHT = 20, BIG_INT_MIN_UNSIGNED_LENGHT = 1, MAX_LEN_32_BIT = 10;
}
final class Double extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Double', PATH_TO_DIR = __DIR__ . '/MethodMin/Double', IDX = 2;
}
final class Data extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Data', PATH_TO_DIR = __DIR__ . '/MethodMin/Data', IDX = 1;
}
final class Str extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Str', PATH_TO_DIR = __DIR__ . '/MethodMin/Str', IDX = 9;
}
final class Other extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Other', PATH_TO_DIR = __DIR__ . '/MethodMin/Other', IDX = 7;
}
final class Json extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Json', PATH_TO_DIR = __DIR__ . '/MethodMin/Json', IDX = 6;
}
final class FS extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\FS', PATH_TO_DIR = __DIR__ . '/MethodMin/FS', IDX = 4;
}
final class Zip extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Zip', PATH_TO_DIR = __DIR__ . '/MethodMin/Zip', IDX = 10;
}
final class Refl extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Refl', PATH_TO_DIR = __DIR__ . '/MethodMin/Refl', IDX = 11;
}
final class ID extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\ID', PATH_TO_DIR = __DIR__ . '/MethodMin/ID', IDX = 12;
}
final class Time extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Time', PATH_TO_DIR = __DIR__ . '/MethodMin/Time', IDX = 13;
}
final class Obj extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Obj', PATH_TO_DIR = __DIR__ . '/MethodMin/Obj', IDX = 14;
}
final class Assert extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Assert', PATH_TO_DIR = __DIR__ . '/MethodMin/Assert', IDX = 15;
}
final class Exp extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Exp', PATH_TO_DIR = __DIR__ . '/MethodMin/Exp', IDX = 16;
}
final class Enum extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Enum', PATH_TO_DIR = __DIR__ . '/MethodMin/Enum', IDX = 17;
}
final class VD extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\VD', PATH_TO_DIR = __DIR__ . '/MethodMin/VD', IDX = 18;
}
final class Check extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Check', PATH_TO_DIR = __DIR__ . '/MethodMin/Check', IDX = 19;
}
final class PF extends LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\PF', PATH_TO_DIR = __DIR__ . '/MethodMin/PF', IDX = 20;
}