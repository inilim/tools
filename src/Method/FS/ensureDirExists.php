<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @deprecated use ensureDirExists_v2()
 * 
 * Ensure a directory exists.
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param null|resource|array $context
 * @return array{result:?bool,exception:?TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
function ensureDirExists(
    string $path,
    bool $throw           = false,
    int $mode             = 0755,
    bool $recursive       = true,
    $context              = null,
    ?array $contextParams = null
): array {
    return \Inilim\Tool\Method\FS\ensureDirExists_v2($path, $mode, $recursive, $context, $contextParams, $throw);
}
