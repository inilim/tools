<?php

namespace Inilim\Method\String;

/**
 * Convert the given string to upper-case.
 */
function upper(string $value): string
{
    return \mb_strtoupper($value, 'UTF-8');
}
