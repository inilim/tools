<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return TYPE_ZIP_STAT_ITEM[]
 */
function scan($source): ?array
{
    $gen = \Inilim\Tool\Method\Zip\scanAsGenerator($source);
    if (null === $gen) {
        return null;
    }
    return \iterator_to_array($gen, false);
}
