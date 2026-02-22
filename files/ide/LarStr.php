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
 * Remove all whitespace from the beginning of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function ltrim($value, $charlist = null) {}

        /**
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function rtrim($value, $charlist = null) {}

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
 * Capitalize the first character of each word in a string.
 *
 * @param  string  $string
 * @param  string  $separators
 * @return ($string is '' ? '' : non-empty-string)
 */
    static function ucwords($string, $separators = " \t\r\n\f\v") {}

    }