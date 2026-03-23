<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

// INFO эту функцию не переносим в LarStr так как она в оригинале работает с классом Collection

/**
 * @author laravel
 * 
 * Get the string matching the given pattern.
 *
 * @return string[]
 */
function matchAll(string $pattern, string $subject): array
{
    \preg_match_all($pattern, $subject, $matches);

    if ($matches[0] === []) {
        return [];
    }

    return $matches[1] ?? $matches[0];
}
