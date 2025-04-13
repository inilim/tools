<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Replace the last occurrence of a given value if it appears at the end of the string.
 */
function replaceEnd(string $search, string $replace, string $subject): string
{
    if ($search === '') return $subject;

    if (\Inilim\Tool\Method\Str\endsWith($subject, $search)) {
        return \Inilim\Tool\Method\Str\replaceLast($search, $replace, $subject);
    }

    return $subject;
}
