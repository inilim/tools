<?php

namespace Inilim\Tool\Method\String;

/**
 * segments url path
 * @return string[]
 */
function getSegmentsPath(string $path): array
{
    $t = \trim(\Inilim\Tool\Method\String\trim($path), '/');
    if ($t === '') return [];
    $t = \preg_replace('#\/{2,}#', '/', $t);
    return \explode('/', $t);
}
