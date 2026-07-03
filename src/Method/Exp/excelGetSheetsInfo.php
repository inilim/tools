<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @psalm-import-type Param_1_excelGetSheetsInfo from \TypeExp
 * @author inilim
 * @todo tests
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|Param_1_excelGetSheetsInfo[]
 */
function excelGetSheetsInfo($pathToFileOrZip): ?array
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    if ($zip === null) {
        return null;
    }
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($zip) {
            $zipPathToFile = \Inilim\Tool\Method\Path\normalize($zip->filename);

            $resource = \Inilim\Tool\Method\Zip\findFirstResourceByCallable($zip, static function ($stat) {
                if (\strtolower(\basename($stat['name'])) === 'workbook.xml') {
                    return true;
                }
            });

            if (!$resource) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found file "workbook.xml" from archive',
                    $zipPathToFile,
                    -1
                );
                return null;
            }

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

            // ---------------------------------------------
            // regex parse
            // ---------------------------------------------

            // <sheet name="ДП" sheetId="2" r:id="rId13"/>
            $matchRes = \preg_match_all(
                '/' .
                    '<sheet\s[^>]*>' .
                    '/i',
                $content,
                $matchSheet
            );

            if (!\is_int($matchRes)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'preg_match_all(<sheet/>) failed',
                    $zipPathToFile,
                    -1
                );
                return null;
            }

            if ($matchRes === 0) {
                return [];
            }

            $matchSheet = $matchSheet[0];
            $matchSheet = \Inilim\Tool\Method\PF\array_filter($matchSheet);

            // de($matchSheet);

            // ---------------------------------------------
            // regex parse item sheet tag
            // ---------------------------------------------

            $results = [];
            foreach ($matchSheet as $sheetTag) {
                // 
                $matchRes = \preg_match_all(
                    '/' .
                        '([a-z:]+)="([^"]*)"' .
                        '/i',
                    $sheetTag,
                    $match
                );

                if (!\is_int($matchRes) || $matchRes === 0) {
                    continue;
                }

                $match = \array_combine($match[1] ?? [], $match[2] ?? []);
                if (
                    $match === false ||
                    !\is_string($match['r:id'] ?? null) ||
                    !\is_string($match['name'] ?? null)
                ) {
                    continue;
                }

                $results[] = [
                    'id'      => $match['r:id'],
                    'name'    => $match['name'],
                    'state'   => $match['state'] ?? null,
                    // 'sheetId' => $match['sheetId'] ?? null,
                ];
            }

            return $results;
        },
        null
    );

    return $result;
}
