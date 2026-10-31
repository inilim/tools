<?php

namespace Inilim\Tool;

class Str
{
        /**
 * @deprecated use PF::str_contains
 */
    static function _contains(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        
    static function _endsWith(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * Get the string matching the given pattern.
 * @return string
 */
    static function _match(string $pattern, string $subject) {
        throw new \Exception;
    }

        
    static function _startsWith(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * Return the remainder of a string after the first occurrence of a given value.
 */
    static function after(string $subject, string $search): string {
        throw new \Exception;
    }

        /**
 * Return the remainder of a string after the last occurrence of a given value.
 */
    static function afterLast(string $subject, string $search): string {
        throw new \Exception;
    }

        /**
 * Convert the given string to APA-style title case.
 *
 * See: https://apastyle.apa.org/style-grammar-guidelines/capitalization/title-case
 * @ext mbstring
 * @return string
 */
    static function apa(string $value) {
        throw new \Exception;
    }

        /**
 * Get the portion of a string before the first occurrence of a given value.
 */
    static function before(string $subject, string $search): string {
        throw new \Exception;
    }

        /**
 * Get the portion of a string before the last occurrence of a given value.
 * @ext mbstring
 */
    static function beforeLast(string $subject, string $search): string {
        throw new \Exception;
    }

        /**
 * Get the portion of a string between two given values.
 */
    static function between(string $subject, string $from, string $to): string {
        throw new \Exception;
    }

        /**
 * Get the smallest possible portion of a string between two given values.
 */
    static function betweenFirst(string $subject, string $from, string $to): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Convert a value to camel case.
 * @return string
 */
    static function camel(string $value) {
        throw new \Exception;
    }

        /**
 * mb_strcasecmp
 * @ext mbstring
 */
    static function casecmp(string $str1, string $str2, string $encoding = 'UTF-8'): int {
        throw new \Exception;
    }

        /**
 * Get the character at the specified index.
 * @ext mbstring
 * @return string|false
 */
    static function charAt(string $subject, int $index) {
        throw new \Exception;
    }

        /**
 * Remove the given string(s) if it exists at the end of the haystack.
 * @param  string|array  $needle
 */
    static function chopEnd(string $subject, $needle): string {
        throw new \Exception;
    }

        /**
 * Remove the given string(s) if it exists at the start of the haystack.
 * @param  string|array  $needle
 */
    static function chopStart(string $subject, $needle): string {
        throw new \Exception;
    }

        /**
 * Determine if a given string contains a given substring.
 * @param string|iterable<string> $needles
 */
    static function contains(string $haystack, $needles, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * Determine if a given string contains all array values.
 * @param  iterable<string>  $needles
 */
    static function containsAll(string $haystack, iterable $needles, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * Convert the case of a string.
 * @ext mbstring
 * @return string
 */
    static function convertCase(string $string, int $mode = \Inilim\Tool\PF::MB_CASE_FOLD, ?string $encoding = 'UTF-8') {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Indicate that random strings should be created normally and not using a custom factory.
 * @return void
 */
    static function createRandomStringsNormally() {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Set the callable that will be used to generate random strings.
 * @return void
 */
    static function createRandomStringsUsing(?callable $factory = null) {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Set the sequence that will be used to generate random strings.
 * @return void
 */
    static function createRandomStringsUsingSequence(array $sequence, ?callable $whenMissing = null) {
        throw new \Exception;
    }

        /**
 * Replace consecutive instances of a given character with a single character in the given string.
 * @return string
 */
    static function deduplicate(string $string, string $character = ' ') {
        throw new \Exception;
    }

        /**
 * Determine if a given string doesn't contain a given substring.
 * @param string|iterable<string> $needles
 */
    static function doesntContain(string $haystack, $needles, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Determine if a given string doesn't end with a given substring.
 * @param  string|iterable<string>  $needles
 */
    static function doesntEndWith(string $haystack, $needles): bool {
        throw new \Exception;
    }

        /**
 * @author laravel
 * 
 * Determine if a given string doesn't start with a given substring.
 * 
 * @param  string|iterable<string>  $needles
 * @return ($needles is array{} ? true : ($haystack is non-empty-string ? bool : true))
 * @phpstan-assert-if-false =non-empty-string $haystack
 */
    static function doesntStartWith(string $haystack, $needles): bool {
        throw new \Exception;
    }

        /**
 * Determine if a given string ends with a given substring.
 * @param string|iterable<string> $needles
 */
    static function endsWith(string $haystack, $needles, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function ent2ncr(string $text) {
        throw new \Exception;
    }

        /**
 * Extracts an excerpt from text that matches the first instance of a phrase.
 * 
 * @ext mbstring
 * @param array{radius?:int,omission?:string} $options
 * @return string|null
 */
    static function excerpt(string $text, string $phrase = '', array $options = []) {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Cap a string with a single instance of a given value.
 */
    static function finish(string $value, string $cap): string {
        throw new \Exception;
    }

        /**
 * @author deepseek
 * Преобразовать полноширинные цифры в обычные
 * @todo tests
 */
    static function fullwidthToHalfwidth(string $str): string {
        throw new \Exception;
    }

        /**
 * count segments url path
 */
    static function getCountSegmentsPath(string $path): int {
        throw new \Exception;
    }

        /**
 * @return null|string
 */
    static function getEntByNcr(string $ncr) {
        throw new \Exception;
    }

        /**
 * @return null|string
 */
    static function getNcrByEnt(string $ent) {
        throw new \Exception;
    }

        /**
 * segment url path | 
 * "/sites/16/page/36/settings" | 0 - "sites" | 1 - "16" | 2 - "page" | 3 - "36" | 4 - "settings" | 5 - NULL
 */
    static function getSegmentPath(string $path, int $segment): ?string {
        throw new \Exception;
    }

        /**
 * segments url path
 * @return string[]
 */
    static function getSegmentsPath(string $path): array {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr::...
 * Convert the given string to proper case for each word.
 * @return string
 */
    static function headline(string $value) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @ext mbstring
 */
    static function iContainsOnce(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @ext mbstring
 */
    static function iEndsWithOnce(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @ext mbstring
 */
    static function iStartsWithOnce(string $haystack, string $needle): bool {
        throw new \Exception;
    }

        /**
 * @ext mbstring
 * @param (int|string)[] $parts
 */
    static function insertBetweenSubstrAfterMerge(string $string, array $parts, string $separator = '/', string $encoding = 'UTF-8'): string {
        throw new \Exception;
    }

        /**
 * Determine if a given string matches a given pattern.
 * @ext mbstring
 * @param  string|iterable<string>  $pattern
 */
    static function is($pattern, string $value, $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * Determine if a given string matches a given pattern.
 * @param  string|iterable<string> $pattern
 */
    static function isMatch($pattern, string $value): bool {
        throw new \Exception;
    }

        
    static function isMobile(string $useragent): bool {
        throw new \Exception;
    }

        /**
 * @author laravel
 * @author symfony
 * Determine if a given value is a valid URL.
 * @param  string[] $protocols
 */
    static function isUrl(string $value, array $protocols = []): bool {
        throw new \Exception;
    }

        /**
 * @author https://github.com/voku/portable-ascii
 * 
 * Checks if a string is 7-bit ASCII.
 *
 * EXAMPLE: <code>
 * Str::is_ascii('白'); // false
 * </code>
 *
 * @param string $str <p>The string to check.</p>
 *
 * @psalm-pure
 *
 * @return bool
 *              <p>
 *              <strong>true</strong> if it is ASCII<br>
 *              <strong>false</strong> otherwise
 *              </p>
 */
    static function is_ascii(string $str): bool {
        throw new \Exception;
    }

        /**
 * @param iterable<array-key,string> $iterable
 */
    static function join(iterable $iterable, string $separator = ','): string {
        throw new \Exception;
    }

        /**
 * @param iterable<string,mixed> $iterable
 */
    static function joinKeys(array $iterable, string $separator = ','): string {
        throw new \Exception;
    }

        /**
 * Convert a string to kebab case.
 */
    static function kebab(string $value): string {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr
 * 
 * Make a string's first character lowercase.
 * 
 * @return ($string is '' ? '' : non-empty-string)
 */
    static function lcfirst(string $string): string {
        throw new \Exception;
    }

        /**
 * @param int|numeric-string $fromTo
 * @param int|numeric-string $toFrom
 */
    static function lenBetween(string $str, $fromTo, $toFrom): bool {
        throw new \Exception;
    }

        /**
 * @param int|numeric-string $equal
 */
    static function lenEqual(string $str, $equal): bool {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr
 * Return the length of the given string.
 * @param string|null $encoding
 * @ext mbstring
 */
    static function length(string $value, $encoding = 'UTF-8'): int {
        throw new \Exception;
    }

        /**
 * @author inilim
 * Return the length of the given string.
 * Without mbstring
 */
    static function length_m2(string $value): int {
        throw new \Exception;
    }

        /**
 * Limit the number of characters in a string.
 * @ext mbstring
 */
    static function limit(string $value, int $limit = 100, string $end = '...', bool $preserveWords = false): string {
        throw new \Exception;
    }

        /**
 * @return \Generator<int,string>
 * @throws \InvalidArgumentException
 */
    static function lines(string $content, int $startLine = 0): Generator {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr::...
 * Convert the given string to lower-case.
 * @ext mbstring
 */
    static function lower(string $value, ?string $encoding = 'UTF-8'): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Remove all whitespace from the beginning of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function ltrim(string $value, ?string $charlist = null): string {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr
 * 
 * Masks a portion of a string with a repeated character.
 * @ext mbstring
 */
    static function mask(string $string, string $character, int $index, ?int $length = null, string $encoding = 'UTF-8'): string {
        throw new \Exception;
    }

        /**
 * @author laravel
 * 
 * Get the string matching the given pattern.
 *
 * @return string[]
 */
    static function matchAll(string $pattern, string $subject): array {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function ncr2ent(string $text) {
        throw new \Exception;
    }

        /**
 * \r\n, \n\r, \n и \r > \s
 */
    static function nl2space(string $str, string $replace = ' ', bool $squish = false): string {
        throw new \Exception;
    }

        /**
 * Remove all non-numeric characters from a string.
 * @param string[]|string $value
 * @return ($value is string ? string : string[])
 */
    static function numbers($value) {
        throw new \Exception;
    }

        /**
 * Pad both sides of a string with another.
 * @ext mbstring
 */
    static function padBoth(string $value, int $length, string $pad = ' '): string {
        throw new \Exception;
    }

        /**
 * Pad the left side of a string with another.
 * @ext mbstring
 */
    static function padLeft(string $value, int $length, string $pad = ' '): string {
        throw new \Exception;
    }

        /**
 * Pad the right side of a string with another.
 * @ext mbstring
 */
    static function padRight(string $value, int $length, string $pad = ' '): string {
        throw new \Exception;
    }

        /**
 * Parse a Class[@]method style callback into class and method.
 * @return array<int, string|null>
 */
    static function parseCallback(string $callback, ?string $default = null): array {
        throw new \Exception;
    }

        /**
 * new parse_url
 * @return array{count_element:int,raw:string,scheme:null|string,host:null|string,port:null|int,login:null|string,password:null|string,path:null|string,query:null|string,anchor:null|string}
 */
    static function parseUrl(string $url) {
        throw new \Exception;
    }

        /**
 * Generate a random, secure password.
 */
    static function password(int $length = 32, bool $letters = true, bool $numbers = true, bool $symbols = true, bool $spaces = false): string {
        throw new \Exception;
    }

        /**
 * Converts line endings to platform-specific, i.e. \r\n on Windows and \n elsewhere.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
    static function platformNewLines(string $s): string {
        throw new \Exception;
    }

        /**
 * Find the multi-byte safe position of the first occurrence of a given substring in a string.
 * @ext mbstring
 * @return int|false
 */
    static function position(string $haystack, string $needle, int $offset = 0, ?string $encoding = 'UTF-8') {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Generate a more truly "random" alpha-numeric string.
 */
    static function random(int $length = 16): string {
        throw new \Exception;
    }

        /**
 * Remove any occurrence of the given string in the subject.
 * @param string|iterable<string> $search
 * @param string|iterable<string> $subject
 * @return ($subject is string ? string : string[])
 */
    static function remove($search, $subject, bool $caseSensitive = true) {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function removeWww(string $url) {
        throw new \Exception;
    }

        /**
 * Repeat the given string.
 * @param int<0,max> $times
 */
    static function repeat(string $string, int $times): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Replace the given value in the given string.
 * @param string|iterable<string> $search
 * @param string|iterable<string> $replace
 * @param string|iterable<string> $subject
 * @return ($subject is string ? string : string[])
 */
    static function replace($search, $replace, $subject, bool $caseSensitive = true) {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Replace a given value in the string sequentially with an array. |
 * 
 * $string = 'The event will take place between ? and ?'; |
 * $replaced = Str::replaceArray('?', ['8:30', '9:00'], $string); |
 *
 * @param iterable<string> $replace
 * @return string
 */
    static function replaceArray(string $search, $replace, string $subject) {
        throw new \Exception;
    }

        /**
 * Replace the last occurrence of a given value if it appears at the end of the string.
 * @return string
 */
    static function replaceEnd(string $search, string $replace, string $subject) {
        throw new \Exception;
    }

        /**
 * Replace the first occurrence of a given value in the string.
 * @return string
 */
    static function replaceFirst(string $search, string $replace, string $subject) {
        throw new \Exception;
    }

        /**
 * Replace the last occurrence of a given value in the string.
 * @return string
 */
    static function replaceLast(string $search, string $replace, string $subject) {
        throw new \Exception;
    }

        /**
 * Replace the patterns matching the given regular expression.
 *
 * @param  string|string[]  $pattern
 * @param  (\Closure(array): string)|string[]|string  $replace
 * @param  string[]|string  $subject
 * @param  int  $limit
 * @return ($subject is array ? string[]|null : string|null)
 */
    static function replaceMatches($pattern, $replace, $subject, int $limit = -1) {
        throw new \Exception;
    }

        /**
 * Replace the first occurrence of the given value if it appears at the start of the string.
 * @return string
 */
    static function replaceStart(string $search, string $replace, string $subject) {
        throw new \Exception;
    }

        /**
 * Reverse the given string.
 * @return string
 */
    static function reverse(string $value) {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function rtrim(string $value, ?string $charlist = null): string {
        throw new \Exception;
    }

        /**
 * @todo проблема с php74 preg_replace отдает null из-за модификатора "u"
 * Convert a string to snake case.
 */
    static function snake(string $value, string $delimiter = '_'): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * as mb_str_split, without ext mbstring
 * @return \Generator<int,string>
 */
    static function split(string $string, int $length = 1): Generator {
        throw new \Exception;
    }

        /**
 * Remove all "extra" blank space from the given string.
 * @return string
 */
    static function squish(string $value) {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr
 * 
 * Begin a string with a single instance of a given value.
 * 
 * @return ($value is '' ? ($prefix is '' ? '' : non-empty-string): non-empty-string)
 */
    static function start(string $value, string $prefix): string {
        throw new \Exception;
    }

        /**
 * Determine if a given string starts with a given substring.
 * 
 * @param  string|iterable<string>  $needles
 * @return ($needles is array{} ? false : ($haystack is non-empty-string ? bool : false))
 *
 * @phpstan-assert-if-true =non-empty-string $haystack
 */
    static function startsWith(string $haystack, $needles, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr::studly()
 * 
 * Convert a value to studly caps case.
 * @todo почемуто не отрабатывает callable как строка с namespace. function_exists выдает false, хотя функция входит в бандл
 * @return ($value is '' ? '' : string)
 */
    static function studly(string $value) {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr::studly()
 * 
 * Convert a value to studly caps case.
 * @todo почемуто не отрабатывает callable как строка с namespace. function_exists выдает false, хотя функция входит в бандл
 * @return ($value is '' ? '' : string)
 */
    static function pascal(string $value) {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Returns the portion of the string specified by the start and length parameters.
 * @ext mbstring
 * @return string
 */
    static function substr(string $string, int $start, ?int $length = null, string $encoding = 'UTF-8') {
        throw new \Exception;
    }

        /**
 * Returns the number of substring occurrences.
 */
    static function substrCount(string $haystack, string $needle, int $offset = 0, ?int $length = null): int {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr
 * 
 * Replace text within a portion of a string.
 *
 * @ext mbstring
 * @param  string|string[]  $string
 * @param  string|string[]  $replace
 * @param  int|int[]  $offset
 * @param  int|int[]|null  $length
 * @return string|string[]
 */
    static function substrReplace($string, $replace, $offset = 0, $length = null) {
        throw new \Exception;
    }

        /**
 * Swap multiple keywords in a string with other keywords.
 *
 * @param  array<string, string>  $map
 * @param  string  $subject
 * @return string
 */
    static function swap(array $map, string $subject): string {
        throw new \Exception;
    }

        /**
 * Take the first or last {$limit} characters of a string.
 */
    static function take(string $string, int $limit): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Convert the given string to proper case.
 * @ext mbstring
 */
    static function title(string $value): string {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Converts a string to array using the first found separator from the provided list.
 * @param string $string  The input string to convert
 * @param string[] $separators  List of possible separators to check
 * @return string[]
 */
    static function toArray(string $string, array $separators = [',', '-', '|', ';', ':', '/', '\\']): array {
        throw new \Exception;
    }

        /**
 * @deprecated removed
 * @template T1 of array{nextChunkSize?:int,substrEncoding?:string}
 * @return \Closure(string &$string, int $chunk, T1 $opts):\Generator<array{
 * iteration:int,
 * countChunks:float,
 * startPos:int,
 * prevChunk:string|null,
 * nextChunk:string,
 * opts:T1
 * },string>
 * @ext mbstring
 */
    static function toCharsGenerator(): Closure {
        throw new \Exception;
    }

        /**
 * Convert the given value to a string or return the given fallback on failure.
 * @param  mixed  $value
 */
    static function toStringOr($value, string $fallback): string {
        throw new \Exception;
    }

        /**
 * Translate a PHP_URL_# constant to the named array keys PHP uses. | analog wp func "_wp_translate_php_url_constant_to_key"
 * @since 4.7.0
 *
 * @link https://www.php.net/manual/en/url.constants.php
 *
 * @param \PHP_URL_* $constant \PHP_URL_* constant.
 * @return string|empty-string The named key or false.
 */
    static function translatePhpUrlConstantToKey(int $constant): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Remove all whitespace from both ends of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
    static function trim(string $value, ?string $charlist = null): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Make a string's first character uppercase.
 * 
 * @return ($string is '' ? '' : non-empty-string)
 */
    static function ucfirst(string $string): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Split a string into pieces by uppercase characters.
 * @return ($string is '' ? array{} : string[])
 */
    static function ucsplit(string $string): array {
        throw new \Exception;
    }

        /**
 * Converts line endings to \n used on Unix-like systems.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
    static function unixNewLines(string $s, string $replacement = "\n"): string {
        throw new \Exception;
    }

        /**
 * Unwrap the string with the given strings.
 */
    static function unwrap(string $value, string $before, ?string $after = null): string {
        throw new \Exception;
    }

        /**
 * @deprecated LarStr
 * Convert the given string to upper-case.
 * 
 * @ext mbstring
 * @return ($value is '' ? '' : non-empty-string&uppercase-string)
 */
    static function upper(string $value, ?string $encoding = 'UTF-8'): string {
        throw new \Exception;
    }

        /**
 * Get the number of words a string contains.
 * 
 * @return non-negative-int
 */
    static function wordCount(string $string, ?string $characters = null): int {
        throw new \Exception;
    }

        /**
 * @deprecated use LarStr
 * Wrap a string to a given number of characters.
 */
    static function wordWrap(string $string, int $characters = 75, string $break = "\n", bool $cut_long_words = false): string {
        throw new \Exception;
    }

        /**
 * Limit the number of words in a string.
 */
    static function words(string $value, int $words = 100, string $end = '...'): string {
        throw new \Exception;
    }

        /**
 * Wrap the string with the given strings.
 */
    static function wrap(string $value, string $before, ?string $after = null): string {
        throw new \Exception;
    }

    }