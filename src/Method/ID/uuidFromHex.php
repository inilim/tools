<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\ID;

/**
 */
function uuidFromHex(string $uhex, int $version): string
{
    return \sprintf(
        '%08s-%04s-%04x-%04x-%12s',
        \substr($uhex, 0, 8),
        \substr($uhex, 8, 4),
        (\hexdec(\substr($uhex, 12, 4)) & 0x0fff) | $version << 12,
        (\hexdec(\substr($uhex, 16, 4)) & 0x3fff) | 0x8000,
        \substr($uhex, 20, 12)
    );
}
