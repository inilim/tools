<?php

namespace Inilim\Tool;

class Str
{
        /**
 * @return bool
 */
    static function _contains(string $haystack, string $needle) {}

        /**
 * @return bool
 */
    static function _endsWith(string $haystack, string $needle) {}

        /**
 * Get the string matching the given pattern.
 */
    static function _match(string $pattern, string $subject): string {}

        /**
 * @return bool
 */
    static function _startsWith(string $haystack, string $needle) {}

        /**
 * Return the remainder of a string after the first occurrence of a given value.
 */
    static function after(string $subject, string $search): string {}

        /**
 * Return the remainder of a string after the last occurrence of a given value.
 */
    static function afterLast(string $subject, string $search): string {}

        /**
 * Convert the given string to APA-style title case.
 *
 * See: https://apastyle.apa.org/style-grammar-guidelines/capitalization/title-case
 * @return string
 */
    static function apa(string $value) {}

        /**
 * Get the portion of a string before the first occurrence of a given value.
 */
    static function before(string $subject, string $search): string {}

        /**
 * Get the portion of a string before the last occurrence of a given value.
 */
    static function beforeLast(string $subject, string $search): string {}

        /**
 * Get the portion of a string between two given values.
 */
    static function between(string $subject, string $from, string $to): string {}

        /**
 * Get the smallest possible portion of a string between two given values.
 */
    static function betweenFirst(string $subject, string $from, string $to): string {}

        /**
 * Convert a value to camel case.
 */
    static function camel(string $value): string {}

        /**
 * mb_strcasecmp
 * @return int
 */
    static function casecmp(string $str1, string $str2, string $encoding = 'UTF-8') {}

        /**
 * Get the character at the specified index.
 * @return string|false
 */
    static function charAt(string $subject, int $index) {}

        /**
 * Remove the given string(s) if it exists at the end of the haystack.
 * @param  string|array  $needle
 */
    static function chopEnd(string $subject, $needle): string {}

        /**
 * Remove the given string(s) if it exists at the start of the haystack.
 * @param  string|array  $needle
 */
    static function chopStart(string $subject, $needle): string {}

        /**
 * Determine if a given string contains a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
    static function contains(string $haystack, $needles, bool $ignoreCase = false) {}

        /**
 * Determine if a given string contains all array values.
 * @param  iterable<string>  $needles
 * @return bool
 */
    static function containsAll(string $haystack, iterable $needles, bool $ignoreCase = false) {}

        /**
 * Convert the case of a string.
 */
    static function convertCase(string $string, int $mode = \MB_CASE_FOLD, ?string $encoding = 'UTF-8'): string {}

        /**
 * Set the callable that will be used to generate random strings.
 * @return void
 */
    static function createRandomStringsUsing(?callable $factory = null) {}

        /**
 * Set the sequence that will be used to generate random strings.
 * @return void
 */
    static function createRandomStringsUsingSequence(array $sequence, ?callable $when_missing = null) {}

        /**
 * Replace consecutive instances of a given character with a single character in the given string.
 * @return string
 */
    static function deduplicate(string $string, string $character = ' ') {}

        /**
 * Determine if a given string doesn't contain a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
    static function doesntContain(string $haystack, $needles, bool $ignoreCase = false) {}

        /**
 * Determine if a given string ends with a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
    static function endsWith(string $haystack, $needles) {}

        /**
 * @return string
 */
    static function ent2ncr(string $text) {}

        /**
 * Cap a string with a single instance of a given value.
 */
    static function finish(string $value, string $cap): string {}

        /**
 * count segments url path
 * @return int
 */
    static function getCountSegmentsPath(string $path) {}

        /**
 * @return null|string
 */
    static function getEntByNcr(string $ncr) {}

        /**
 * @return null|string
 */
    static function getNcrByEnt(string $ent) {}

        /**
 * segment url path | 
 * "/sites/16/page/36/settings" | 0 - "sites" | 1 - "16" | 2 - "page" | 3 - "36" | 4 - "settings" | 5 - NULL
 */
    static function getSegmentPath(string $path, int $segment): ?string {}

        /**
 * segments url path
 * @return string[]
 */
    static function getSegmentsPath(string $path): array {}

        /**
 * Convert the given string to proper case for each word.
 */
    static function headline(string $value): string {}

        /**
 * @param string|iterable<string> $needles
 * @return bool
 */
    static function iEndsWith(string $haystack, $needles) {}

        /**
 * @param string|iterable<string> $needles
 * @return bool
 */
    static function iStartsWith(string $haystack, $needles) {}

