<?php

namespace Inilim\Method\String;

/**
 * Convert the given string to proper case.
 */
function title(string $value): string
{
    return \mb_convert_case($value, \MB_CASE_TITLE, 'UTF-8');
}
