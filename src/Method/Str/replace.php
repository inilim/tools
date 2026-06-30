<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr
 * Replace the given value in the given string.
 * @param string|iterable<string> $search
 * @param string|iterable<string> $replace
 * @param string|iterable<string> $subject
 * @return ($subject is string ? string : string[])
 */
function replace($search, $replace, $subject, bool $caseSensitive = true)
{
    if ($search instanceof \Traversable) {
        $search  = \Inilim\Tool\Method\Arr\from($search);
    }
    if ($replace instanceof \Traversable) {
        $replace = \Inilim\Tool\Method\Arr\from($replace);
    }
    if ($subject instanceof \Traversable) {
        $subject = \Inilim\Tool\Method\Arr\from($subject);
    }

    return $caseSensitive
        ? \str_replace($search, $replace, $subject)
        : \str_ireplace($search, $replace, $subject);
}
