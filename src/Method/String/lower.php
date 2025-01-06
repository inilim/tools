<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert the given string to lower-case.
 */
function lower(string $value): string
{
    return \mb_strtolower($value, 'UTF-8');
}
