<?php

namespace Inilim\Tool\Method\String;

/**
 * Reverse the given string.
 */
function reverse(string $value): string
{
    return \implode(\array_reverse(\mb_str_split($value)));
}
