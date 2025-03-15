<?php

namespace Inilim\Tool\Method\String;

/**
 * count segments url path
 * @return int
 */
function getCountSegmentsPath(string $path)
{
    $t = \trim(\Inilim\Tool\Method\String\trim($path), '/');
    if ($t === '') return 0;
    $t = \preg_replace('#\/{2,}#', '/', $t);
    return \substr_count($t, '/');
}
