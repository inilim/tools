<?php

namespace Inilim\Tool\Method\String;

/**
 * Get the portion of a string before the last occurrence of a given value.
 */
function beforeLast(string $subject, string $search): string
{
    if ($search === '') return $subject;
    $pos = \mb_strrpos($subject, $search);

    if ($pos === false) return $subject;
    return \Inilim\Tool\Method\String\substr($subject, 0, $pos);
}
