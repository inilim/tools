<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 */
function isDir(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \is_dir($filename), null);
    return $value === null ? false : $value;
}
