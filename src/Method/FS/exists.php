<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Determine if a file or directory exists.
 */
function exists(string $path): bool
{
    return \file_exists($path);
}
