<?php

namespace Inilim\Tool\Method\String;

/**
 * Determine if a given string starts with a given substring.
 * @param  string|iterable<string>  $needles
 * @return bool
 */
function startsWith(string $haystack, $needles)
{
    if (!\is_iterable($needles)) $needles = [$needles];

    foreach ($needles as $needle) {
        if ((string) $needle !== '' && \Inilim\Tool\Method\String\_startsWith($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
