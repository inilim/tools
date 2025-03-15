<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace the first occurrence of the given value if it appears at the start of the string.
 */
function replaceStart(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    if (\Inilim\Tool\Method\String\startsWith($subject, $search)) {
        return \Inilim\Tool\Method\String\replaceFirst($search, $replace, $subject);
    }

    return $subject;
}
