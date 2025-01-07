<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'endsWith',
    'replaceLast',
]);

/**
 * Replace the last occurrence of a given value if it appears at the end of the string.
 */
function replaceEnd(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    if (endsWith($subject, $search)) {
        return replaceLast($search, $replace, $subject);
    }

    return $subject;
}
