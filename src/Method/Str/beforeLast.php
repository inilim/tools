<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Get the portion of a string before the last occurrence of a given value.
 * @ext mbstring
 */
function beforeLast(string $subject, string $search): string
{
    if ($search === '') return $subject;
    $pos = \mb_strrpos($subject, $search);

    if ($pos === false) return $subject;
    return \Inilim\Tool\Method\Str\substr($subject, 0, $pos);
}
