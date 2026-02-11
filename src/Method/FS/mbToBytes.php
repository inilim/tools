<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Megabytes to Bytes
 */
function mbToBytes(int $mb): int
{
    // 1_000_000
    return 1_000_000 * $mb;
}
