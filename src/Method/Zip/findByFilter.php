<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return TYPE_ZIP_STAT_ITEM[]
 */
function findByFilter($pathToFileOrZip, callable $predicate, $valueBreak = null): ?array
{
    $gen = \Inilim\Tool\Method\Zip\findByFilterAsGenerator($pathToFileOrZip, $predicate, $valueBreak);
    if ($gen === null) {
        return null;
    }
    return \iterator_to_array($gen, false);
}
