<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @ext zip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return ?\ZipArchive
 */
function getObjFrom($pathToFileOrZip): ?object
{
    \Inilim\Tool\Method\Assert\extPhp('zip');

    $type = \Inilim\Tool\Method\Other\getType($pathToFileOrZip);

    if ($type === 'string') {
        if (!\Inilim\Tool\Method\FS\isFile($pathToFileOrZip)) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
                'File "%s", not exist',
                $pathToFileOrZip,
            ), '', -1);
            return null;
        }
        /** @var string $pathToFileOrZip */
        $zip = \Inilim\Tool\Method\Zip\open($pathToFileOrZip);
        if (!$zip) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
                'File "%s", open failed',
                $pathToFileOrZip,
            ), '', -1);
            return null;
        }
    } elseif ($type === 'object') {
        if (!($pathToFileOrZip instanceof \ZipArchive)) {
            /** @var object $pathToFileOrZip */
            \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
                'Expected (arg #0) a string or \ZipArchive. Got: %s',
                \get_class($pathToFileOrZip)
            ), '', -1);
            return null;
        }
        $zip = $pathToFileOrZip;
        // TODO не помню зачем это
        if ($zip->filename === '') {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, 'Uninitialized zip', '', -1);
            return null;
        }
    } else {
        \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
            'Expected (arg #0) a string or \ZipArchive. Got: %s',
            $type
        ), '', -1);
        return null;
    }

    return $zip;
}
