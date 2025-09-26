<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @todo tests
 * @param string|\ZipArchive $zip path to file-zip OR ZipArchive object
 * @throws \Exception
 * @throws \InvalidArgumentException
 * @return list<array{name:string,index:int,crc:int,size:int,mtime:int,comp_size:int,comp_method:int,encryption_method:int}>
 */
function scan($zip): array
{
    return \iterator_to_array(\Inilim\Tool\Method\Zip\scanAsGenerator($zip), false);
}
