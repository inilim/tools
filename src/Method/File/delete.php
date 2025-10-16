<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @author Laravel
 * Delete the file at a given path.
 * @param  string[]|string  $paths
 */
function delete($paths): bool
{
    $paths = \is_array($paths) ? $paths : \func_get_args();

    $success = true;

    foreach ($paths as $path) {
        try {
            if (@\unlink($path)) {
                \clearstatcache(false, $path);
            } else {
                $success = false;
            }
        } catch (\ErrorException $e) {
            $success = false;
        }
    }

    return $success;
}
