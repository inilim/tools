<?php

namespace Inilim\Tool;

class Integer
{
        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 */
    static function checkBetween($num, $fromTo, $toFrom): bool {}

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 */
    static function checkLenBetween($num, $fromTo, $toFrom): bool {}

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 */
    static function checkLenMax($num, $max): bool {}

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 */
    static function checkLenMin($num, $min): bool {}

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 */
    static function checkMax($num, $max): bool {}

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 */
    static function checkMin($num, $min): bool {}

        /**
 * Clamp the given number between the given minimum and maximum.
 * @param int|float $number
 * @param int|float $min
 * @param int|float $max
 * @return int|float
 */
    static function clamp($number, $min, $max) {}

        /**
 * @param numeric-string|int $num1
 * @param numeric-string|int $num2
 */
    static function equals($num1, $num2): bool {}

        
    static function getCurLenMaxInt(): int {}

        
    static function getRandomIntByLength(int $length): int {}

        /**
 * -9223372036854775808 <> 9223372036854775807
 * @param mixed $value
 */
    static function isBigInt($value): bool {}

        /**
 * 0 <> 18446744073709551615
 * @param mixed $value
 */
    static function isBigIntUnsigned($value): bool {}

        /**
 * -2147483648 <> 2147483647
 * @param mixed $value
 */
    static function isInt($value): bool {}

        /**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $v
 */
    static function isIntPHP($v): bool {}

        /**
 * 0 <> 4_294_967_295
 * @param mixed $value
 */
    static function isIntUnsigned($value): bool {}

        /**
 * @param mixed $v
 */
    static function isMediumInt($v): bool {}

        
    static function isMediumIntUnsigned(mixed $value): bool {}

        /**
 * @param numeric-string|int $num
 */
    static function isNegative($num): bool {}

        /**
 * функция не проверяет длину значения, будет true даже с bigint и более.
 * @param mixed $v
 */
    static function isNumeric($v): bool {}

        /**
 * @param numeric-string|int $num
 */
    static function isPositive($num): bool {}

        /**
 * @param mixed $value
 */
    static function isSmallInt($value): bool {}

        /**
 * @param mixed $value
 */
    static function isSmallIntUnsigned($value): bool {}

        /**
 * @param mixed $value
 */
    static function isTinyInt($value): bool {}

        /**
 * @param mixed $value
 */
    static function isTinyIntUnsigned($value): bool {}

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $equal
 */
    static function lenEquals($num, $equal): bool {}

        /**
 * @param numeric-string|int $num
 */
    static function lenNumeric($num): int {}

    }