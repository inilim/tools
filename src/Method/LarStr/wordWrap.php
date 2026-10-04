<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Wrap a string to a given number of characters.
 *
 * @param  string  $string
 * @param  int  $characters
 * @param  string  $break
 * @param  bool  $cutLongWords
 * @return string
 */
function wordWrap($string, $characters = 75, $break = "\n", $cutLongWords = false)
{
    if (\Inilim\Tool\Method\LarStr\isAscii($string)) {
        return \wordwrap($string, $characters, $break, $cutLongWords);
    }

    if ($break === '') {
        return \wordwrap($string, $characters, $break, $cutLongWords);
    }

    $replaced = [];

    $skeleton = \preg_replace_callback('/[\x80-\xFF][\x80-\xBF]*|\x1A/', static function ($match) use (&$replaced) {
        $replaced[] = $match[0];

        return "\x1A";
    }, $string);

    $breakToken = "\0";

    while (\Inilim\Tool\Method\PF\str_contains($skeleton, $breakToken)) {
        $breakToken .= "\0";
    }

    $index = 0;

    return \implode($break, \array_map(static function ($segment) use (&$replaced, &$index) {
        return \preg_replace_callback('/\x1A/', static function () use (&$replaced, &$index) {
            return $replaced[$index++];
        }, $segment);
    }, \explode($breakToken, \wordwrap($skeleton, $characters, $breakToken, $cutLongWords))));
}
