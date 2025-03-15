<?php

namespace Inilim\Tool\Method\String;

/**
 * Determine if a given string doesn't contain a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
function doesntContain(string $haystack, $needles, bool $ignoreCase = false)
{
    return !\Inilim\Tool\Method\String\contains($haystack, $needles, $ignoreCase);
}
