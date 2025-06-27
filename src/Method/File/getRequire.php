<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the returned value of a file.
 *
 * @param mixed[] $data
 * @return mixed
 * @throws \Exception
 */
function getRequire(string $pathToFile, array $data = [], bool $once = false)
{
    if (\is_file($pathToFile)) {
        $__path = $pathToFile;
        $__data = $data;
        $__once = $once;

        return (static function () use ($__path, $__data, $__once) {
            \extract($__data, \EXTR_SKIP);

            if ($__once) {
                return require_once $__path;
            }
            return require $__path;
        })();
    }

    throw \Inilim\Tool\Method\Obj\sprintfException('File does not exist at path "%s".', [$pathToFile]);
}
