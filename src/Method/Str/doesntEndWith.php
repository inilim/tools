<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author laravel
 * Determine if a given string doesn't end with a given substring.
 * @param  string|iterable<string>  $needles
 */
function doesntEndWith(string $haystack, $needles): bool
{
    return ! \Inilim\Tool\Method\Str\endsWith($haystack, $needles);
}
