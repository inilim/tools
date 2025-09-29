<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 */
function excelRemoveTmpFiles($pathToFileOrZip): int
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    $zipPathToFile = \Inilim\Tool\Method\Path\normalize($zip->filename);
    unset($zip);
    $fileInfo = \Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir() . '/inilim-tools-excel-' . \md5($zipPathToFile) . '.tmp');

    if (!\Inilim\Tool\Method\FS\isFile($fileInfo)) {
        return 0;
    }

    $count = 0;
    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($fileInfo, &$count) {
            $aInfo = \Inilim\Tool\Method\File\json($fileInfo);
            if (!\is_array($aInfo) || !\is_array($aInfo['item'] ?? null)) {
                $count++;
                \Inilim\Tool\Method\File\delete($fileInfo);
                return;
            }
            $items = $aInfo['item'];
            unset($aInfo);
            $count = 0;
            $files = [];
            foreach ($items as $item) {
                $file = (string)$item['path_to_file'] ?? '';
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
