<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace consecutive instances of a given character with a single character in the given string.
 * @return string
 */
function deduplicate(string $string, string $character = ' ')
{
    return \preg_replace('/' . \preg_quote($character, '/') . '+/u', $character, $string);
}
