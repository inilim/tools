<?php

namespace Inilim\Tool\Method\String;

/**
 * Split a string into pieces by uppercase characters.
 * @return string[]
 */
function ucsplit(string $string): array
{
    return \preg_split('/(?=\p{Lu})/u', $string, -1, \PREG_SPLIT_NO_EMPTY);
}
