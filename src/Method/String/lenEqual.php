<?php

namespace Inilim\Tool\Method\String;

/**
 * @param int|numeric-string $equal
 * @return bool
 */
function lenEqual(string $str, $equal)
{
    return \Inilim\Tool\Method\Integer\equals(
        \Inilim\Tool\Method\String\length($str),
        $equal
    );
}
