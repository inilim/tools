<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @param resource $value
 * @return int return -1 if failed
 */
function getSizeResource($value): int
{
    \Inilim\Tool\Method\Assert\resource($value);
    $size = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \fstat($value), null);
    return \intval($size['size'] ?? -1);
}
