<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace the last occurrence of a given value in the string.
 */
function replaceLast(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    $position = \strrpos($subject, $search);

    if ($position !== false) {
        return \substr_replace($subject, $replace, $position, \strlen($search));
    }

    return $subject;
}
