<?php

namespace Inilim\Method\String;

/**
 * Limit the number of characters in a string.
 */
function limit(string $value, int $limit = 100, string $end = '...'): string
{
    if (\mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }

    return \rtrim(\mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
}
