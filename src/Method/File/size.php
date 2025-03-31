<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Convert the given number to its file size equivalent.
 * @skip_build
 * @param int|float $bytes
 * @param int $precision
 * @param int|null $maxPrecision
 * @return string
 */
function size($bytes, int $precision = 0, ?int $maxPrecision = null)
{
    $units = [
        'B',
        'KB',
        'MB',
        'GB',
        'TB',
        'PB',
        'EB',
        'ZB',
        'YB',
    ];

    for ($i = 0; ($bytes / 1024) > 0.9 && ($i < \sizeof($units) - 1); $i++) {
        $bytes /= 1024;
    }

    return \sprintf(
        '%s %s',
        // $this->format($bytes, $precision, $maxPrecision),
        $bytes,
        $units[$i]
    );
}
