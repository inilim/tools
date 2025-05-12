<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @author laravel from Number::fileSize
 * Convert the given number to its file size equivalent.
 * @param int|float $bytes
 * 
 * @throws \Exception
 * @throws \InvalidArgumentException
 */
function sizeConvert($bytes, int $precision = 0, ?int $maxPrecision = null, bool $useBinaryPrefix = false): string
{
    if (!\Inilim\Tool\Method\Check\intOrFloat($bytes)) {
        throw new \InvalidArgumentException(
            \sprintf('Argument #1 ($bytes) must be of type int|float, %s given in ', \gettype($bytes))
        );
    }

    $base  = $useBinaryPrefix ? 1024 : 1000;
    $units = $useBinaryPrefix
        ? ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB', 'RiB', 'QiB']
        : ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'RB', 'QB'];

    for ($i = 0; ($bytes / $base) > 0.9 && ($i < \sizeof($units) - 1); $i++) {
        $bytes /= $base;
    }

    return \sprintf(
        '%s %s',
        \Inilim\Tool\Method\Integer\format($bytes, $precision, $maxPrecision),
        $units[$i]
    );
}
