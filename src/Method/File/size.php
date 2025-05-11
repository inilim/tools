<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the file size of a given file.
 * @return int<-1,max>
 */
function size(string $pathToFile): int
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \filesize($pathToFile),
        null
    );

    if (!\is_int($result)) {
        $result = -1;
    }

    return $result;
}
