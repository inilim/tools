<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return ?\Generator<int,TYPE_ZIP_STAT_ITEM>
 * @throws \InvalidArgumentException
 * @ext zip
 */
function scanAsGenerator($pathToFileOrZip): ?\Generator
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    if (null === $zip) {
        return null;
    }
    $num = $zip->numFiles;
    for ($i = 0; $i < $num; $i++) {
        $ri = $zip->statIndex($i, \ZipArchive::FL_UNCHANGED);
        if (false === $ri) {
            continue;
        }
        yield $ri;
    }
}
