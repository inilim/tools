<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @skip_build
 * @author inilim
 * @todo tests
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|resource
 */
function excelGetResourceByFileName($pathToFileOrZip, string $nameFile)
{
    \Inilim\Tool\Method\Assert\extPhp('zip');
    \Inilim\Tool\Method\Assert\stringNotEmpty($nameFile);

    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($zip, $nameFile) {
            // ZipArchive::FL_NODIR - исключает вхождение папок, ищет только имена файлов - Ignore directory component
            // ZipArchive::FL_NOCASE - регистронезависимый поиск - Ignore case on name lookup
            $index = $zip->locateName($nameFile, \ZipArchive::FL_NODIR);

            if (!\is_int($index)) {
                return null;
            }

            // ZipArchive::FL_UNCHANGED - Use original data, ignoring changes
            $resource = $zip->getStreamIndex($index);
            unset($index);

            if (!\is_resource($resource)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'ZipArchive()->getStreamIndex() failed',
                    $zip->filename,
                    -1
                );
                return null;
            }

            return $resource;
        },
        null
    );
}
