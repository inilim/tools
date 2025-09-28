<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @param callable(ZipStatItem):bool $predicate
 * @return null|resource
 */
function findFirstResourceByCallable($pathToFileOrZip, callable $predicate)
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    $find = \Inilim\Tool\Method\Zip\findFirstByCallable($zip, $predicate);
    if ($find === null) {
        return null;
    }
    return \Inilim\Tool\Method\Zip\getResourceByIdx($zip, $find['index']);
}
