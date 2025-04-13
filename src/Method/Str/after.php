<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Return the remainder of a string after the first occurrence of a given value.
 */
function after(string $subject, string $search): string
{
    return $search === '' ? $subject : \array_reverse(\explode($search, $subject, 2))[0];
}
