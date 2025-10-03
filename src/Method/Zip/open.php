<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @ext zip
 * \ZipArchive::open()
 * @see https://www.php.net/manual/en/ziparchive.open.php
 */
function open(string $filename, int $flags = 0): ?\ZipArchive
{
    \Inilim\Tool\Method\Assert\extPhp('zip');

    $_filename = \Inilim\Tool\Method\Path\realPath($filename);
    if (!$_filename) {
        \Inilim\Tool\Method\Other\__setErrorLast(
            -1,
            'File not found',
            $filename,
            -1
        );
        return null;
    }
    $_filename = \Inilim\Tool\Method\Path\normalize($_filename);
    $zip = new \ZipArchive;
    $status = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => $zip->open($_filename, $flags),
        null
    );
    if ($status !== true) {
        if (\is_int($status)) {
            $errors = [
                \ZipArchive::ER_EXISTS => 'File already exists',
                \ZipArchive::ER_INCONS => 'Zip archive inconsistent',
                \ZipArchive::ER_INVAL  => 'Invalid argument',
                \ZipArchive::ER_MEMORY => 'Memory allocation failure',
                \ZipArchive::ER_NOENT  => 'No such file',
                \ZipArchive::ER_NOZIP  => 'Not a zip archive',
                \ZipArchive::ER_OPEN   => 'Can\'t open file',
                \ZipArchive::ER_READ   => 'Read error',
                \ZipArchive::ER_SEEK   => 'Seek error',
            ];
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                $errors[$status] ?? 'Zip open failed',
                $filename,
                -1
            );
        } else {
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                'Zip open failed',
                $filename,
                -1
            );
        }
        return null;
    }

    return $zip;
}
