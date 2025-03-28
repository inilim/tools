<?php

namespace Inilim\Tool\Method\Str;

/**
 * Replace the first occurrence of the given value if it appears at the start of the string.
 */
function replaceStart(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    if (\Inilim\Tool\Method\Str\startsWith($subject, $search)) {
        return \Inilim\Tool\Method\Str\replaceFirst($search, $replace, $subject);
    }

    return $subject;
}
