<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @skip_build
 * @return bool
 * @throws \ValueError
 */
function isRealPath(string $path, bool $checkExistsFile = false)
{
    if ($checkExistsFile) {
        if (!\is_file($path)) {
            throw new \ValueError(\sprintf('File "%s" not found', $path));
        }
    }

    $path = \Inilim\Tool\Method\Path\normalizePath($path);
    return !!\preg_match('#(\/\.{1,}\/)|(^\.{1,}\/)#', $path);
}
