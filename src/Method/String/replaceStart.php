<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'startsWith',
    'replaceFirst',
]);

/**
 * Replace the first occurrence of the given value if it appears at the start of the string.
 */
function replaceStart(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    if (startsWith($subject, $search)) {
        return replaceFirst($search, $replace, $subject);
    }

    return $subject;
}
