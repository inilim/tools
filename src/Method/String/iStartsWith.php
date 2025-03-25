<?php

namespace Inilim\Tool\Method\String;

/**
 * @param string|iterable<string> $needles
 * @return bool
 */
function iStartsWith(string $haystack, $needles)
{
    if (!\is_iterable($needles)) $needles = [$needles];

    foreach ($needles as &$needle) {
        $needle = \Inilim\Tool\Method\String\lower($needle);
    }

    return \Inilim\Tool\Method\String\startsWith(
        \Inilim\Tool\Method\String\lower($haystack),
        $needles
    );
}
