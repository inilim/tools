<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file one line at a time.
 * @return \Generator<int,string>
 * @throws \InvalidArgumentException
 */
function lines_v2(string $pathToFile, int $startLine = 0): \Generator
{
    \Inilim\Tool\Method\Assert\file($pathToFile);
    if ($startLine !== 0) {
        \Inilim\Tool\Method\Assert\positiveInteger($startLine);
    }
    $file = new \SplFileObject($pathToFile);
    $file->setFlags(\SplFileObject::DROP_NEW_LINE);

    if ($startLine !== 0) {
        $file->seek($startLine);
    }

    while (! $file->eof()) {
        yield $file->fgets();
    }
}
