<?php

namespace Inilim\Tool;

class Exp
{
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
 * @todo tests
 * @author youkidearitai <https://github.com/youkidearitai>
 * Implementation levenshtein distance algorithm.
 *
 * @param string $str1 The first string.
 * @param string $str2 The second string.
 *
 * @return int The Levenshtein distance between the two strings.
 */
    static function mbLevenshtein(string $str1, string $str2) {}

    }