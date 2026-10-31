<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Ensure a directory exists.
 * @todo tests
 * @author Inilim
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param null|resource|array $context
 * @return array{result:?bool,exception:?TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
function ensureDirExists_v2(
    string $directory,
    int $permissions      = 0755,
    bool $recursive       = true,
    $context              = null,
    ?array $contextParams = null,
    bool $throw           = false
): array {

    if (\Inilim\Tool\Method\FS\isDir($directory)) {
        return ['result' => true, 'exception' => null];
    }

    return \Inilim\Tool\Method\FS\makeDir_v2(
        $directory,
        $permissions,
        $recursive,
        $context,
        $contextParams,
        false,
        $throw
    );
}
