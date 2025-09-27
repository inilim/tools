<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|(array{name:null|string,sheetId:null|string,state:null|string,id:null|string})[]
 */
function excelGetSheetNames($pathToFileOrZip): ?array
{
    \Inilim\Tool\Method\Assert\extPhp('zip');
    \Inilim\Tool\Method\Assert\extPhp('dom');

    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($zip) {

            $workbook = null;
            \Inilim\Tool\Method\Other\iteratorToDevNull(
                \Inilim\Tool\Method\Zip\findByFilterAsGenerator($zip, static function ($stat) use (&$workbook) {
                    // TODO регистр?
                    if (\basename($stat['name']) === 'workbook.xml') {
                        $workbook = $stat;
                        return null;
                    }
                    return true;
                })
            );

            if (!$workbook) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found "workbook.xml" from zip',
                    $zip->filename,
                    -1
                );
                return null;
            }

            // ZipArchive::FL_UNCHANGED - Use original data, ignoring changes
            $resource = $zip->getStreamIndex($workbook['index'], \ZipArchive::FL_UNCHANGED);
            unset($workbook);

            if (!\is_resource($resource)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'ZipArchive()->getStreamIndex() failed',
                    $zip->filename,
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
                    $zip->filename,
                    -1
                );
                return null;
            }

            $docWorkbook = new \DOMDocument();
            if ($docWorkbook->loadXML($content) !== true) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'DOMDocument()->loadXML() failed',
                    $zip->filename,
                    -1
                );
                return null;
            }
            unset($content);

            $xpath = new \DOMXpath($docWorkbook);
            $search = $xpath->query('//*[local-name()="sheet"]');

            if (\is_bool($search)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'DOMXpath()->query() failed',
                    $zip->filename,
                    -1
                );
                return null;
            }

            $results = [];
            foreach (\Inilim\Tool\Method\Xml\domToArray($search) as $item) {
                $results[] = [
                    'name'    => $item['attributes']['name'] ?? null,
                    'sheetId' => $item['attributes']['sheetId'] ?? null,
                    'state'   => $item['attributes']['state'] ?? null,
                    'id'      => $item['attributes']['id'] ?? null,
                ];
            }

            return $results;
        },
        null
    );

    return $result;
}
