<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * count segments url path
 * @return int
 */
function getCountSegmentsPath(string $path)
{
    $t = \trim(\Inilim\Tool\Method\Str\trim($path), '/');
    if ($t === '') return 0;
    $t = \preg_replace('#\/{2,}#', '/', $t);
    return \substr_count($t, '/');
}
