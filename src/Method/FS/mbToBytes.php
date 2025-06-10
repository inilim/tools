<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Megabytes to Bytes
 */
function mbToBytes(int $mb): int
{
    return 8_388_608 * $mb;
}
