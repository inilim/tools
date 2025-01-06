<?php

namespace Inilim\Method\String;

/**
 * Replace the given value in the given string.
 * @param  string|string[]  $search
 * @param  string|string[]  $replace
 * @param  string|string[]  $subject
 * @return string|string[]
 */
function replace($search, $replace, $subject, bool $caseSensitive = true)
{
    return $caseSensitive
        ? \str_replace($search, $replace, $subject)
        : \str_ireplace($search, $replace, $subject);
}
