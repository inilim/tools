<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Swap multiple keywords in a string with other keywords.
 */
function swap(array $map, string $subject): string
{
    return \strtr($subject, $map);
}
