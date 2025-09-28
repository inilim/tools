<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|array{generator:\Generator<int,array<string,bool|string|int>>,info:array{}}
 */
function excelReadRowsById($pathToFileOrZip, string $id, int $countRows = 100, int $offset = 0)
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    \Inilim\Tool\Method\Assert\positiveInteger($countRows);
    \Inilim\Tool\Method\Assert\natural($offset);

    $anonObj = new class(
        \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip),
        $id,
        $countRows,
        $offset
    ) {
        var \ZipArchive $zip;
        var string $id;
        var int $countRows;
        var int $offset;
        var string $zipPathToFile;
        var string $zipHashPathToFile;
        var ?string $zipHashFile;
        var int $findCountRows = -1;
        var array $docs = [];
        var ?string $defineRange = null;

        function __construct(
            \ZipArchive $zip,
            string $id,
            int $countRows,
            int $offset
        ) {
            $this->id                = $id;
            $this->zip               = $zip;
            $this->countRows         = $countRows;
            $this->offset            = $offset;
            $this->zipPathToFile     = \Inilim\Tool\Method\Path\normalize($zip->filename);
            $this->zipHashPathToFile = \md5($this->zipPathToFile);
        }

        function getInfo(): array
        {
            return [
                'id' => $this->id,
                'offset' => $this->offset,
                'countRows' => $this->countRows,
                'defineRange' => $this->defineRange,
                'findCountRows' => $this->findCountRows,
                'pathToFileExcel' => $this->zipPathToFile,
            ];
        }

        function initZipHashFile()
        {
            // TODO большие файлы это долго
            $this->zipHashFile = \md5_file($this->zipPathToFile);
        }

        function __invoke(): bool
        {
            $resourceSheet = \Inilim\Tool\Method\Exp\excelGetResourceSheetById($this->zip, $this->id);
            if ($resourceSheet === null) {
                return false;
            }
            $metadata = \stream_get_meta_data($resourceSheet);
            $nameSheet = \Inilim\Tool\Method\Path\normalize($metadata['uri']);
            unset($metadata);

            // ---------------------------------------------
            // sharedStrings.xml
            // ---------------------------------------------

            $resourceSharedStrings = $this->findSharedStrings();
            if ($resourceSharedStrings === null) {
                return false;
            }
            $metadata = \stream_get_meta_data($resourceSharedStrings);
            $nameSharedStrings = \Inilim\Tool\Method\Path\normalize($metadata['uri']);
            unset($metadata);

            // ---------------------------------------------
            // ресурсы в временные файлы
            // ---------------------------------------------

            $tmpDir      = \sys_get_temp_dir();
            $fileInfo    = \Inilim\Tool\Method\Path\normalize($tmpDir . '/inilim-tools-excel-' . $this->zipHashPathToFile . '.xml.tmp');
            $this->initZipHashFile();

            if (\Inilim\Tool\Method\FS\isFile($fileInfo)) {
                // Читаем
                $doc = \Inilim\Tool\Method\Xml\loadFile($fileInfo);

                if ($doc === null || $this->changedExcelFile($doc)) {
                    goto createInfo;
                }

                $xpath = new \DOMXpath($doc);

                $pathToFileSheetTmp         = $this->queryFileByFileHash($xpath, \md5($nameSheet));
                $pathToFileSharedStringsTmp = $this->queryFileByFileHash($xpath, \md5($nameSharedStrings));
                unset($xpath);

                if (
                    $pathToFileSheetTmp === null ||
                    $pathToFileSharedStringsTmp === null
                ) {
                    goto createInfo;
                }
            } else {
                createInfo:
                // Создаем
                [$doc, $root] = $this->createDocWithRoot();
                $this->createElAndAppendToRootDoc($root, 'zip', [
                    'path_to_file' => $this->zipPathToFile,
                    'hash_path_to_file' => $this->zipHashPathToFile,
                    'hash_file' => $this->zipHashFile,
                ]);

                $hash = \md5($nameSheet);
                $pathToFileSheetTmp = $tmpDir . '/inilim-tools-excel-' . $hash . '.xml.tmp';
                $this->createElAndAppendToRootDoc($root, 'item', [
                    'path_to_file' => $pathToFileSheetTmp,
                    'hash_path_to_file' => $hash,
                ]);

                $hash = \md5($nameSharedStrings);
                $pathToFileSharedStringsTmp = $tmpDir . '/inilim-tools-excel-' . $hash . '.xml.tmp';
                $this->createElAndAppendToRootDoc($root, 'item', [
                    'path_to_file' => $pathToFileSharedStringsTmp,
                    'hash_path_to_file' => $hash,
                ]);

                unset($hash, $nameSharedStrings, $nameSheet);

                if (!$this->resourceToFile($resourceSheet, $pathToFileSheetTmp)) {
                    \fclose($resourceSheet);
                    return false;
                }
                if (!$this->resourceToFile($resourceSharedStrings, $pathToFileSharedStringsTmp)) {
                    \fclose($resourceSharedStrings);
                    return false;
                }
                \fclose($resourceSheet);
                \fclose($resourceSharedStrings);

                $doc->save($fileInfo);
            }
            unset($fileInfo, $tmpDir, $zipFileName, $doc, $root);

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            /** 
             * @var string $pathToFileSheetTmp
             * @var string $pathToFileSharedStringsTmp
             */

            $sheetDoc = new \DOMDocument;
            $sheetDoc->load($pathToFileSheetTmp);
            $sharedStrsDoc = new \DOMDocument;
            $sharedStrsDoc->load($pathToFileSharedStringsTmp);

            $this->docs = [$sheetDoc, $sharedStrsDoc];
            $rows = $sheetDoc->getElementsByTagName('row');
            $this->findCountRows = $rows->count();
            $this->defineRange = $this->defineRange($rows);

            return true;
        }

        function defineRange(\DOMNodeList $rows): string
        {
            $firstRow = $rows->item(0);
            $firstRow = \Inilim\Tool\Method\Xml\toXml($firstRow);
            // <c r="Z2" s="2" t="n">
            \preg_match_all('#\<c.*?r=\"([a-z]+\d+)\"#i', $firstRow, $matches);
            $matches = $matches[1] ?? [];
            if (\sizeof($matches) === 1) {
                $start = $matches[0];
                $end = $matches[0];
            } else {
                $start = \Inilim\Tool\Method\PF\array_first($matches);
                $end = \Inilim\Tool\Method\PF\array_last($matches);
            }

            return $start . ':' . $end;
        }

        function getGenerator(): \Generator
        {
            [$sheetDoc, $sharedStrsDoc] = $this->docs;
            /** @var \DOMDocument $sheetDoc */
            /** @var \DOMDocument $sharedStrsDoc */
            $this->docs = [];

            $rows = $sheetDoc->getElementsByTagName('row');

            $countRows = 0;
            $offset = $this->offset;
            foreach ($rows as $idxRow => $row) {
                if ($offset > 0) {
                    $offset--;
                    continue;
                }

                $cells = $row->getElementsByTagName('c');
                $resultCell = [];
                foreach ($cells as $cell) {
                    $type = $cell->getAttribute('t');
                    $cellId = $cell->getAttribute('r');
                    if ($type === 's') {
                        // Строка в шаред
                        $strIdx = $cell->getElementsByTagName('v');
                        $strIdx = $strIdx->item(0);
                        $strIdx = $strIdx->textContent;
                        $str = $sharedStrsDoc->getElementsByTagName('t')->item((int)$strIdx)->textContent;
                        $resultCell[$cellId] = $str;
                    } elseif ($type === 'e') {
                        // error
                        $resultCell[$cellId] = \Inilim\Tool\Method\Xml\toXml($cell);
                    } elseif ($type === 'b') {
                        // bool значение
                        $value = $cell->getElementsByTagName('v');
                        $value = $value->item(0);
                        $resultCell[$cellId] = (bool)$value->textContent;
                    } elseif ($type === 'n') {
                        // Число
                        $value = $cell->getElementsByTagName('v');
                        $value = $value->item(0);
                        $resultCell[$cellId] = (int)$value->textContent;
                    } elseif ($type === '') {
                        // пустая ячейка
                        $resultCell[$cellId] = '';
                    } else {
                        de([
                            'type',
                            $type
                        ]);
                    }
                } // endforeach(cells)

                yield $idxRow => [
                    'rows' => $resultCell,
                    'xmlRow' => \Inilim\Tool\Method\Xml\toXml($row),
                    'countCell' => $cells->count()
                ];

                $countRows++;

                if ($countRows >= $this->countRows) {
                    break;
                }
            } // endforeach(rows)
        }

        function changedExcelFile(\DOMDocument $info): bool
        {
            return $info->getElementsByTagName('zip')->item(0)->getAttribute('hash_file') !== $this->zipHashFile;
        }

        /**
         * @return resource|null
         */
        function findSharedStrings()
        {
            // TODO может есть excel файлы в котором нету sharedStrings.xml?
            $find = \Inilim\Tool\Method\Zip\findFirstResourceByCallable($this->zip, static function ($stat) {
                // TODO регистр?
                if (\basename($stat['name']) === 'sharedStrings.xml') {
                    return true;
                }
            });

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found "sharedStrings.xml" from archive',
                    $this->zipPathToFile,
                    -1
                );
                return null;
            }

            return $find;
        }

        function queryFileByFileHash(\DOMXpath $xpath, string $fileHash): ?string
        {
            $result = $xpath->query('//*[local-name()="item"][@hash_path_to_file="' . $fileHash . '"]');
            if ($result === false || $result->count() !== 1) {
                return null;
            }
            $result = \iterator_to_array($result->getIterator(), false)[0];
            /** @var \DOMNode|\DOMNameSpaceNode $result */
            $attr = $result->attributes->getNamedItem('path_to_file');
            if ($attr === null) {
                return null;
            }
            $pathToFile = $attr->value;
            if (!\Inilim\Tool\Method\FS\isFile($pathToFile)) {
                return null;
            }
            return $pathToFile;
        }

        /**
         * @param resource $resource
         */
        function resourceToFile($resource, string $pathToFile): bool
        {
            if (!\Inilim\Tool\Method\Other\resourceContentWriteToFile($resource, $pathToFile)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('Не удалось перевести ресурс в файл "%s"', $pathToFile),
                    $this->zipPathToFile,
                    -1
                );
                return false;
            }
            return true;
        }

        /**
         * @param array<string,string> $attrs
         */
        function createElAndAppendToRootDoc(\DOMNode $root, string $nameEl, array $attrs = []): ?\DOMElement
        {
            try {
                $itemEl = $root->ownerDocument->createElement($nameEl);
            } catch (\Throwable $e) {
                return null;
            }
            if ($itemEl === false) {
                return null;
            }
            foreach ($attrs as $name => $value) {
                $itemEl->setAttribute($name, $value);
            }
            $root->appendChild($itemEl);
            return $itemEl;
        }

        /**
         * @return null|array{0:\DOMDocument,1:\DOMNode}
         */
        function createDocWithRoot(): ?array
        {
            $doc = new \DOMDocument;
            try {
                $el = $doc->createElement('root');
            } catch (\Throwable $e) {
                return null;
            }
            if ($el === false) {
                return null;
            }
            return [$doc, $doc->appendChild($el)];
        }
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => $anonObj->__invoke(),
        static function () {
            d(func_get_args());
        }
    );
    /** @var null|bool $result */

    if ($result === true) {
        return [
            'generator' => $anonObj->getGenerator(),
            'info'      => $anonObj->getInfo()
        ];
    }
    return null;
}
