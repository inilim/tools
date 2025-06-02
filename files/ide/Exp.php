<?php

namespace Inilim\Tool;

class Exp
{
        /**
 * @author stevebauman <https://github.com/stevebauman>
 * Extract values from the haystack using the given template pattern.
 * @return array<string,string>
 */
    static function extract(string $haystack, string $pattern) {}

        /**
 * @author shaedrich <https://github.com/shaedrich>
 * Formats the input string accodring to the pattern passed in.
 *
 * @param  string  $string  the input string
 * @param  string  $pattern  asterisks will be replaced with the character
 *                           at the respective position of the input string
 *                           while other characters will put inserted as
 *                           is into the output string
 */
    static function formatByPattern(string $string, string $pattern) {}

        /**
 * @author nette/utils
 * @author inilim
 * Looks for a string from possibilities that is most similar to value, but not the same (for 8-bit encoding).
 * @param  string[]  $possibilities
 * @return string[]
 */
    static function getSuggestionLevenshtein(array $possibilities, string $value) {}

        /**
 * @author inilim
 * @return string
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
    static function hashFile(string $algo, string $pathToFile, int $byteStart = 1024, int $byteEnd = 1024, bool $binary = false) {}

        /**
 * @author Ashot1995 <https://github.com/Ashot1995>
 * @author inilim
 * @param  string  $value
 * @param  string  $separator
 * @return string
 */
    static function initials(string $value, string $separator = '') {}

        /**
 * @author princejohnsantillan <https://github.com/princejohnsantillan>
 * Interpolate placeholders in a string with mapped values.
 * @param  array<string,string>  $map
 */
    static function interpolate(string $string, array $map, bool $preserveMissing = true, string $pattern = '/{{\s*(\w+)\s*}}/'): string {}

        /**
 * @todo tests
 * @author youkidearitai <https://github.com/youkidearitai>
 * Implementation levenshtein distance algorithm.
 *
 * @param string $str1 The first string.
 * @param string $str2 The second string.
 *
 * @return int The Levenshtein distance between the two strings.
 */
    static function mbLevenshtein(string $str1, string $str2): int {}

    }