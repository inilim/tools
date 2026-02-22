<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Make a string's first character lowercase.
 * 
 * @return ($string is '' ? '' : non-empty-string)
 */
function lcfirst(string $string): string
{
    return \Inilim\Tool\Method\Str\lower(
        \Inilim\Tool\Method\Str\substr($string, 0, 1)
    ) . \Inilim\Tool\Method\Str\substr($string, 1);
}
