<?php

namespace Inilim\Tool\Method\String;

/**
 * Return the remainder of a string after the last occurrence of a given value.
 */
function afterLast(string $subject, string $search): string
{
    if ($search === '') return $subject;

    $position = \strrpos($subject, $search);

    if ($position === false) return $subject;

    return \substr($subject, $position + \strlen($search));
}
