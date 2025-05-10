<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Determine if a file or directory is missing.
 */
function missing(string $path): bool
{
    return ! \Inilim\Tool\Method\FS\exists($path);
}
