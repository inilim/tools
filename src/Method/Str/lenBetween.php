<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @param int|numeric-string $fromTo
 * @param int|numeric-string $toFrom
 */
function lenBetween(string $str, $fromTo, $toFrom): bool
{
    return \Inilim\Tool\Method\Integer\checkBetween(
        \Inilim\Tool\Method\Str\length($str),
        $fromTo,
        $toFrom
    );
}
