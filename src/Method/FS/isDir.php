<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 */
function isDir(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static function () use ($filename) {
        $r = \is_dir($filename);
        \clearstatcache(false, $filename);
        return $r;
    }, null);
    return $value === null ? false : $value;
}
