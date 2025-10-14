<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

/**
 * @author inilim
 */
function realPath(string $path): ?string
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \realpath($path), null);
    /** @var false|string $value */
    return $value === false ? null : $value;
}
