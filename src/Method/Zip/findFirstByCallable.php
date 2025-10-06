<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(ZipStatItem):bool $predicate
 * @throws \InvalidArgumentException
 * @return null|ZipStatItem
 */
function findFirstByCallable($pathToFileOrZip, callable $predicate): ?array
{
    $gen = \Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip);
    if ($gen === null) {
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
