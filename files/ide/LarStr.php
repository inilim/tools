<?php

namespace Inilim\Tool;

class LarStr
{
        /**
 * Cap a string with a single instance of a given value.
 *
 * @param  string  $value
 * @param  string  $cap
 * @return string
 */
    static function finish($value, $cap) {}

        /**
 * Decode the given Base64 encoded string.
 *
 * @param  string  $string
 * @param  bool  $strict
 * @return ($strict is true ? ($string is '' ? '' : string|false) : ($string is '' ? '' : string))
 */
    static function fromBase64($string, $strict = false) {}

        /**
 * Convert the given string to proper case for each word.
 *
 * @param  string  $value
 * @return string
 */
    static function headline($value) {}

        /**
 * Get the "initials" representing each word in the provided string, optionally capitalizing.
 *
 * @param  string  $value
 * @param  bool  $capitalize
 * @return string
 * 
 * @ext mbstring
 */
    static function initials($value, $capitalize = false) {}

        /**
 * Convert the given string to lower-case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : non-empty-string&lowercase-string)
 * 
 * @ext mbstring
 */
    static function lower($value) {}

        /**
 * Remove all whitespace from the beginning of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function ltrim($value, $charlist = null) {}

        /**
 * Replace the given value in the given string.
 *
 * @param  string|iterable<string>  $search
 * @param  string|iterable<string>  $replace
 * @param  string|iterable<string>  $subject
 * @param  bool  $caseSensitive
 * @return ($subject is string ? string : string[])
 */
    static function replace($search, $replace, $subject, $caseSensitive = true) {}

        /**
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function rtrim($value, $charlist = null) {}

        /**
 * Convert a value to studly caps case.
 *
 * @param  string  $value
 * @param  bool  $normalize  When true, all-uppercase words (e.g. acronyms) are lowercased before conversion so "CBOR" becomes "Cbor" instead of "CBOR".
 * @return ($value is '' ? '' : string)
 */
    static function studly($value, bool $normalize = false) {}

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
    static function substr($string, $start, $length = null, $encoding = 'UTF-8') {}

        /**
 * Convert the given string to proper case.
 *
 * @param  string  $value
 * @return string
 * 
 * @ext mbstring
 */
    static function title($value) {}

        /**
 * Convert the given string to Base64 encoding.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : string)
 */
    static function toBase64($string): string {}

        /**
 * Remove all whitespace from both ends of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function trim($value, $charlist = null) {}

        /**
 * Make a string's first character uppercase.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : non-empty-string)
 */
    static function ucfirst($string) {}

        /**
 * Split a string into pieces by uppercase characters.
 *
 * @param  string  $string
 * @return ($string is '' ? array{} : string[])
 */
    static function ucsplit($string) {}

        /**
 * Capitalize the first character of each word in a string.
 *
 * @param  string  $string
 * @param  string  $separators
 * @return ($string is '' ? '' : non-empty-string)
 * 
 * @ext mbstring
 */
    static function ucwords($string, $separators = " \t\r\n\f\v") {}

        /**
 * Convert the given string to upper-case.
 *
 * @param  string  $value
 * @return ($value is '' ? '' : non-empty-string&uppercase-string)
 * 
 * @ext mbstring
 */
    static function upper($value) {}

    }