        /**
 * Determine if a given string matches a given pattern.
 * @param  string|iterable<string>  $pattern
 * @return bool
 */
    static function is($pattern, string $value) {}

        /**
 * Determine if a given string matches a given pattern.
 * @param  string|iterable<string>  $patterns
 * @return bool
 */
    static function isMatch($patterns, string $value) {}

        /**
 * @return bool
 */
    static function isMobile(string $useragent) {}

        /**
 * Determine if a given value is a valid UUID.
 * @param mixed $value
 * @return bool
 */
    static function isUuid($value) {}

        /**
 * Convert a string to kebab case.
 */
    static function kebab(string $value): string {}

        /**
 * Make a string's first character lowercase.
 */
    static function lcfirst(string $string): string {}

        /**
 * @param int|numeric-string $fromTo
 * @param int|numeric-string $toFrom
 * @return bool
 */
    static function lenBetween(string $str, $fromTo, $toFrom) {}

        /**
 * @param int|numeric-string $equal
 * @return bool
 */
    static function lenEqual(string $str, $equal) {}

        /**
 * Return the length of the given string.
 * @param string|null $encoding
 * @return int
 */
    static function length(string $value, $encoding = 'UTF-8') {}

        /**
 * Limit the number of characters in a string.
 */
    static function limit(string $value, int $limit = 100, string $end = '...'): string {}

        /**
 * Convert the given string to lower-case.
 * @return string
 */
    static function lower(string $value, ?string $encoding = 'UTF-8') {}

        /**
 * Remove all whitespace from the beginning of a string.
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function ltrim($value, $charlist = null) {}

        /**
 * Masks a portion of a string with a repeated character.
 */
    static function mask(string $string, string $character, int $index, ?int $length = null, string $encoding = 'UTF-8'): string {}

        /**
 * @return string
 */
    static function ncr2ent(string $text) {}

        /**
 * \r\n, \n\r, \n и \r > \s
 */
    static function nl2space(string $str, string $replace = ' ', bool $squish = false): string {}

        /**
 * Remove all non-numeric characters from a string.
 */
    static function numbers(string $value): string {}

        /**
 * Pad both sides of a string with another.
 */
    static function padBoth(string $value, int $length, string $pad = ' '): string {}

        /**
 * Pad the left side of a string with another.
 */
    static function padLeft(string $value, int $length, string $pad = ' '): string {}

        /**
 * Pad the right side of a string with another.
 */
    static function padRight(string $value, int $length, string $pad = ' '): string {}

        /**
 * Parse a Class[@]method style callback into class and method.
 * @return array<int, string|null>
 */
    static function parseCallback(string $callback, ?string $default = null): array {}

        /**
 * new parse_url
 * @return array{count_element:int,raw:string,scheme:null|string,host:null|string,port:null|int,login:null|string,password:null|string,path:null|string,query:null|string,anchor:null|string}
 */
    static function parseUrl(string $url) {}

        /**
 * Generate a random, secure password.
 */
    static function password(int $length = 32, bool $letters = true, bool $numbers = true, bool $symbols = true, bool $spaces = false): string {}

        /**
 * Converts line endings to platform-specific, i.e. \r\n on Windows and \n elsewhere.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
    static function platformNewLines(string $s): string {}

        /**
 * Find the multi-byte safe position of the first occurrence of a given substring in a string.
 * @return int|false
 */
    static function position(string $haystack, string $needle, int $offset = 0, ?string $encoding = 'UTF-8') {}

        /**
 * Generate a more truly "random" alpha-numeric string.
 */
    static function random(int $length = 16): string {}

        /**
 * Remove any occurrence of the given string in the subject.
 * 
 * @template Subj of string|string[]
 * @param string|string[] $search
 * @param Subj $subject
 * @return Subj
 */
    static function remove($search, $subject, bool $caseSensitive = true) {}

        /**
 * @return string
 */
    static function removeWww(string $url) {}

        /**
 * Repeat the given string.
 */
    static function repeat(string $string, int $times): string {}

        /**
 * Replace the given value in the given string.
 * @param  string|string[]  $search
 * @param  string|string[]  $replace
 * @param  string|string[]  $subject
 * @return string|string[]
 */
    static function replace($search, $replace, $subject, bool $caseSensitive = true) {}

        /**
 * Replace a given value in the string sequentially with an array. |
 * 
 * $string = 'The event will take place between ? and ?'; |
 * $replaced = Str::replaceArray('?', ['8:30', '9:00'], $string); |
 *
 * @param  string[] $replace
 */
    static function replaceArray(string $search, array $replace, string $subject): string {}

