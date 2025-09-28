<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(ZipStatItem):bool $predicate
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
function findAllByCallable($pathToFileOrZip, callable $predicate): array
{
    $results = [];
    foreach (\Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip) as $stat) {
        if ($predicate($stat) === true) {
            $results[] = $stat;
        }
    }
    return $results;
}
