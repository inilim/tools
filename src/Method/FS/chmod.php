<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Get or set UNIX mode of a file or directory.
 * @return mixed
 */
function chmod(string $path, ?int $mode = null)
{
    if ($mode) {
        return \chmod($path, $mode);
    }

    return \substr(\sprintf('%o', \Inilim\Tool\Method\FS\filePerms($path)), -4);
}
