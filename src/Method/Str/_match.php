<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Get the string matching the given pattern.
 * @return string
 */
function _match(string $pattern, string $subject)
{
    \preg_match($pattern, $subject, $matches);

    if (!$matches) {
        return '';
    }

    return $matches[1] ?? $matches[0];
}
