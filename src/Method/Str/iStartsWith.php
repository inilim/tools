<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @param string|iterable<string> $needles
 * @return bool
 */
function iStartsWith(string $haystack, $needles)
{
    if (!\is_iterable($needles)) $needles = [$needles];

    foreach ($needles as &$needle) {
        $needle = \Inilim\Tool\Method\Str\lower($needle);
    }

    return \Inilim\Tool\Method\Str\startsWith(
        \Inilim\Tool\Method\Str\lower($haystack),
        $needles
    );
}
