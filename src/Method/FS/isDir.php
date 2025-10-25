<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 */
function isDir(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($filename) {
        \clearstatcache(false, $filename);
        return \is_dir($filename);
    });
    return $value === null ? false : $value;
}
