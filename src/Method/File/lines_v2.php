<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file one line at a time.
 * @return \Generator<int,string>
 * @throws \InvalidArgumentException
 */
function lines_v2(string $pathToFile): \Generator
{
    \Inilim\Tool\Method\Assert\file($pathToFile);
    $file = new \SplFileObject($pathToFile);
    $file->setFlags(\SplFileObject::DROP_NEW_LINE);
    while (! $file->eof()) {
        yield $file->fgets();
    }
}
