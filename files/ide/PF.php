<?php

namespace Inilim\Tool;

class PF
{
        /**
 * @author symfony/polyfill
 */
    static function array_all(array $array, callable $callback): bool {}

        /**
 * @author symfony/polyfill
 */
    static function array_any(array $array, callable $callback): bool {}

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
    static function array_filter(array $array, ?callable $callback = null, int $mode = 0): array {}

        /**
 * @author symfony/polyfill
 * 
 * @param callable(mixed, int|string):bool $callback
 * @return mixed
 */
    static function array_find(array $array, callable $callback) {}

        /**
 * @author symfony/polyfill
 * @return null|string|int
 */
    static function array_find_key(array $array, callable $callback) {}

        /**
 * @template T
 * @param array<T> $array
 * @return (
 *      $array is array{} ? null :
 *      $array is non-empty-array ? T :
 *      ?T
 * )
 */
    static function array_first(array $array) {}

        
    static function array_is_list(array $array): bool {}

        /**
 * @template T
 * @param array<T> $array
 * @return (
 *      $array is array{} ? null :
 *      $array is non-empty-array ? T :
 *      ?T
 * )
 */
    static function array_last(array $array) {}

        /**
 * @author symfony/polyfill
 */
    static function bcdivmod(string $num1, string $num2, ?int $scale = null): ?array {}

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
    static function clamp($value, $min, $max) {}

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is either a letter or a digit, FALSE otherwise.
 * @see https://php.net/ctype-alnum
 * @param mixed $text
 */
    static function ctype_alnum($text): bool {}

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a letter, FALSE otherwise.
 * @see https://php.net/ctype-alpha
 * @param mixed $text
 */
    static function ctype_alpha($text): bool {}

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a control character from the current locale, FALSE otherwise.
 * @see https://php.net/ctype-cntrl
 * @param mixed $text
 */
    static function ctype_cntrl($text): bool {}

        /**
 * @author symfony/polyfill
 * Returns TRUE if every character in the string text is a decimal digit, FALSE otherwise.
 * @see https://php.net/ctype-digit
 * @param mixed $text
 */
    static function ctype_digit($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_graph($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_lower($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_print($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_punct($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_space($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_upper($text): bool {}

        /**
 * @author symfony/polyfill
 * @param mixed $text
 */
    static function ctype_xdigit($text): bool {}

        
    static function fdiv(float $dividend, float $divisor): float {}

        /**
 * @author symfony/polyfill
 */
    static function fpow(float $num, float $exponent): float {}

        /**
 * @param mixed $value
 * @return string
 */
    static function get_debug_type($value) {}

        /**
 * @author symfony/polyfill
 */
    static function get_error_handler(): ?callable {}

        /**
 * @author symfony/polyfill
 */
    static function get_exception_handler(): ?callable {}

        /**
 * @param resource $res
 */
    static function get_resource_id($res): int {}

        /**
 * @author symfony/polyfill
 * 
 * @return array|false
 */
    static function grapheme_str_split(string $string, int $length) {}

        /**
 * @author Ion Bazan <ion.bazan@gmail.com>
 * @author Pierre Ambroise <pierre27.ambroise@gmail.com>
 */
    static function json_validate(string $json, int $depth = 512, int $flags = 0): bool {}

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_lcfirst(string $string, ?string $encoding = null): string {}

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_ltrim(string $string, ?string $characters = null, ?string $encoding = null): string {}

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_rtrim(string $string, ?string $characters = null, ?string $encoding = null): string {}

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_str_pad(string $string, int $length, string $pad_string = ' ', int $pad_type = \STR_PAD_RIGHT, ?string $encoding = null): string {}

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_trim(string $string, ?string $characters = null, ?string $encoding = null): string {}

        /**
 * @author symfony/polyfill
 * @ext mbstring
 */
    static function mb_ucfirst(string $string, ?string $encoding = null): string {}

        /**
 * @return string
 */
    static function preg_last_error_msg() {}

        
    static function str_contains(string $haystack, string $needle): bool {}

        /**
 * @author Ion Bazan <ion.bazan@gmail.com>
 * @author Pierre Ambroise <pierre27.ambroise@gmail.com>
 */
    static function str_decrement(string $string): string {}

        
    static function str_ends_with(string $haystack, string $needle): bool {}

        /**
 * @author Ion Bazan <ion.bazan@gmail.com>
 * @author Pierre Ambroise <pierre27.ambroise@gmail.com>
 */
    static function str_increment(string $string): string {}

        
    static function str_starts_with(string $haystack, string $needle): bool {}

    }