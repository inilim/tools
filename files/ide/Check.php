<?php

namespace Inilim\Tool;

class Check
{
        /**
 * @author Inilim
 * @psalm-assert-if-true iterable<mixed[]> $value
 * @phpstan-assert-if-true iterable<mixed[]> $value
 * 
 * @param mixed  $value
 */
    static function allArray($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true iterable<bool> $value
 * @phpstan-assert-if-true iterable<bool> $value
 * 
 * @param mixed  $value
 */
    static function allBool($value): bool {}

        /**
 * @author Inilim
 * @psalm-pure
 * @param mixed  $value
 * @param mixed[] $values
 */
    static function allInArray($value, array $values): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true iterable<null|mixed[]> $value
 * @phpstan-assert-if-true iterable<null|mixed[]> $value
 * 
 * @param mixed  $value
 */
    static function allNullOrArray($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true iterable<null|bool> $value
 * @phpstan-assert-if-true iterable<null|bool> $value
 * 
 * @param mixed  $value
 */
    static function allNullOrBool($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true iterable<string> $value
 * @phpstan-assert-if-true iterable<string> $value
 * 
 * @param mixed $value
 */
    static function allString($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true \ArrayAccess $value
 * @phpstan-assert-if-true \ArrayAccess $value
 * 
 * @param mixed $value
 */
    static function arrAccess($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true \ArrayAccess&\Traversable&\Countable $value
 * @phpstan-assert-if-true \ArrayAccess&\Traversable&\Countable $value
 * 
 * @param mixed $value
 */
    static function arrLike($value): bool {}

        /**
 * @author inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 *
 * @param mixed $value
 */
    static function contains($value, string $subString, bool $ingnoreCase = false): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-import-type Main_Countable from \TypeMain
 * @psalm-assert-if-true Main_Countable $value
 * @phpstan-assert-if-true Main_Countable $value
 * 
 * @param mixed $value
 */
    static function countable($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 * @param mixed  $value
 */
    static function dir($value): bool {}

        /**
 * @author Inilim
 * @template T of mixed
 * @psalm-assert-if-true \UnitEnum $value
 * @phpstan-assert-if-true \UnitEnum $value
 * 
 * @param T $v
 */
    static function enumCase($v): bool {}

        /**
 * @author Inilim
 */
    static function existSqliteLib(): bool {}

        /**
 * INFO phpinfo берем из кеш файла
 * @author Inilim
 */
    static function existSqliteLib_m2(): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 * @param mixed  $value
 */
    static function file($value): bool {}

        /**
 * @author inilim
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 */
    static function httpHeaderName($value): bool {}

        /**
 * @author inilim
 * 
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed $value
 */
    static function httpHeaderValue($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true int|float $value
 * @phpstan-assert-if-true int|float $value
 * 
 * @param mixed  $value
 */
    static function intOrFloat($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true int|float|string $value
 * @phpstan-assert-if-true int|float|string $value
 * 
 * @param mixed  $value
 */
    static function intOrFloatOrFile($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true int|float|string $value
 * @phpstan-assert-if-true int|float|string $value
 * 
 * @param mixed  $value
 */
    static function intOrFloatOrString($value): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert-if-true T|class-string<T> $value
 * @phpstan-assert-if-true T|class-string<T> $value
 * 
 * @param object|string $value
 * @param class-string<T>[] $classes
 */
    static function isAnyOf($value, array $classes): bool {}

        /**
 * @author webmozarts/assert
 * @deprecated use Check::countable
 * @psalm-pure
 * @psalm-assert-if-true mixed[]\Countable|\ResourceBundle|\SimpleXMLElement $value
 * @phpstan-assert-if-true mixed[]\Countable|\ResourceBundle|\SimpleXMLElement $value
 * 
 * @param mixed  $value
 */
    static function isCountable($value): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * 
 * @psalm-assert-if-true T $value
 * @phpstan-assert-if-true T $value
 * 
 * @param mixed $value
 * @param array<T|class-string<T>> $classes
 */
    static function isInstanceOfAny($value, array $classes): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true iterable $value
 * @phpstan-assert-if-true iterable $value
 * 
 * 
 * @param mixed $value
 */
    static function isIterable($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed $value
 */
    static function isJson($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true mixed[] $value
 * @phpstan-assert-if-true mixed[] $value
 * 
 * 
 * @param mixed $value
 */
    static function isNonEmptyArray($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true \IteratorAggregate $value
 * @phpstan-assert-if-true \IteratorAggregate $value
 * @param mixed $value
 */
    static function iteratorAgg($value): bool {}

        /**
 * Validate whether a given input is a Luhn number.
 *
 * @see https://en.wikipedia.org/wiki/Luhn_algorithm
 *
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Inilim
 * 
 * @psalm-assert-if-true string|int $value
 * @phpstan-assert-if-true string|int $value
 * 
 * @param mixed $value
 */
    static function luhnNumber($value): bool {}

        /**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed $value
 */
    static function multiLineString($value): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert-if-true int<0,max> $value
 * @phpstan-assert-if-true int<0,max> $value
 * @param mixed  $value
 */
    static function natural($value): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php74(): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php80(): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php81(): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php82(): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php83(): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php84(): bool {}

        /**
 * @author Inilim
 * equal to or greater than
 */
    static function php85(): bool {}

        /**
 * @psalm-pure
 * @psalm-assert-if-true float $value
 * @phpstan-assert-if-true float $value
 * @param mixed  $value
 */
    static function positiveFloat($value): bool {}

        /**
 * @psalm-pure
 * @psalm-assert-if-true int<1,max>|float $value
 * @phpstan-assert-if-true int<1,max>|float $value
 * @param mixed  $value
 */
    static function positiveFloatOrInt($value): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert-if-true int<1,max> $value
 * @phpstan-assert-if-true int<1,max> $value
 * @param mixed  $value
 */
    static function positiveInteger($value): bool {}

        /**
 * check is valid regex
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string $regex
 * @phpstan-assert-if-true string $regex
 * @param mixed  $regex
 */
    static function regex($regex): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert-if-true resource|string $value
 * @phpstan-assert-if-true resource|string $value
 * 
 * 
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 */
    static function resOrStr($value, ?string $type = null): bool {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert-if-true resource $value
 * @phpstan-assert-if-true resource $value
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 */
    static function resource($value, ?string $type = null): bool {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string|mixed[] $value
 * @phpstan-assert-if-true string|mixed[] $value
 * 
 * 
 * @param mixed $value
 */
    static function strOrArr($value): bool {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string|bool $value
 * @phpstan-assert-if-true string|bool $value
 * 
 * 
 * @param mixed $value
 */
    static function strOrBool($value): bool {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 * 
 * @param mixed $value
 */
    static function uuidv7($value): bool {}

        /**
 * @author webmozarts/assert
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @psalm-assert-if-true int|string $value
 * @phpstan-assert-if-true int|string $value
 * 
 * @param mixed  $value
 */
    static function validArrayKey($value): bool {}

    }