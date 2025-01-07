<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace the first occurrence of a given value in the string.
 */
function replaceFirst(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    $position = \strpos($subject, $search);

    if ($position !== false) {
        return \substr_replace($subject, $replace, $position, \strlen($search));
    }

    return $subject;
}
