<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @todo tests
 * @param string|\ZipArchive $zip path to file-zip OR ZipArchive object
 * @throws \Exception
 * @throws \InvalidArgumentException
 * @return \Generator<int,array{name:string,index:int,crc:int,size:int,mtime:int,comp_size:int,comp_method:int,encryption_method:int}>
 */
function scanAsGenerator($zip): \Generator
{
    \Inilim\Tool\Method\Assert\extPhp('zip');

    if (\is_string($zip)) {
        $zip = \Inilim\Tool\Method\Zip\open($zip, \ZipArchive::RDONLY);
        if (!$zip) {
            throw new \Exception(\sprintf(
                'File "%s", not open',
                $zip,
            ));
        }
    } elseif ($zip->filename === '') {
        throw new \Exception('Uninitialized zip');
    }

    for ($i = 0; $i < $zip->numFiles; $i++) {
        $ri = $zip->statIndex($i);
        if ($ri === false) {
            continue;
        }
        yield $ri;
    }
}
