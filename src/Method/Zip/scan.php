<?php

namespace Inilim\Tool\Method\Zip;

/**
 * @todo tests
 * @param string|\ZipArchive $zip path to file-zip OR ZipArchive object
 * @throws \ValueError
 * @throws \RuntimeException
 * @return list<array{name:string,index:int,crc:int,size:int,mtime:int,comp_size:int,comp_method:int,encryption_method:int}>
 */
function scan($zip)
{
    if (!\Inilim\Tool\Method\Zip\__state()->existsExtZipArchive) {
        throw new \RuntimeException('ext "zip" not found');
    }

    if (\is_string($zip)) {
        $rp = \realpath($zip);
        if (!$rp) {
            throw new \ValueError(\sprintf(
                'File "%s", not found',
                $zip
            ));
        }
        $rp     = \Inilim\Tool\Method\Path\normalizePath($rp);
        $zip    = new \ZipArchive;
        $status = $zip->open($rp, \ZipArchive::RDONLY);
        if ($status !== true) {
            throw new \ValueError(\sprintf(
                'File "%s", not open. Code: %s',
                $rp,
                $status === false ? 'false' : $status
            ));
        }
    } elseif ($zip->filename === '') {
        throw new \ValueError('Uninitialized zip');
    }

    $result = [];
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $ri = $zip->statIndex($i);
        if ($ri === false) {
            continue;
        }
        $result[] = $ri;
    }

    return $result;
}
