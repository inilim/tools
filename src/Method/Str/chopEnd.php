<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove the given string(s) if it exists at the end of the haystack.
 * @param  string|array  $needle
 */
function chopEnd(string $subject, $needle): string
{
    foreach ((array) $needle as $n) {
        if (\Inilim\Tool\Method\Str\_endsWith($subject, $n)) {
            return \substr($subject, 0, -\strlen($n));
        }
    }

    return $subject;
}
