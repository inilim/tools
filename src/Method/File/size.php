<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * Convert the given number to its file size equivalent.
 * @param int|float|string $bytesOrFile
 * @return string
 * 
 * @throws \Exception
 * @throws \ValueError
 */
function size($bytesOrFile, bool $useBinaryPrefix = false): string
{
    if (!\Inilim\Tool\Method\Check\intOrFloatOrFile($bytesOrFile)) {
        throw new \ValueError(\sprintf('Argument #1 ($bytesOrFile) must be of type int|float|string-path-to-file, %s given in ', \gettype($bytesOrFile)));
    }

    if (\is_string($bytesOrFile)) {
        $bytes = @\filesize($bytesOrFile);
        if ($bytes === false) {
            throw new \Exception(\sprintf('Fail open file "%s"', $bytesOrFile));
        }
    } else {
        $bytes = $bytesOrFile;
    }

    $units = $useBinaryPrefix
        ? ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB', 'RiB', 'QiB']
        : ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'RB', 'QB'];

    for ($i = 0; ($bytes / 1024) > 0.9 && ($i < \sizeof($units) - 1); $i++) {
        $bytes /= 1024;
    }

    return \sprintf(
        '%s %s',
        $bytes,
        $units[$i]
    );
}
