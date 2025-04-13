<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove any occurrence of the given string in the subject.
 * 
 * @template Subj of string|string[]
 * @param string|string[] $search
 * @param Subj $subject
 * @return Subj
 */
function remove($search, $subject, bool $caseSensitive = true)
{
    return $caseSensitive
        ? \str_replace($search, '', $subject)
        : \str_ireplace($search, '', $subject);
}
