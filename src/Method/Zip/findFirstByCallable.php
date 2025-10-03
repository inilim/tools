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
    foreach (\Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip) as $stat) {
        $t = $stat;
        if ($predicate($t) === true) {
            return $stat;
        }
    }
    return null;
}
