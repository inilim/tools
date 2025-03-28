<?php

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string doesn't contain a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
function doesntContain(string $haystack, $needles, bool $ignoreCase = false)
{
    return !\Inilim\Tool\Method\Str\contains($haystack, $needles, $ignoreCase);
}
