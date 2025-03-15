<?php

namespace Inilim\Tool\Method\String;

/**
 * @param int|numeric-string $fromTo
 * @param int|numeric-string $toFrom
 * @return bool
 */
function lenBetween(string $str, $fromTo, $toFrom)
{
    return \Inilim\Tool\Method\Integer\checkBetween(
        \Inilim\Tool\Method\String\length($str),
        $fromTo,
        $toFrom
    );
}
