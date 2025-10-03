<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Return_extractByCallable from \TypeZip
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param ?string $dir default sys_get_temp_dir()
 * @param callable(ZipStatItem):bool $predicate
 * @return ?Return_extractByCallable
 */
function extractByCallable($pathToFileOrZip, callable $predicate, ?string $dir = null): ?array
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);

    $procedure = static function () use ($zip, $predicate, $dir) {
        if ($dir !== null) {
            $_dir = \realpath($dir);
            if ($_dir === false) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('Dir "%s" not exist', $dir),
                    '',
                    -1
                );
                return null;
            }
        } else {
            $_dir = \sys_get_temp_dir();
        }

        $results = [];
        foreach (\Inilim\Tool\Method\Zip\scanAsGenerator($zip) as $stat) {
            /** @var ZipStatItem $stat */
            $t = $stat;
            if ($predicate($t) !== true) {
                continue;
            }
            $t = null;

            $resource = \Inilim\Tool\Method\Zip\getResourceByIdx($zip, $stat['index']);
            if (!$resource) {
                $stat['status'] = false;
                $results[] = $stat;
                continue;
            }
            $pathToFile = $_dir . '/inilim-tools-zip-' . \Inilim\Tool\Method\ID\uuidv7() . '.tmp';
            if (!\Inilim\Tool\Method\Other\resourceContentWriteToFile($resource, $pathToFile)) {
                $stat['status'] = false;
                $results[] = $stat;
                continue;
            }

            $stat['status'] = true;
            $stat['path_to_file'] = $pathToFile;
            $results[] = $stat;
        } // endforeach

        return $results;
    };

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler($procedure, null);
}
