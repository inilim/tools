<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @ext zip
 * @todo tests
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @return ?\ZipArchive
 */
function getObjFrom($source): ?object
{
    \Inilim\Tool\Method\Assert\extPhp('zip');

    $type = \Inilim\Tool\Method\Other\getType($source);

    if ($type === 'string') {
        if (!\Inilim\Tool\Method\FS\isFile($source)) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
                'File "%s", not exist',
                $source,
            ), '', -1);
            return null;
        }
        /** @var string $source */
        $zip = \Inilim\Tool\Method\Zip\open($source);
        if (null === $zip) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
                'File "%s", open failed',
                $source,
            ), '', -1);
            return null;
        }
    } elseif ($type === 'object') {
        if (!($source instanceof \ZipArchive)) {
            /** @var object $source */
            \Inilim\Tool\Method\Other\__setErrorLast(-1, \sprintf(
                'Expected (arg #0) a string or \ZipArchive. Got: %s',
                \get_class($source)
            ), '', -1);
            return null;
        }
        $zip = $source;
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
