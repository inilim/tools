<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'before',
    'after',
]);

/**
 * Get the smallest possible portion of a string between two given values.
 */
function betweenFirst(string $subject, string $from, string $to): string
{
    if ($from === '' || $to === '') {
        return $subject;
    }

    return before(after($subject, $from), $to);
}
