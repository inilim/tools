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
function getInclude(string $pathToFile, array $data = [])
{
    if (\is_file($pathToFile)) {
        $__path = $pathToFile;
        $__data = $data;

        return (static function () use ($__path, $__data) {
            \extract($__data, \EXTR_SKIP);

            return include $__path;
        })();
    }

    throw \Inilim\Tool\Method\Obj\sprintfException('File does not exist at path "%s".', [$pathToFile]);
}
