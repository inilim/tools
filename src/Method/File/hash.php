<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @build_skip
 * Get the hash of the file at the given path.
 * @return string|false
 */
function hash(string $path, string $algorithm = 'md5')
{
    return \hash_file($algorithm, $path);
}
