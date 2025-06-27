<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the returned value of a file.
 *
 * @param string[] $pathToFiles
 * @param mixed[] $data
 * @return array<string,mixed>
 * @throws \Exception
 */
function getBulkRequire(array $pathToFiles, array $data = [], bool $once = false): array
{
    $result = [];
    foreach ($pathToFiles as $file) {
        $result[$file] = \Inilim\Tool\Method\File\getRequire($file, $data, $once);
    }
    return $result;
}
