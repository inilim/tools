<?php

namespace Inilim\Method\String;

/**
 * Get the string matching the given pattern.
 */
function match(string $pattern, string $subject): string
{
    \preg_match($pattern, $subject, $matches);

    if (!$matches) return '';

    return $matches[1] ?? $matches[0];
}
