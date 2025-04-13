<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @param int|numeric-string $equal
 * @return bool
 */
function lenEqual(string $str, $equal)
{
    return \Inilim\Tool\Method\Integer\equals(
        \Inilim\Tool\Method\Str\length($str),
        $equal
    );
}
