<?php

namespace Inilim\Tool\Method\LarStr;

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
function substrReplace($string, $replace, $offset = 0, $length = null)
{
    if (! \is_array($string) && (\is_array($offset) || \is_array($length))) {
        return \substr_replace($string, $replace, $offset, $length);
    }

    $replaceSubstring = static function ($string, $replace, $offset, $length) {
        if ($length === null) {
            $length = \Inilim\Tool\Method\LarStr\length($string);
        }

        return \mb_substr($string, 0, $offset)
            . $replace
            . \mb_substr(\mb_substr($string, $offset), $length);
    };

    $replacements = \is_array($replace) ? \array_values($replace) : null;

    if (! \is_array($string)) {
        return $replaceSubstring(
            $string,
            $replacements === null ? $replace : ($replacements[0] ?? ''),
            $offset,
            $length,
        );
    }

    $offsets = \is_array($offset) ? \array_values($offset) : null;
    $lengths = \is_array($length) ? \array_values($length) : null;
    $result = [];
    $position = 0;

    foreach ($string as $index => $value) {
        $result[$index] = $replaceSubstring(
            $value,
            $replacements === null ? $replace : ($replacements[$position] ?? ''),
            $offsets === null ? $offset : ($offsets[$position] ?? 0),
            $lengths === null ? $length : ($lengths[$position] ?? null),
        );

        $position++;
    }

    return $result;
}
