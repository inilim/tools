<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Replace the given value in the given string.
 * @param string|iterable<string> $search
 * @param string|iterable<string> $replace
 * @param string|iterable<string> $subject
 * @return ($subject is string ? string : string[])
 */
function replace($search, $replace, $subject, bool $caseSensitive = true)
{
    $search  = \Inilim\Tool\Method\Obj\toArrayIfTraversable($search);
    $replace = \Inilim\Tool\Method\Obj\toArrayIfTraversable($replace);
    $subject = \Inilim\Tool\Method\Obj\toArrayIfTraversable($subject);

    return $caseSensitive
        ? \str_replace($search, $replace, $subject)
        : \str_ireplace($search, $replace, $subject);
}
