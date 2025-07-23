<?php

namespace Inilim\Tool;

class Check
{
        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function allArray($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function allBool($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function allNullOrArray($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function allNullOrBool($value): bool {}

        /**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \ArrayAccess $value
 */
    static function arrAccess($value): bool {}

        /**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \ArrayAccess&\Traversable&\Countable $value
 */
    static function arrLike($value): bool {}

        /**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true mixed[]|\Countable $value
 */
    static function countable($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function dir($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function file($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function intOrFloat($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function intOrFloatOrFile($value): bool {}

        /**
 * @author Inilim
 * @param mixed  $value
 */
    static function intOrFloatOrString($value): bool {}

        /**
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param object|string $value
 * @param string[]      $classes
 */
    static function isAnyOf($value, array $classes): bool {}

        /**
 * @psalm-pure
 * @psalm-assert countable $value
 * @param mixed  $value
 */
    static function isCountable($value): bool {}

        /**
 * @psalm-pure
 * @psalm-param array<class-string> $classes
 * @param mixed                $value
 * @param array<object|string> $classes
 */
    static function isInstanceOfAny($value, array $classes): bool {}

        /**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \IteratorAggregate $value
 */
    static function iteratorAgg($value): bool {}

        /**
 * @psalm-pure
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
 * @param mixed  $value
 */
    static function positiveInteger($value): bool {}

        /**
 * Checks if a value is a valid array key (int or string).
 * @psalm-pure
 * @param mixed  $value
 */
    static function validArrayKey($value): bool {}

    }