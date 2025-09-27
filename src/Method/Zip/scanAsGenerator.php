<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return \Generator<int,ZipStatItem>
 * @throws \InvalidArgumentException
 */
function scanAsGenerator($pathToFileOrZip): \Generator
{
    \Inilim\Tool\Method\Assert\extPhp('zip');

    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);

    for ($i = 0; $i < $zip->numFiles; $i++) {
        $ri = $zip->statIndex($i);
        if ($ri === false) {
            continue;
        }
        yield $ri;
    }
}