        /**
 * Replace the last occurrence of a given value if it appears at the end of the string.
 */
    static function replaceEnd(string $search, string $replace, string $subject): string {}

        /**
 * Replace the first occurrence of a given value in the string.
 */
    static function replaceFirst(string $search, string $replace, string $subject): string {}

        /**
 * Replace the last occurrence of a given value in the string.
 */
    static function replaceLast(string $search, string $replace, string $subject): string {}

        /**
 * Replace the patterns matching the given regular expression.
 * @param \Closure|string $replace
 * @param string[]|string $subject
 * @return string|string[]|null
 */
    static function replaceMatches(string $pattern, $replace, $subject, int $limit = -1) {}

        /**
 * Replace the first occurrence of the given value if it appears at the start of the string.
 */
    static function replaceStart(string $search, string $replace, string $subject): string {}

        /**
 * Reverse the given string.
 */
    static function reverse(string $value): string {}

        /**
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function rtrim($value, $charlist = null) {}

        /**
 * Convert a string to snake case.
 */
    static function snake(string $value, string $delimiter = '_'): string {}

        /**
 * Remove all "extra" blank space from the given string.
 * @return string
 */
    static function squish(string $value) {}

        /**
 * Begin a string with a single instance of a given value.
 */
    static function start(string $value, string $prefix): string {}

        /**
 * Determine if a given string starts with a given substring.
 * @param  string|iterable<string>  $needles
 * @return bool
 */
    static function startsWith(string $haystack, $needles) {}

        /**
 * Convert a value to studly caps case.
 */
    static function studly(string $value): string {}

        /**
 * Returns the portion of the string specified by the start and length parameters.
 * @return string
 */
    static function substr(string $string, int $start, ?int $length = null, string $encoding = 'UTF-8') {}

        /**
 * Returns the number of substring occurrences.
 * @return int
 */
    static function substrCount(string $haystack, string $needle, int $offset = 0, ?int $length = null) {}

        /**
 * Replace text within a portion of a string.
 * @param  string|string[]  $string
 * @param  string|string[]  $replace
 * @param  int|int[]  $offset
 * @param  int|int[]|null  $length
 * @return string|string[]
 */
    static function substrReplace($string, $replace, $offset = 0, $length = null) {}

        /**
 * Swap multiple keywords in a string with other keywords.
 */
    static function swap(array $map, string $subject): string {}

        /**
 * Take the first or last {$limit} characters of a string.
 */
    static function take(string $string, int $limit): string {}

        /**
 * Convert the given string to proper case.
 */
    static function title(string $value): string {}

        /**
 * @return \Closure(string &$string, int $chunk):\Generator<array{iter:int,pos:int},string>
 */
    static function toCharsGenerator() {}

        /**
 * Convert the given value to a string or return the given fallback on failure.
 * @param  mixed  $value
 * @return string
 */
    static function toStringOr($value, string $fallback) {}

        /**
 * Translate a PHP_URL_# constant to the named array keys PHP uses. | analog wp func "_wp_translate_php_url_constant_to_key"
 * @since 4.7.0
 *
 * @link https://www.php.net/manual/en/url.constants.php
 *
 * @param \PHP_URL_* $constant \PHP_URL_* constant.
 * @return string|empty-string The named key or false.
 */
    static function translatePhpUrlConstantToKey(int $constant) {}

        /**
 * Remove all whitespace from both ends of a string.
 * @return string
 */
    static function trim(string $value, ?string $charlist = null) {}

        /**
 * Make a string's first character uppercase.
 */
    static function ucfirst(string $string): string {}

        /**
 * Split a string into pieces by uppercase characters.
 * @return string[]
 */
    static function ucsplit(string $string): array {}

        /**
 * Converts line endings to \n used on Unix-like systems.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
    static function unixNewLines(string $s, string $replacement = "\n"): string {}

        /**
 * Unwrap the string with the given strings.
 */
    static function unwrap(string $value, string $before, ?string $after = null): string {}

        /**
 * Convert the given string to upper-case.
 * @return string
 */
    static function upper(string $value, ?string $encoding = 'UTF-8') {}

        /**
 * Get the number of words a string contains.
 */
    static function wordCount(string $string, ?string $characters = null): int {}

        /**
 * Wrap a string to a given number of characters.
 */
    static function wordWrap(string $string, int $characters = 75, string $break = "\n", bool $cut_long_words = false): string {}

        /**
 * Limit the number of words in a string.
 */
    static function words(string $value, int $words = 100, string $end = '...'): string {}

        /**
 * Wrap the string with the given strings.
 */
    static function wrap(string $value, string $before, ?string $after = null): string {}

    }