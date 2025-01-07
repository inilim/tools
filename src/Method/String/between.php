<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'beforeLast',
    'after',
]);

/**
 * Get the portion of a string between two given values.
 */
function between(string $subject, string $from, string $to): string
{
    if ($from === '' || $to === '') return $subject;

    return beforeLast(after($subject, $from), $to);
}
