<?php

namespace Inilim\Tool\Method\Str;

/**
 * @param int|numeric-string $fromTo
 * @param int|numeric-string $toFrom
 * @return bool
 */
function lenBetween(string $str, $fromTo, $toFrom)
{
    return \Inilim\Tool\Method\Integer\checkBetween(
        \Inilim\Tool\Method\Str\length($str),
        $fromTo,
        $toFrom
    );
}
