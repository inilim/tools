<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Ensure a directory exists.
 * @todo tests
 * @author Inilim
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @param null|resource|array $context
 * @return array{result:?bool,exception:?THROW_get_0}
 * @throws THROW_get_0
 */
function ensureDirExists(
    string $path,
    bool $throw           = false,
    int $mode             = 0755,
    bool $recursive       = true,
    $context              = null,
    ?array $contextParams = null
): array {

    if (\is_dir($path)) {
        return ['result' => true, 'exception' => null];
    }

    return \Inilim\Tool\Method\FS\makeDir(
        $path,
        $throw,
        $mode,
        $recursive,
        false,
        $context,
        $contextParams
    );
}
