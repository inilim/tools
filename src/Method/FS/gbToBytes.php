<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Gigabytes to Bytes
 */
function gbToBytes(int $gb): int
{
    return 8_589_934_592 * $gb;
}
