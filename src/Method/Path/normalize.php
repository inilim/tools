<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

function normalize(string $path): string
{
    $path = \strtr($path, '\\', '/');
    $path = \Inilim\Tool\Method\Str\deduplicate($path, '/');
    // Windows paths should uppercase the drive letter.
    if (':' === \Inilim\Tool\Method\LarStr\substr($path, 1, 1)) {
        $path = \Inilim\Tool\Method\LarStr\ucfirst($path);
    }
    return $path;
}
