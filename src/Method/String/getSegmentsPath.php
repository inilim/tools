<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('trim');

/**
 * segments url path
 * @return string[]|array{}
 */
function getSegmentsPath(string $path): array
{
    $t = \trim(trim($path), '/');
    if ($t === '') return [];
    $t = \preg_replace('#\/{2,}#', '/', $t);
    return \explode('/', $t);
}

/**
 * @return string[]|array{}
 */
    // function getSegmentsPath(string $path): array
    // {
    //     $t = \trim($path, '/');
    //     if ($t === '') return [];
    //     $t = \preg_replace('#\/{2,}#', '/', $t);
    //     return \explode('/', $t);
    // }