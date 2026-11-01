<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @throws \InvalidArgumentException
 * @return ?TYPE_ZIP_STAT_ITEM
 */
function findFirstByCallable($source, callable $predicate): ?array
{
    $gen = \Inilim\Tool\Method\Zip\scanAsGenerator($source);
    if (null === $gen) {
        return null;
    }
    foreach ($gen as $stat) {
        $t = $stat;
        if ($predicate($t) === true) {
            return $stat;
        }
    }
    return null;
}
