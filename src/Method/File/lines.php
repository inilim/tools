<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file one line at a time.
 * @return \Closure():\Generator<string>
 * @throws \Exception
 */
function lines(string $pathToFile): \Closure
{
    if (! \is_file($pathToFile)) {
        throw new \Exception(
            "File does not exist at path {$pathToFile}."
        );
    }

    return static function () use ($pathToFile): \Generator {
        $file = new \SplFileObject($pathToFile);
        $file->setFlags(\SplFileObject::DROP_NEW_LINE);
        while (! $file->eof()) {
            yield $file->fgets();
        }
    };
}
