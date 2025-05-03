<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @param int|numeric-string $equal
 */
function lenEqual(string $str, $equal): bool
{
    return \Inilim\Tool\Method\Integer\equals(
        \Inilim\Tool\Method\Str\length($str),
        $equal
    );
}
