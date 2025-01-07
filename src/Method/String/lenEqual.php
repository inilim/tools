<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('length');
\Inilim\Tool\Integer::__include('equals');

/**
 * @param int|numeric-string $equal
 * @return bool
 */
function lenEqual(string $str, $equal)
{
    return \Inilim\Tool\Method\Integer\equals(
        length($str),
        $equal
    );
}
