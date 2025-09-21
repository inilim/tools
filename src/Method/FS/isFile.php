<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 */
function isFile(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \is_file($filename), null);
    return $value === null ? false : $value;
}
