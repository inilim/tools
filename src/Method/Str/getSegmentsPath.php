<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * segments url path
 * @return string[]
 */
function getSegmentsPath(string $path): array
{
    $t = \trim(\Inilim\Tool\Method\Str\trim($path), '/');
    if ($t === '') return [];
    $t = \preg_replace('#\/{2,}#', '/', $t);
    return \explode('/', $t);
}
