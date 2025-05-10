<?php

namespace Inilim\Tool;

class Integer
{
        /**
 * Convert the number to its human-readable equivalent.
 *
 * @param  int|float  $number
 * @return bool|string
 */
    static function abbreviate($number, int $precision = 0, ?int $maxPrecision = null) {}

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
 * Convert the given number to its currency equivalent.
 * @param  int|float  $number
 * @return string|false
 */
    static function currency($number, string $in = '', ?string $locale = null, ?int $precision = null) {}

        /**
 * Get the default currency.
 */
    static function defaultCurrency(): string {}

        /**
 * Get the default locale.
 */
    static function defaultLocale(): string {}

        /**
 * @param numeric-string|int $num1
 * @param numeric-string|int $num2
 */
    static function equals($num1, $num2): bool {}

        /**
 * Convert the given number to its file size equivalent.
 * @param  int|float  $bytes
 * @return string
 */
    static function fileSize($bytes, int $precision = 0, ?int $maxPrecision = null, bool $useBinaryPrefix = false) {}

        /**
 * Convert the number to its human-readable equivalent.
 * @param  int|float  $number
 * @return false|string
 */
    static function forHumans($number, int $precision = 0, ?int $maxPrecision = null, bool $abbreviate = false) {}

        /**
 * Format the given number according to the current locale.
 *
 * @param  int|float  $number
 * @param  int|null  $precision
 * @param  int|null  $maxPrecision
 * @param  string|null  $locale
 * @return string|false
 */
    static function format($number, ?int $precision = null, ?int $maxPrecision = null, ?string $locale = null) {}

        
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

        /**
 * Convert the given number to ordinal form.
 *
 * @param  int|float  $number
 * @return string
 */
    static function ordinal($number, ?string $locale = null) {}

        /**
 * Split the given number into pairs of min/max values.
 * @param  int|float  $to
 * @param  int|float  $by
 * @param  int|float  $start
 * @param  int|float  $offset
 * @return array
 */
    static function pairs($to, $by, $start = 0, $offset = 1): array {}

        /**
 * Convert the given number to its percentage equivalent.
 *
 * @param  int|float  $number
 * @return string|false
 */
    static function percentage($number, int $precision = 0, ?int $maxPrecision = null, ?string $locale = null) {}

        /**
 * Spell out the given number in the given locale.
 *
 * @param  int|float  $number
 * @param  string|null  $locale
 * @param  int|null  $after
 * @param  int|null  $until
 * @return string
 */
    static function spell($number, ?string $locale = null, ?int $after = null, ?int $until = null) {}

        /**
 * Spell out the given number in the given locale in ordinal form.
 *
 * @param  int|float  $number
 * @return string
 */
    static function spellOrdinal($number, ?string $locale = null) {}

        /**
 * Remove any trailing zero digits after the decimal point of the given number.
 * @param  int|float  $number
 * @return int|float
 */
    static function trim($number) {}

        /**
 * Set the default currency.
 * @return void
 */
    static function useCurrency(string $currency) {}

        /**
 * Set the default locale.
 * @return void
 */
    static function useLocale(string $locale) {}

        /**
 * Execute the given callback using the given currency.
 * @return mixed
 */
    static function withCurrency(string $currency, callable $callback) {}

        /**
 * Execute the given callback using the given locale.
 * @return mixed
 */
    static function withLocale(string $locale, callable $callback) {}

    }