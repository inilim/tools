<?php

namespace Inilim\Method\String;

/**
 * Find the multi-byte safe position of the first occurrence of a given substring in a string.
 * @return int|false
 */
function position(string $haystack, string $needle, int $offset = 0, ?string $encoding = 'UTF-8')
{
    return \mb_strpos($haystack, $needle, $offset, $encoding);
}
