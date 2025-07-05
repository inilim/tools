<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author laravel
 * Determine if a given string doesn't start with a given substring.
 * @param  string|iterable<string>  $needles
 */
function doesntStartWith(string $haystack, $needles): bool
{
    return ! \Inilim\Tool\Method\Str\startsWith($haystack, $needles);
}
