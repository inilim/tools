<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
function findByNameFile($pathToFileOrZip, string $fileName, bool $partialMatch = false, bool $ignoreCase = false): array
{
    $needle = \Inilim\Tool\Method\Path\normalize($fileName);

    $predicate = static function ($fileItem) use ($needle, $partialMatch, $ignoreCase) {
        /** @var ZipStatItem $fileItem */
        $nameItem = \Inilim\Tool\Method\Path\normalize($fileItem['name']);
        if ($partialMatch) {
            return \Inilim\Tool\Method\Str\contains($nameItem, $needle, $ignoreCase);
        } else {
            if ($ignoreCase) {
                return \Inilim\Tool\Method\Str\casecmp($needle, $nameItem, 'UTF-8') === 0;
            }
            return $needle === $nameItem;
        }
    };

    return \iterator_to_array(
        \Inilim\Tool\Method\Zip\findByFilterAsGenerator($pathToFileOrZip, $predicate),
        false
    );
}
