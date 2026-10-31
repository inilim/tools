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
    static function abbreviate($number, int $precision = 0, ?int $maxPrecision = null) {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 */
    static function checkBetween($num, $fromTo, $toFrom): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $fromTo
 * @param numeric-string|int $toFrom
 */
    static function checkLenBetween($num, $fromTo, $toFrom): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 */
    static function checkLenMax($num, $max): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 */
    static function checkLenMin($num, $min): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $max
 */
    static function checkMax($num, $max): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $min
 */
    static function checkMin($num, $min): bool {
        throw new \Exception;
    }

        /**
 * Clamp the given number between the given minimum and maximum.
 * @param int|float $number
 * @param int|float $min
 * @param int|float $max
 * @return int|float
 */
    static function clamp($number, $min, $max) {
        throw new \Exception;
    }

        /**
 * Convert the given number to its currency equivalent.
 * @param  int|float  $number
 * @return string|false
 */
    static function currency($number, string $in = '', ?string $locale = null, ?int $precision = null) {
        throw new \Exception;
    }

        /**
 * Get the default currency.
 */
    static function defaultCurrency(): string {
        throw new \Exception;
    }

        /**
 * Get the default locale.
 */
    static function defaultLocale(): string {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num1
 * @param numeric-string|int $num2
 */
    static function equals($num1, $num2): bool {
        throw new \Exception;
    }

        /**
 * Convert the given number to its file size equivalent.
 * @param  int|float  $bytes
 * @return string
 */
    static function fileSize($bytes, int $precision = 0, ?int $maxPrecision = null, bool $useBinaryPrefix = false) {
        throw new \Exception;
    }

        /**
 * Convert the number to its human-readable equivalent.
 * @param  int|float  $number
 * @return false|string
 */
    static function forHumans($number, int $precision = 0, ?int $maxPrecision = null, bool $abbreviate = false) {
        throw new \Exception;
    }

        /**
 * Format the given number according to the current locale.
 *
 * @param  int|float  $number
 * @param  int|null  $precision
 * @param  int|null  $maxPrecision
 * @param  string|null  $locale
 * @return string|false
 * 
 * @ext intl
 */
    static function format($number, ?int $precision = null, ?int $maxPrecision = null, ?string $locale = null) {
        throw new \Exception;
    }

        
    static function getCurLenMaxInt(): int {
        throw new \Exception;
    }

        
    static function getRandomIntByLength(int $length): int {
        throw new \Exception;
    }

        /**
 * -9223372036854775808 <> 9223372036854775807
 * @param mixed $value
 */
    static function isBigInt($value): bool {
        throw new \Exception;
    }

        /**
 * 0 <> 18446744073709551615
 * @param mixed $value
 */
    static function isBigIntUnsigned($value): bool {
        throw new \Exception;
    }

        /**
 * -2147483648 <> 2147483647
 * @param mixed $value
 */
    static function isInt($value): bool {
        throw new \Exception;
    }

        /**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $value
 */
    static function isIntPhp($value): bool {
        throw new \Exception;
    }

        /**
 * проверка int для php, 32bit или 64bit
 * может ли значение стать integer без изменений
 * @param mixed $value
 */
    static function isIntPhp_m2($value): bool {
        throw new \Exception;
    }

        /**
 * 0 <> 4_294_967_295
 * @param mixed $value
 */
    static function isIntUnsigned($value): bool {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 */
    static function isMediumInt($value): bool {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 */
    static function isMediumIntUnsigned($value): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 */
    static function isNegative($num): bool {
        throw new \Exception;
    }

        /**
 * NOT like \is_numeric()
 * функция не проверяет длину значения, будет true даже с bigint и более.
 * @psalm-assert-if-true string|int $v
 * @phpstan-assert-if-true string|int $v
 * @param mixed $v
 */
    static function isNumeric($v): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 */
    static function isPositive($num): bool {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 */
    static function isSmallInt($value): bool {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 */
    static function isSmallIntUnsigned($value): bool {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 */
    static function isTinyInt($value): bool {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 */
    static function isTinyIntUnsigned($value): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 * @param numeric-string|int $equal
 */
    static function lenEquals($num, $equal): bool {
        throw new \Exception;
    }

        /**
 * @param numeric-string|int $num
 */
    static function lenNumeric($num): int {
        throw new \Exception;
    }

        /**
 * Convert the given number to ordinal form.
 *
 * @param  int|float  $number
 * @return string
 */
    static function ordinal($number, ?string $locale = null) {
        throw new \Exception;
    }

        /**
 * Split the given number into pairs of min/max values.
 * @param  int|float  $to
 * @param  int|float  $by
 * @param  int|float  $start
 * @param  int|float  $offset
 * @return array
 */
    static function pairs($to, $by, $start = 0, $offset = 1): array {
        throw new \Exception;
    }

        /**
 * Convert the given number to its percentage equivalent.
 *
 * @param  int|float  $number
 * @return string|false
 */
    static function percentage($number, int $precision = 0, ?int $maxPrecision = null, ?string $locale = null) {
        throw new \Exception;
    }

        /**
 * Spell out the given number in the given locale.
 *
 * @param  int|float  $number
 * @param  string|null  $locale
 * @param  int|null  $after
 * @param  int|null  $until
 * @return string
 */
    static function spell($number, ?string $locale = null, ?int $after = null, ?int $until = null) {
        throw new \Exception;
    }

        /**
 * Spell out the given number in the given locale in ordinal form.
 *
 * @param  int|float  $number
 * @return string
 */
    static function spellOrdinal($number, ?string $locale = null) {
        throw new \Exception;
    }

        /**
 * like str_decrement only with support for negative numbers
 * @author inilim
 * @throws \InvalidArgumentException
 */
    static function strDecrement(string $value): string {
        throw new \Exception;
    }

        /**
 * Remove any trailing zero digits after the decimal point of the given number.
 * @param  int|float  $number
 * @return int|float
 */
    static function trim($number) {
        throw new \Exception;
    }

        /**
 * Set the default currency.
 * @return void
 */
    static function useCurrency(string $currency) {
        throw new \Exception;
    }

        /**
 * Set the default locale.
 * @return void
 */
    static function useLocale(string $locale) {
        throw new \Exception;
    }

        /**
 * Execute the given callback using the given currency.
 * @return mixed
 */
    static function withCurrency(string $currency, callable $callback) {
        throw new \Exception;
    }

        /**
 * Execute the given callback using the given locale.
 * @return mixed
 */
    static function withLocale(string $locale, callable $callback) {
        throw new \Exception;
    }

    }