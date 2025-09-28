<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
function scan($pathToFileOrZip): array
{
    return \iterator_to_array(
        \Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip),
        false
    );
}
