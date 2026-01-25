<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * count segments url path
 */
function getCountSegmentsPath(string $path): int
{
    $t = \trim(\Inilim\Tool\Method\Str\trim($path), '/');
    if ($t === '') return 0;
    $t = \preg_replace('#\/{2,}#', '/', $t);
    $count = \substr_count($t, '/');
    return $count + 1;
}
