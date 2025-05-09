<?php

namespace Inilim\Tool;

class PF
{
        /**
 * @author symfony/polyfill
 * @param callable():bool $callback
 * @return mixed
 */
    static function array_find(array $array, callable $callback) {}

        /**
 * @template T of mixed
 * @param T[] $array
 * @return ?T
 */
    static function array_first(array $array) {}

        
    static function array_is_list(array $array): bool {}

        /**
 * @template T of mixed
 * @param T[] $array
 * @return ?T
 */
    static function array_last(array $array) {}

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
 * @param mixed $value
 * @return string
 */
    static function get_debug_type($value) {}

        /**
 * @param resource $res
 */
    static function get_resource_id($res): int {}

        /**
 * @return string
 */
    static function preg_last_error_msg() {}

        
    static function str_contains(string $haystack, string $needle): bool {}

        
    static function str_ends_with(string $haystack, string $needle): bool {}

        
    static function str_starts_with(string $haystack, string $needle): bool {}

    }