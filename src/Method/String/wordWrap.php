<?php

namespace Inilim\Tool\Method\String;

/**
 * Wrap a string to a given number of characters.
 */
function wordWrap(string $string, int $characters = 75, string $break = "\n", bool $cut_long_words = false): string
{
    return \wordwrap($string, $characters, $break, $cut_long_words);
}
