<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @link https://php.net/manual/en/function.file-exists.php
 */
function exists(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($filename) {
        \clearstatcache(false, $filename);
        return \file_exists($filename);
    });
    return \is_bool($value) ? $value : false;
}
