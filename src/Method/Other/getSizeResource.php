<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @param resource $value
 * @return int return -1 if failed
 */
function getSizeResource($value): int
{
    // TODO add Assert
    $size = \Inilim\Tool\Method\FS\fstat($value);
    return $size === null ? -1 : \intval($size['size'] ?? -1);
}
