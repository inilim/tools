<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @ext zip
 * @param string|\ZipArchive $source
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @return null|resource
 */
function findFirstResourceByCallable($source, callable $predicate)
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($source);
    if (null === $zip) {
        return null;
    }
    $find = \Inilim\Tool\Method\Zip\findFirstByCallable($zip, $predicate);
    if (null === $find) {
        return null;
    }
    return \Inilim\Tool\Method\Zip\getResourceByIdx($zip, $find['index']);
}
