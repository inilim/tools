<?php

namespace Inilim\Tool\Method\Str;

/**
 * Remove all non-numeric characters from a string.
 */
function numbers(string $value): string
{
    return \preg_replace('/[^0-9]/', '', $value);
}
