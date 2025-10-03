<?php

namespace Inilim\Tool;

class Assert
{
        /**
 * @author webmozarts/assert
 * @psalm-assert iterable<string> $value
 * @phpstan-assert iterable<string> $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function allString($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert false $value
 * @phpstan-assert false $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function boolFalse($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert true $value
 * @phpstan-assert true $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function boolTrue($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert bool $value
 * @phpstan-assert bool $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function boolean($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-assert class-string $value
 * @phpstan-assert class-string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function classExists($value, string $message = '') {}

        /**
 * @author inilim
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * @param mixed $value
 *
 * @throws \InvalidArgumentException
 */
    static function contains($value, string $subString, bool $ingnoreCase = false, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function directory($value, string $message = '') {}

        /**
 * @author Inilim
 * @psalm-assert \UnitEnum $value
 * @phpstan-assert \UnitEnum $value
 * 
 * 
 * @param mixed $value
 * @return void
 * @throws \InvalidArgumentException
 */
    static function enumCase($value, string $message = '') {}

        /**
 * @author Inilim
 * @throws \InvalidArgumentException
 */
    static function existSqliteLib(string $message = '') {}

        /**
 * @author Inilim
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
    static function extPhp(string $nameExt, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function file($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert float $value
 * @phpstan-assert float $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function float($value, string $message = '') {}

        /**
 * @author guzzle/guzzle
 * @see https://datatracker.ietf.org/doc/html/rfc7230#section-3.2
 * @psalm-assert string $value
 * @phpstan-assert string $value
 *
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function httpHeaderName($value, string $message = '') {}

        /**
 * @see https://datatracker.ietf.org/doc/html/rfc7230#section-3.2
 * @author guzzle/guzzle
 * field-value    = *( field-content / obs-fold )
 * field-content  = field-vchar [ 1*( SP / HTAB ) field-vchar ]
 * field-vchar    = VCHAR / obs-text
 * VCHAR          = %x21-7E
 * obs-text       = %x80-FF
 * obs-fold       = CRLF 1*( SP / HTAB )
 * 
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function httpHeaderValue($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * Does strict comparison, so Assert::inArray(3, ['3']) does not pass the assertion.
 * @psalm-pure
 * @template T of mixed
 * @psalm-assert T $value
 * @phpstan-assert T $value
 * 
 * @param T $value
 * @param T[] $values
 * @throws \InvalidArgumentException
 */
    static function inArray($value, array $values, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int $value
 * @phpstan-assert int $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function integer($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert numeric $value
 * @phpstan-assert numeric $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function integerish($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert T|class-string<T> $value
 * @phpstan-assert T|class-string<T> $value
 * 
 * 
 * @param object|string $value
 * @param class-string<T>[] $classes
 * @throws \InvalidArgumentException
 */
    static function isAnyOf($value, array $classes, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert mixed[] $value
 * @phpstan-assert mixed[] $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function isArray($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-assert callable $value
 * @phpstan-assert callable $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function isCallable($value, string $message = '') {}

        /**
 * @psalm-pure
 * @psalm-import-type Main_Countable from \TypeMain
 * @psalm-assert Main_Countable $value
 * @phpstan-assert Main_Countable $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function isCountable($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert T $value
 * @phpstan-assert T $value
 * 
 * 
 * @param mixed $value
 * @param T|class-string<T> $class
 * @throws \InvalidArgumentException
 */
    static function isInstanceOf($value, $class, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T of object
 * @psalm-assert T $value
 * @phpstan-assert T $value
 * 
 * @param mixed                $value
 * @param array<T|class-string<T>> $classes
 * @throws \InvalidArgumentException
 */
    static function isInstanceOfAny($value, array $classes, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert iterable $value
 * @phpstan-assert iterable $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function isIterable($value, string $message = '') {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert mixed[] $value
 * @phpstan-assert mixed[] $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function isNonEmptyArray($value, string $message = '') {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
    static function json($value, string $message = '') {}

        /**
 * @author inilim
 * @psalm-pure
 * @template K of int|string
 * @psalm-assert array<K,mixed> $value
 * @phpstan-assert array<K,mixed> $value
 * 
 * @param mixed $value
 * @param K[] $keys
 * @throws \InvalidArgumentException
 */
    static function keysExists($value, array $keys, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int<0,max> $value
 * @phpstan-assert int<0,max> $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function natural($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * 
 * @param mixed  $value
 * @param mixed  $expect
 * @throws \InvalidArgumentException
 */
    static function notEq($value, $expect, string $message = '') {}

        /**
 * @author webmozarts/assert
 * Does strict comparison, so Assert::notInArray(3, ['3']) does not pass the assertion.
 * @psalm-pure
 * @template T1 of mixed
 * @template T2 of mixed
 * @psalm-assert T1 $value
 * @phpstan-assert T1 $value
 * 
 * @param T1 $value
 * @param T2[] $values
 * @throws \InvalidArgumentException
 */
    static function notInArray($value, array $values, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert numeric $value
 * @phpstan-assert numeric $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function numeric($value, string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
    static function php80(string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
    static function php81(string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
    static function php82(string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
    static function php83(string $message = '') {}

        /**
 * @author Inilim
 * equal to or greater than
 * 
 * @return void
 * @throws \InvalidArgumentException
 */
    static function php84(string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert float $value
 * @phpstan-assert float $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function positiveFloat($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int<1,max>|float $value
 * @phpstan-assert int<1,max>|float $value
 * 
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function positiveFloatOrInt($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int<1,max> $value
 * @phpstan-assert int<1,max> $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function positiveInteger($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert resource|string $value
 * @phpstan-assert resource|string $value
 *
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 *
 * @throws \InvalidArgumentException
 */
    static function resOrStr($value, ?string $type = null, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert resource $value
 * @phpstan-assert resource $value
 *
 * @param mixed       $value
 * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
 *
 * @throws \InvalidArgumentException
 */
    static function resource($value, ?string $type = null, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T1 of mixed
 * @template T2 of mixed
 * @psalm-assert T2 $value
 * @phpstan-assert T2 $value
 * 
 *
 * @param T1 $value
 * @param T2 $expect
 * 
 * @throws \InvalidArgumentException
 */
    static function same($value, $expect, string $message = '') {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string|mixed[] $value
 * @phpstan-assert string|mixed[] $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function strOrArr($value, string $message = '') {}

        /**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string|bool $value
 * @phpstan-assert string|bool $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function strOrBool($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function string($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert non-empty-string $value
 * @phpstan-assert non-empty-string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function stringNotEmpty($value, string $message = '') {}

        /**
 * @author webmozarts/assert
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @psalm-assert int|string $value
 * @phpstan-assert int|string $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
    static function validArrayKey($value, string $message = '') {}

    }