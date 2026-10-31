<?php

namespace Inilim\Tool;

class PF
{
        /**
 * @author symfony/polyfill
 * 
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param (callable(TValue $value, TKey $key): bool)|(callable(TValue $value): bool) $callback
 */
    static function array_all(array $array, callable $callback): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * 
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param (callable(TValue $value, TKey $key): bool)|(callable(TValue $value): bool) $callback
 */
    static function array_any(array $array, callable $callback): bool {
        throw new \Exception;
    }

        /**
 * Iterates over each value in the <b>array</b>
 * passing them to the <b>callback</b> function.
 * If the <b>callback</b> function returns true, the
 * current value from <b>array</b> is returned into
 * the result array. Array keys are preserved.
 * @link https://php.net/manual/en/function.array-filter.php
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array <p>
 * The array to iterate over
 * </p>
 * @param ($mode is 1 ? (callable(TValue $value, TKey $key): bool) : ($mode is 2 ? (callable(TKey $key): bool) : (callable(TValue $value): bool)))|null $callback [optional] <p>
 * The callback function to use
 * </p>
 * <p>
 * If no callback is supplied, all entries of
 * input equal to false (see
 * converting to
 * boolean) will be removed.
 * </p>
 * @param int $mode [optional] <p>
 * Flag determining what arguments are sent to <i>callback</i>:
 * </p><ul>
 * <li>
 * <b>ARRAY_FILTER_USE_KEY</b> - pass key as the only argument
 * to <i>callback</i> instead of the value</span>
 * </li>
 * <li>
 * <b>ARRAY_FILTER_USE_BOTH</b> - pass both value and key as
 * arguments to <i>callback</i> instead of the value</span>
 * </li>
 * </ul>
 * @return array<TKey, TValue> the filtered array.
 */
    static function array_filter(array $array, ?callable $callback = null, int $mode = 0): array {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * 
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param (callable(TValue $value, TKey $key): bool)|(callable(TValue $value): bool) $callback
 * @return TValue|null
 */
    static function array_find(array $array, callable $callback) {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * 
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param (callable(TValue $value, TKey $key): bool)|(callable(TValue $value): bool) $callback
 * @return TKey|null
 */
    static function array_find_key(array $array, callable $callback) {
        throw new \Exception;
    }

        /**
 * @template T
 * @param array<T> $array
 * @return (
 *      $array is array{} ? null :
 *      ($array is non-empty-array ? T :
 *      ?T)
 * )
 */
    static function array_first(array $array) {
        throw new \Exception;
    }

        
    static function array_is_list(array $array): bool {
        throw new \Exception;
    }

        /**
 * @template T
 * @param array<T> $array
 * @return (
 *      $array is array{} ? null :
 *      ($array is non-empty-array ? T :
 *      ?T)
 * )
 */
    static function array_last(array $array) {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 */
    static function bcdivmod(string $num1, string $num2, ?int $scale = null): ?array {
        throw new \Exception;
    }

        /**
 * @author kylekatarnls <kylekatarnls@gmail.com>
 * 
 * @template Value
 * @template Minimum
 * @template Maximum
 *
 * @param Value   $value
 * @param Minimum $min
 * @param Maximum $max
 *
 * @return Value|Minimum|Maximum
 */
    static function clamp($value, $min, $max) {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is either a letter or a digit, FALSE otherwise.
 * @see https://php.net/ctype-alnum
 * @param mixed $text
 */
    static function ctype_alnum($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a letter, FALSE otherwise.
 * @see https://php.net/ctype-alpha
 * @param mixed $text
 */
    static function ctype_alpha($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a control character from the current locale, FALSE otherwise.
 * @see https://php.net/ctype-cntrl
 * @param mixed $text
 */
    static function ctype_cntrl($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in the string text is a decimal digit, FALSE otherwise.
 * @see https://php.net/ctype-digit
 * @param mixed $text
 */
    static function ctype_digit($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_graph($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_lower($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_print($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_punct($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_space($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_upper($text): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_xdigit($text): bool {
        throw new \Exception;
    }

        
    static function fdiv(float $dividend, float $divisor): float {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 */
    static function fpow(float $num, float $exponent): float {
        throw new \Exception;
    }

        /**
 * @param mixed $value
 * @return string
 */
    static function get_debug_type($value) {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 */
    static function get_error_handler(): ?callable {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 */
    static function get_exception_handler(): ?callable {
        throw new \Exception;
    }

        /**
 * @param resource $res
 */
    static function get_resource_id($res): int {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * 
 * @return array|false
 */
    static function grapheme_str_split(string $string, int $length) {
        throw new \Exception;
    }

        /**
 * @author Ion Bazan <ion.bazan@gmail.com>
 * @author Pierre Ambroise <pierre27.ambroise@gmail.com>
 */
    static function json_validate(string $json, int $depth = 512, int $flags = 0): bool {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_lcfirst(string $string, ?string $encoding = null): string {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_ltrim(string $string, ?string $characters = null, ?string $encoding = null): string {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_rtrim(string $string, ?string $characters = null, ?string $encoding = null): string {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_str_pad(string $string, int $length, string $pad_string = ' ', int $pad_type = \STR_PAD_RIGHT, ?string $encoding = null): string {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_trim(string $string, ?string $characters = null, ?string $encoding = null): string {
        throw new \Exception;
    }

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_ucfirst(string $string, ?string $encoding = null): string {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function preg_last_error_msg() {
        throw new \Exception;
    }

        
    static function str_contains(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * @author Ion Bazan <ion.bazan@gmail.com>
 * @author Pierre Ambroise <pierre27.ambroise@gmail.com>
 */
    static function str_decrement(string $string): string {
        throw new \Exception;
    }

        
    static function str_ends_with(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * @author Ion Bazan <ion.bazan@gmail.com>
 * @author Pierre Ambroise <pierre27.ambroise@gmail.com>
 */
    static function str_increment(string $string): string {
        throw new \Exception;
    }

        
    static function str_starts_with(string $haystack, string $needle): bool {
        throw new \Exception;
    }

    }