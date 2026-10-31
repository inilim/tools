<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @deprecated use makeDir_v2
 * 
 * Create a directory.
 * @todo tests
 * @author Inilim
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param null|resource|array $context
 * @return array{result:bool,exception:null}|array{result:null,exception:TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
function makeDir(
    string $path,
    bool $throw           = false,
    int $mode             = 0755,
    bool $recursive       = false,
    bool $force           = false,
    $context              = null,
    ?array $contextParams = null
): array {
    return \Inilim\Tool\Method\FS\makeDir_v2($path, $mode, $recursive, $context, $contextParams, $force, $throw);
}
