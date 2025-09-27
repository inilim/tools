<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @ext zip dom
 * @param string|\ZipArchive $pathToFileOrZip
 */
function excelRemoveTmpFiles($pathToFileOrZip): int
{
    \Inilim\Tool\Method\Assert\extPhp('dom');

    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    $zipPathToFile = \Inilim\Tool\Method\Path\normalize($zip->filename);
    unset($zip);
    $fileInfo = \Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir() . '/inilim-tools-' . \md5($zipPathToFile) . '.xml.tmp');

    if (!\Inilim\Tool\Method\FS\isFile($fileInfo)) {
        return 0;
    }

    $count = 0;
    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($fileInfo, &$count) {
            $doc = new \DOMDocument;
            if ($doc->load($fileInfo) === false) {
                return;
            }
            $items = $doc->getElementsByTagName('item');
            unset($doc);
            $count = 0;
            $files = [];
            foreach ($items as $item) {
                $file = $item->getAttribute('path_to_file');
                if (\Inilim\Tool\Method\FS\isFile($file)) {
                    $files[] = $file;
                    $count++;
                }
            }
            unset($items, $item, $file);
            $files[] = $fileInfo;
            $count++;
            \Inilim\Tool\Method\File\delete($files);
        },
        null
    );

    return $count;
}
