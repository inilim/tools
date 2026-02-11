<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Kilobytes to Bytes
 */
function kbToBytes(int $kb): int
{
    return 1_000 * $kb;
}
