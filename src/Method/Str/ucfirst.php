<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Make a string's first character uppercase.
 */
function ucfirst(string $string): string
{
    return \Inilim\Tool\Method\Str\upper(
        \Inilim\Tool\Method\Str\substr($string, 0, 1)
    ) . \Inilim\Tool\Method\Str\substr($string, 1);
}
