<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @deprecated use lines_v2()
 * Get the contents of a file one line at a time.
 * @return \Closure():\Generator<string>
 * @throws \InvalidArgumentException
 */
function lines(string $pathToFile): \Closure
{
    \Inilim\Tool\Method\Assert\file($pathToFile);

    return static function () use ($pathToFile): \Generator {
        $file = new \SplFileObject($pathToFile);
        $file->setFlags(\SplFileObject::DROP_NEW_LINE);
        while (! $file->eof()) {
            yield $file->fgets();
        }
    };
}
