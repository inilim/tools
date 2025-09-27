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
 * @return \Generator<int,ZipStatItem>
 */
function findByFilterAsGenerator($pathToFileOrZip, callable $predicate, $valueBreak = null): \Generator
{
    foreach (\Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip) as $fileItem) {
        $v = $predicate($fileItem);
        if ($v === $valueBreak) return;
        if ($v) {
            yield $fileItem;
        }
    }
}
