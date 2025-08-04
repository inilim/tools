<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated use Str::endsWith(ignoreCase: true)
 * @param string|iterable<string> $needles
 */
function iEndsWith(string $haystack, $needles): bool
{
    return \Inilim\Tool\Method\Str\endsWith(
        $haystack,
        $needles,
        true
    );
}
