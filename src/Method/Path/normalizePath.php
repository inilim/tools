<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @deprecated use Path::normalize
 */
function normalizePath(string $path): string
{
    return \Inilim\Tool\Method\Path\normalize($path);
}
