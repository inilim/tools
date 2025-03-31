<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @return string
 */
function normalizePath(string $path)
{
    $path = \strtr($path, '\\', '/');
    $path = \Inilim\Tool\Method\Str\deduplicate($path, '/');
    // Windows paths should uppercase the drive letter.
    if (':' === \Inilim\Tool\Method\Str\substr($path, 1, 1)) {
        $path = \Inilim\Tool\Method\Str\ucfirst($path);
    }
    return $path;
}
