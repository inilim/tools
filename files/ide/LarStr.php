<?php

namespace Inilim\Tool;

class LarStr
{
        /**
 * Convert a value to camel case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : string)
 */
    static function camel($value) {
        throw new \Exception;
    }

        /**
 * Determine if a given string contains a given substring.
 *
 * @param  string  $haystack
 * @param  string|iterable<string>  $needles
 * @param  bool  $ignoreCase
 * @return ($needles is array{} ? false : ($haystack is non-empty-string ? bool : false))
 * 
 * @ext mbstring
 */
    static function contains($haystack, $needles, $ignoreCase = false) {
        throw new \Exception;
    }

        /**
 * Determine if a given string contains all array values.
 *
 * @param  string  $haystack
 * @param  iterable<string>  $needles
 * @param  bool  $ignoreCase
 * @return ($needles is array{} ? false : ($haystack is non-empty-string ? bool : false))
 */
    static function containsAll($haystack, $needles, $ignoreCase = false) {
        throw new \Exception;
    }

        /**
 * Cap a string with a single instance of a given value.
 *
 * @param  string  $value
 * @param  string  $cap
 * @return ($value is '' ? ($cap is '' ? '' : non-empty-string) : non-empty-string)
 */
    static function finish($value, $cap) {
        throw new \Exception;
    }

        /**
 * Decode the given Base64 encoded string.
 *
 * @param  string  $string
 * @param  bool  $strict
 * @return ($strict is true ? ($string is '' ? '' : string|false) : ($string is '' ? '' : string))
 */
    static function fromBase64($string, $strict = false) {
        throw new \Exception;
    }

        /**
 * Convert the given string to proper case for each word.
 *
 * @param  string  $value
 * @return string
 */
    static function headline($value) {
        throw new \Exception;
    }

        /**
 * Get the "initials" representing each word in the provided string, optionally capitalizing.
 *
 * @param  string  $value
 * @param  bool  $capitalize
 * @return string
 * 
 * @ext mbstring
 */
    static function initials($value, $capitalize = false) {
        throw new \Exception;
    }

        /**
 * Determine if a given string is 7 bit ASCII.
 *
 * @param  string  $value
 * @return bool
 */
    static function isAscii($value) {
        throw new \Exception;
    }

        /**
 * Make a string's first character lowercase.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : non-empty-string)
 * 
 * @ext mbstring
 */
    static function lcfirst($string) {
        throw new \Exception;
    }

        /**
 * Return the length of the given string.
 *
 * @param  string  $value
 * @param  string|null  $encoding
 * @return non-negative-int
 * 
 * @ext mbstring
 */
    static function length($value, $encoding = null) {
        throw new \Exception;
    }

        /**
 * Convert the given string to lower-case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : non-empty-string&lowercase-string)
 * 
 * @ext mbstring
 */
    static function lower($value) {
        throw new \Exception;
    }

        /**
 * Remove all whitespace from the beginning of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function ltrim($value, $charlist = null) {
        throw new \Exception;
    }

        /**
 * Masks a portion of a string with a repeated character.
 *
 * @param  string  $string
 * @param  string  $character
 * @param  int  $index
 * @param  int|null  $length
 * @param  string  $encoding
 * @return string
 * 
 * @ext mbstring
 */
    static function mask($string, $character, $index, $length = null, $encoding = 'UTF-8') {
        throw new \Exception;
    }

        /**
 * Remove all non-numeric characters from a string.
 *
 * @param  string|string[]  $value
 * @return ($value is string ? string : string[])
 */
    static function numbers($value) {
        throw new \Exception;
    }

        /**
 * Replace the given value in the given string.
 *
 * @param  string|iterable<string>  $search
 * @param  string|iterable<string>  $replace
 * @param  string|iterable<string>  $subject
 * @param  bool  $caseSensitive
 * @return ($subject is string ? string : string[])
 */
    static function replace($search, $replace, $subject, $caseSensitive = true) {
        throw new \Exception;
    }

        /**
 * Replace a given value in the string sequentially with an array.
 *
 * @param  string  $search
 * @param  iterable<string>  $replace
 * @param  string  $subject
 * @return string
 */
    static function replaceArray($search, $replace, $subject) {
        throw new \Exception;
    }

        /**
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function rtrim($value, $charlist = null) {
        throw new \Exception;
    }

        /**
 * Begin a string with a single instance of a given value.
 *
 * @param  string  $value
 * @param  string  $prefix
 * @return ($value is '' ? ($prefix is '' ? '' : non-empty-string): non-empty-string)
 */
    static function start($value, $prefix) {
        throw new \Exception;
    }

        /**
 * Convert a value to studly caps case.
 *
 * @param  string  $value
 * @param  bool  $normalize  When true, all-uppercase words (e.g. acronyms) are lowercased before conversion so "CBOR" becomes "Cbor" instead of "CBOR".
 * @return ($value is '' ? '' : string)
 */
    static function studly($value, bool $normalize = false) {
        throw new \Exception;
    }

        /**
 * Returns the portion of the string specified by the start and length parameters.
 *
 * @param  string  $string
 * @param  int  $start
 * @param  int|null  $length
 * @param  string  $encoding
 * @return string
 * 
 * @ext mbstring
 */
    static function substr($string, $start, $length = null, $encoding = 'UTF-8') {
        throw new \Exception;
    }

        /**
 * Replace text within a portion of a string.
 *
 * @param  string|string[]  $string
 * @param  string|string[]  $replace
 * @param  int|int[]  $offset
 * @param  int|int[]|null  $length
 * @return string|string[]
 * 
 * @ext mbstring
 */
    static function substrReplace($string, $replace, $offset = 0, $length = null) {
        throw new \Exception;
    }

        /**
 * Convert the given string to proper case.
 *
 * @param  string  $value
 * @return string
 * 
 * @ext mbstring
 */
    static function title($value) {
        throw new \Exception;
    }

        /**
 * Convert the given string to Base64 encoding.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : string)
 */
    static function toBase64($string): string {
        throw new \Exception;
    }

        /**
 * Convert the given value to a string or return the given fallback on failure.
 *
 * @param  mixed  $value
 * @param  string  $fallback
 * @return string
 */
    static function toStringOr($value, $fallback) {
        throw new \Exception;
    }

        /**
 * Remove all whitespace from both ends of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function trim($value, $charlist = null) {
        throw new \Exception;
    }

        /**
 * Make a string's first character uppercase.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : non-empty-string)
 * 
 * @ext mbstring
 */
    static function ucfirst($string) {
        throw new \Exception;
    }

        /**
 * Split a string into pieces by uppercase characters.
 *
 * @param  string  $string
 * @return ($string is '' ? array{} : string[])
 */
    static function ucsplit($string) {
        throw new \Exception;
    }

        /**
 * Capitalize the first character of each word in a string.
 *
 * @param  string  $string
 * @param  string  $separators
 * @return ($string is '' ? '' : non-empty-string)
 * 
 * @ext mbstring
 */
    static function ucwords($string, $separators = " \t\r\n\f\v") {
        throw new \Exception;
    }

        /**
 * Convert the given string to upper-case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : non-empty-string&uppercase-string)
 * 
 * @ext mbstring
 */
    static function upper($value) {
        throw new \Exception;
    }

        /**
 * Wrap a string to a given number of characters.
 *
 * @param  string  $string
 * @param  int  $characters
 * @param  string  $break
 * @param  bool  $cutLongWords
 * @return string
 */
    static function wordWrap($string, $characters = 75, $break = "\n", $cutLongWords = false) {
        throw new \Exception;
    }

    }