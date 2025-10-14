<?php

declare(strict_types=1);

namespace Inilim\Tool;

abstract class LazyMethodAbstract
{
    protected const NAME = '', ALIAS = [], IDX = -1;
    /**
     * @var array<string,array<string,true>>
     */
    protected static array $map = [];
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
                throw new \RuntimeException('Undefined method Inilim\Tool\Method\\' . static::NAME . '\\' . $n);
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
        throw new \RuntimeException('Call to undefined method Inilim\Tool\Method\\' . static::NAME . '\\' . $name);
    }
    /**
     * @return callable|false
     */
    protected static function init(string $name)
    {
        $n = (string) (static::ALIAS[$name] ?? $name);
        $fn = 'Inilim\Tool\Method\\' . static::NAME . '\\' . $n;
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
final class Num extends \Inilim\Tool\Integer
{
}
final class File extends LazyMethodAbstract
{
    protected const NAME = 'File', IDX = 3;
}
final class Path extends LazyMethodAbstract
{
    protected const NAME = 'Path', IDX = 8;
}
final class Arr extends LazyMethodAbstract
{
    protected const NAME = 'Arr', IDX = 0;
}
class Integer extends LazyMethodAbstract
{
    protected const NAME = 'Integer', IDX = 5;
    // TINYINT: представляет целые числа от -128 до 127, занимает 1 байт
    // TINYINT UNSIGNED: представляет целые числа от 0 до 255, занимает 1 байт
    const TINY_INT_MAX = 127, TINY_INT_MIN = -127, TINY_INT_UNSIGNED_MAX = 255, TINY_INT_UNSIGNED_MIN = 0, TINY_INT_MAX_LENGHT = 3, TINY_INT_MIN_LENGHT = 3, TINY_INT_UNSIGNED_MAX_LENGHT = 3, TINY_INT_UNSIGNED_MIN_LENGHT = 1, SMALL_INT_MAX = 32767, SMALL_INT_MIN = -32768, SMALL_INT_UNSIGNED_MAX = 65535, SMALL_INT_UNSIGNED_MIN = 0, SMALL_INT_MAX_LENGHT = 5, SMALL_INT_MIN_LENGHT = 5, SMALL_INT_UNSIGNED_MAX_LENGHT = 5, SMALL_INT_UNSIGNED_MIN_LENGHT = 1, MEDIUM_INT_MAX = 8388607, MEDIUM_INT_MIN = -8388608, MEDIUM_INT_UNSIGNED_MAX = 16777215, MEDIUM_INT_UNSIGNED_MIN = 0, MEDIUM_INT_MAX_LENGHT = 7, MEDIUM_INT_MIN_LENGHT = 7, MEDIUM_INT_UNSIGNED_MAX_LENGHT = 8, MEDIUM_INT_UNSIGNED_MIN_LENGHT = 1, INT_MAX = 2147483647, INT_MIN = -2147483648, INT_UNSIGNED_MAX = 4294967295, INT_UNSIGNED_MAX_AS_STRING = '4294967295', INT_UNSIGNED_MIN = 0, INT_MAX_LENGHT = 10, INT_MIN_LENGHT = 10, INT_MAX_UNSIGNED_LENGHT = 10, INT_MIN_UNSIGNED_LENGHT = 1, BIG_INT_MAX = 9223372036854775807, BIG_INT_MAX_AS_STRING = '9223372036854775807', BIG_INT_MIN = -9.223372036854776E+18, BIG_INT_MIN_AS_STRING = '-9223372036854775808', BIG_INT_UNSIGNED_MAX = 1.8446744073709552E+19, BIG_INT_UNSIGNED_MAX_AS_STRING = '18446744073709551615', BIG_INT_UNSIGNED_MIN = 0, BIG_INT_MAX_LENGHT = 19, BIG_INT_MIN_LENGHT = 19, BIG_INT_MAX_UNSIGNED_LENGHT = 20, BIG_INT_MIN_UNSIGNED_LENGHT = 1, MAX_LEN_32_BIT = 10;
}
final class Double extends LazyMethodAbstract
{
    protected const NAME = 'Double', IDX = 2;
}
final class Data extends LazyMethodAbstract
{
    protected const NAME = 'Data', IDX = 1;
}
final class Str extends LazyMethodAbstract
{
    protected const NAME = 'Str', IDX = 9, ALIAS = ['pascal' => 'studly'];
}
final class Other extends LazyMethodAbstract
{
    protected const NAME = 'Other', IDX = 7;
}
final class Json extends LazyMethodAbstract
{
    protected const NAME = 'Json', IDX = 6, ALIAS = ['isJson' => 'is'];
}
final class FS extends LazyMethodAbstract
{
    protected const NAME = 'FS', IDX = 4;
}
final class Zip extends LazyMethodAbstract
{
    protected const NAME = 'Zip', IDX = 10;
}
final class Refl extends LazyMethodAbstract
{
    protected const NAME = 'Refl', IDX = 11;
}
final class ID extends LazyMethodAbstract
{
    protected const NAME = 'ID', IDX = 12;
}
final class Time extends LazyMethodAbstract
{
    protected const NAME = 'Time', IDX = 13;
}
final class Obj extends LazyMethodAbstract
{
    protected const NAME = 'Obj', IDX = 14;
}
final class Assert extends LazyMethodAbstract
{
    protected const NAME = 'Assert', IDX = 15;
}
final class Exp extends LazyMethodAbstract
{
    protected const NAME = 'Exp', IDX = 16;
}
final class Enum extends LazyMethodAbstract
{
    protected const NAME = 'Enum', IDX = 17;
}
final class VD extends LazyMethodAbstract
{
    protected const NAME = 'VD', IDX = 18;
}
final class Check extends LazyMethodAbstract
{
    protected const NAME = 'Check', IDX = 19;
}
final class PF extends LazyMethodAbstract
{
    protected const NAME = 'PF', IDX = 20;
    const MB_CASE_UPPER = 0, MB_CASE_LOWER = 1, MB_CASE_TITLE = 2, MB_CASE_FOLD = 3;
}
final class Xml extends LazyMethodAbstract
{
    protected const NAME = 'Xml', IDX = 21;
}
final class Sql extends LazyMethodAbstract
{
    protected const NAME = 'Sql', IDX = 22;
}
final class LarArr extends LazyMethodAbstract
{
    protected const NAME = 'LarArr', IDX = 23;
}
final class Lar extends LazyMethodAbstract
{
    protected const NAME = 'Lar', IDX = 24;
}
final class LarStr extends LazyMethodAbstract
{
    protected const NAME = 'LarStr', IDX = 25;
}