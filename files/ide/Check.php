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
 * @psalm-assert countable $value
 * @param mixed  $value
 */
    static function isCountable($value): bool {}

        /**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \IteratorAggregate $value
 */
    static function iteratorAgg($value): bool {}

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

    }