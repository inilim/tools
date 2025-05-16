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
function sizeConvert($bytes, int $precision = 0, ?int $maxPrecision = null): string
{
    if (!\Inilim\Tool\Method\Check\intOrFloat($bytes)) {
        throw new \InvalidArgumentException(
            \sprintf('Argument #1 ($bytes) must be of type int|float, %s given in ', \gettype($bytes))
        );
    }

    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    for ($i = 0; ($bytes / 1024) > 0.9 && ($i < \count($units) - 1); $i++) {
        $bytes /= 1024;
    }

    return \sprintf(
        '%s %s',
        \Inilim\Tool\Method\Integer\format($bytes, $precision, $maxPrecision),
        $units[$i]
    );
}
