<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author laravel
 * 
 * Determine if a given string doesn't start with a given substring.
 * 
 * @param  string|iterable<string>  $needles
 * @return ($needles is array{} ? true : ($haystack is non-empty-string ? bool : true))
 * @phpstan-assert-if-false =non-empty-string $haystack
 */
function doesntStartWith(string $haystack, $needles): bool
{
    return ! \Inilim\Tool\Method\Str\startsWith($haystack, $needles);
}
