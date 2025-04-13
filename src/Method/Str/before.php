<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Get the portion of a string before the first occurrence of a given value.
 */
function before(string $subject, string $search): string
{
    if ($search === '') return $subject;

    $result = \strstr($subject, $search, true);

    return $result === false ? $subject : $result;
}
