<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Replace the first occurrence of the given value if it appears at the start of the string.
 * @return string
 */
function replaceStart(string $search, string $replace, string $subject)
{
    if ($search === '') {
        return $subject;
    }

    if (\Inilim\Tool\Method\PF\str_starts_with($subject, $search)) {
        return \Inilim\Tool\Method\Str\replaceFirst($search, $replace, $subject);
    }

    return $subject;
}
