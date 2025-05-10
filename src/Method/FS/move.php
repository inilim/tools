<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Move a file to a new location.
 */
function move(string $path, string $target): bool
{
    return \rename($path, $target);
}
