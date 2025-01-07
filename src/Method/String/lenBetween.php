<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('length');
\Inilim\Tool\Integer::__include('checkBetween');

/**
 * @param int|numeric-string $fromTo
 * @param int|numeric-string $toFrom
 * @return bool
 */
function lenBetween(string $str, $fromTo, $toFrom)
{
    return \Inilim\Tool\Method\Integer\checkBetween(
        length($str),
        $fromTo,
        $toFrom
    );
}
