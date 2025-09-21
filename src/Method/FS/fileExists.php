<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 */
function fileExists(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \file_exists($filename), null);
    return $value === null ? false : $value;
}
