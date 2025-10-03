<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return \Generator<int,ZipStatItem>
 * @throws \InvalidArgumentException
 */
function scanAsGenerator($pathToFileOrZip): \Generator
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    $num = $zip->numFiles;
    for ($i = 0; $i < $num; $i++) {
        $ri = $zip->statIndex($i, \ZipArchive::FL_UNCHANGED);
        if ($ri === false) {
            continue;
        }
        yield $ri;
    }
}
