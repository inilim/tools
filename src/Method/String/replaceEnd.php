<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace the last occurrence of a given value if it appears at the end of the string.
 */
function replaceEnd(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    if (\Inilim\Tool\Method\String\endsWith($subject, $search)) {
        return \Inilim\Tool\Method\String\replaceLast($search, $replace, $subject);
    }

    return $subject;
}
