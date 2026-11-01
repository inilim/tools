<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @throws \InvalidArgumentException
 * @return TYPE_ZIP_STAT_ITEM[]
 */
function findAllByCallable($pathToFileOrZip, callable $predicate): ?array
{
    $gen = \Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip);
    if ($gen === null) {
        return null;
    }
    $results = [];
    foreach ($gen as $stat) {
        $t = $stat;
        if ($predicate($t) === true) {
            $results[] = $stat;
        }
    }
    return $results;
}
