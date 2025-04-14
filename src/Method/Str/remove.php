<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove any occurrence of the given string in the subject.
 * @param string|iterable<string> $search
 * @param string|iterable<string> $subject
 * @return ($subject is string ? string : string[])
 */
function remove($search, $subject, bool $caseSensitive = true)
{
    $search  = \Inilim\Tool\Method\Obj\toArrayIfTraversable($search);
    $subject = \Inilim\Tool\Method\Obj\toArrayIfTraversable($subject);

    return $caseSensitive
        ? \str_replace($search, '', $subject)
        : \str_ireplace($search, '', $subject);
}
