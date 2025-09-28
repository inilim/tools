<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Param_1_excelGetSheetsInfo from \TypeExp
 * @author inilim
 * @todo tests
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|Param_1_excelGetSheetsInfo[]
 */
function excelGetSheetsInfo($pathToFileOrZip): ?array
{
    \Inilim\Tool\Method\Assert\extPhp('dom');

    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($zip) {

            $zipPathToFile = \Inilim\Tool\Method\Path\normalize($zip->filename);

            $workbook = \Inilim\Tool\Method\Zip\findFirstByCallable($zip, static function ($stat) {
                // TODO регистр?
                if (\basename($stat['name']) === 'workbook.xml') {
                    return true;
                }
            });

            if (!$workbook) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found "workbook.xml" from archive',
                    $zipPathToFile,
                    -1
                );
                return null;
            }

            $resource = \Inilim\Tool\Method\Zip\getResourceByIdx($zip, $workbook['index']);

            if ($resource === null) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('Zip::getResourceByIdx("%s", %s) failed', $zipPathToFile, $workbook['index']),
                    $zipPathToFile,
                    -1
                );
                return null;
            }
            unset($workbook);

            // TODO может стоит всетаки не читать все, а сохранить во временный файл и загружать из файла
            $content = \stream_get_contents($resource);
            \fclose($resource);
            unset($resource);

            if (!\is_string($content)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'stream_get_contents() failed',
                    $zipPathToFile,
                    -1
                );
                return null;
            }

            $docWorkbook = new \DOMDocument();
            if ($docWorkbook->loadXML($content) !== true) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'DOMDocument()->loadXML() failed',
                    $zipPathToFile,
                    -1
                );
                return null;
            }
            unset($content);

            ['list' => $search] = \Inilim\Tool\Method\Xml\xpathQueryFromDoc(
                $docWorkbook,
                '//*[local-name()="sheet"]'
            );
            unset($docWorkbook);
            if ($search === null) {
                return null;
            }

            $search = \Inilim\Tool\Method\Xml\domToArray($search);
            $results = [];
            foreach ($search as $item) {
                $results[] = [
                    'id'      => $item['attributes']['id'] ?? null,
                    'name'    => $item['attributes']['name'] ?? null,
                    'state'   => $item['attributes']['state'] ?? null,
                    // 'sheetId' => $item['attributes']['sheetId'] ?? null,
                ];
            }

            return $results;
        },
        null
    );

    return $result;
}
