<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Split a string into pieces by uppercase characters.
 * @return ($string is '' ? array{} : string[])
 */
function ucsplit(string $string): array
{
    return \preg_split('/(?=\p{Lu})/u', $string, -1, \PREG_SPLIT_NO_EMPTY);
}
