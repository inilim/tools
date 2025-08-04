<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated use Str::startsWith(ignoreCase: true)
 * @param string|iterable<string> $needles
 */
function iStartsWith(string $haystack, $needles, bool $ignoreCase = false): bool
{
    return \Inilim\Tool\Method\Str\startsWith(
        $haystack,
        $needles,
        true
    );
}
