<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @ext zip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 */
function getObjFrom($pathToFileOrZip): \ZipArchive
{
    \Inilim\Tool\Method\Assert\extPhp('zip');

    $type = \Inilim\Tool\Method\Other\getType($pathToFileOrZip);

    if ($type === 'string') {
        /** @var string $pathToFileOrZip */
        $zip = \Inilim\Tool\Method\Zip\open($pathToFileOrZip);
        if (!$zip) {
            throw new \InvalidArgumentException(\sprintf(
                'File "%s", not open',
                $pathToFileOrZip,
            ));
        }
    } elseif ($type === 'object') {
        if (!($pathToFileOrZip instanceof \ZipArchive)) {
            /** @var object $pathToFileOrZip */
            throw new \InvalidArgumentException(\sprintf(
                'Expected (arg #0) a string or \ZipArchive. Got: %s',
                \get_class($pathToFileOrZip)
            ));
        }
        $zip = $pathToFileOrZip;
        // TODO не помню зачем это
        if ($zip->filename === '') {
            throw new \InvalidArgumentException('Uninitialized zip');
        }
    } else {
        throw new \InvalidArgumentException(\sprintf(
            'Expected (arg #0) a string or \ZipArchive. Got: %s',
            $type
        ));
    }

    return $zip;
}
