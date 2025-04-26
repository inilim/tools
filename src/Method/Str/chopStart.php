<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove the given string(s) if it exists at the start of the haystack.
 * @param  string|array  $needle
 */
function chopStart(string $subject, $needle): string
{
    foreach ((array) $needle as $n) {
        if (\Inilim\Tool\Method\PF\str_starts_with($subject, $n)) {
            return \substr($subject, \strlen($n));
        }
    }

    return $subject;
}
