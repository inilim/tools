<?php

namespace Inilim\Tool\Method\String;

/**
 * Return the remainder of a string after the first occurrence of a given value.
 */
function after(string $subject, string $search): string
{
    return $search === '' ? $subject : \array_reverse(\explode($search, $subject, 2))[0];
}
