<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Determine if two files are the same by comparing their hashes.
 */
function hasSameHash(string $firstFile, string $secondFile): ?bool
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($firstFile, $secondFile) {
            $hash = \hash_file('xxh128', $firstFile);
            return $hash && \hash_equals($hash, (string) \hash_file('xxh128', $secondFile));
        },
        null
    );

    if (!\is_bool($result)) {
        return null;
    }

    return $result;
}
