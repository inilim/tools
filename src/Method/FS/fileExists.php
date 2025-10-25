<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * @deprecated use exists()
 */
function fileExists(string $filename): bool
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \file_exists($filename));
    return $value === null ? false : $value;
}
