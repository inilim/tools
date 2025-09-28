<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @todo tests
 * @return null|resource
 */
function getResourceByIdx(\ZipArchive $zip, int $idx)
{
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($zip, $idx) {
            if (\Inilim\Tool\Method\Check\php80()) {
                // INFO ZipArchive::FL_UNCHANGED - Use original data, ignoring changes
                $resource = $zip->getStreamIndex($idx, \ZipArchive::FL_UNCHANGED);
            } else {
                $stat = $zip->statIndex($idx);
                if ($stat === false) {
                    return null;
                }
                $resource = $zip->getStream($stat['name']);
            }


            if ($resource === false) {
                return null;
            }
            return $resource;
        },
        null
    );
}
