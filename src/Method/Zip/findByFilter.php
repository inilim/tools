<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(ZipStatItem):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
function findByFilter($pathToFileOrZip, callable $predicate, $valueBreak = null): ?array
{
    $gen = \Inilim\Tool\Method\Zip\findByFilterAsGenerator($pathToFileOrZip, $predicate, $valueBreak);
    if ($gen === null) {
        return null;
    }
    return \iterator_to_array($gen, false);
}
