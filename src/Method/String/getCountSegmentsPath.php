<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('trim');

/**
 * count segments url path
 * @return int
 */
function getCountSegmentsPath(string $path)
{
    $t = \trim(trim($path), '/');
    if ($t === '') return 0;
    $t = \preg_replace('#\/{2,}#', '/', $t);
    return \substr_count($t, '/');
}

    // function getCountSegmentsPath(string $path): int
    // {
    //     $t = \trim(Str::trim($path), '/');
    //     if ($t === '') return 0;
    //     $t = \preg_replace('#\/{2,}#', '/', $t);
    //     return \substr_count($t, '/');
    // }
