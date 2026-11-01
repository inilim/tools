<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return \Generator<int,TYPE_ZIP_STAT_ITEM>
 */
function findByFilterAsGenerator($source, callable $predicate, $valueBreak = null): ?\Generator
{
    $gen = \Inilim\Tool\Method\Zip\scanAsGenerator($source);
    if (null === $gen) {
        return null;
    }
    foreach ($gen as $stat) {
        $t = $stat;
        $v = $predicate($t);
        if ($v === $valueBreak) return;
        if ($v === true) {
            yield $stat;
        }
    }
}
