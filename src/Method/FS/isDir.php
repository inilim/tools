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
        $t = \is_dir($filename);
        return null === $t ? false : $t;
    });
    return \is_bool($value) ? $value : false;
}
