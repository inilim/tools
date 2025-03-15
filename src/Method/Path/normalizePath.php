<?php

namespace Inilim\Tool\Method\Path;

/**
 * @return string
 */
function normalizePath(string $path)
{
    $path = \strtr($path, '\\', '/');
    $path = \Inilim\Tool\Method\String\deduplicate($path, '/');
    // Windows paths should uppercase the drive letter.
    if (':' === \Inilim\Tool\Method\String\substr($path, 1, 1)) {
        $path = \Inilim\Tool\Method\String\ucfirst($path);
    }
    return $path;
}
