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
    \Inilim\Tool\Method\Assert\extPhp('zip');
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
            $this->zipHashFile = \md5_file($this->zipPathToFile);
        }

        function __invoke(): bool
        {
            $resourceWorkbookRels = $this->findWorkbookRels();
            if ($resourceWorkbookRels === null) {
                return false;
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $docWorkbookRels = $this->resourceWorkbookRelsToXml($resourceWorkbookRels);
            unset($resourceWorkbookRels);
            if ($docWorkbookRels === null) {
                return false;
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $target = $this->findAttrTargetFromXml($docWorkbookRels);
            unset($docWorkbookRels);
            if ($target === null) {
                return false;
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $find = $this->findStatItemFromZipByAttr($target);
            unset($target);
            if ($find === null) {
                return false;
            }

            // ---------------------------------------------
            // лист
            // ---------------------------------------------

            $resourceSheet = $this->getResourceFromZipByIdx($find['index']);
            if ($resourceSheet === null) {
                return false;
            }
            $nameSheet = \Inilim\Tool\Method\Path\normalize($find['name']);
            unset($find);

            // ---------------------------------------------
            // sharedStrings.xml
            // ---------------------------------------------

            $find = $this->findSharedStrsStatItemFromZip();
            if ($find === null) {
                return false;
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $resourceSharedStrings = $this->getResourceFromZipByIdx($find['index']);
            if ($resourceSharedStrings === null) {
                return false;
            }
            $nameSharedStrings = \Inilim\Tool\Method\Path\normalize($find['name']);
            unset($find);


            // ---------------------------------------------
            // ресурсы в временные файлы
            // ---------------------------------------------

            $tmpDir      = \sys_get_temp_dir();
            $fileInfo    = \Inilim\Tool\Method\Path\normalize($tmpDir . '/inilim-tools-' . $this->zipHashPathToFile . '.xml.tmp');
            $this->initZipHashFile();

            if (\Inilim\Tool\Method\FS\isFile($fileInfo)) {
                // Читаем
                [$doc, $root] = $this->createDocWithRoot();
                $doc->load($fileInfo);

                if ($this->changedExcelFile($doc)) {
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
                $pathToFileSheetTmp = $tmpDir . '/inilim-tools-' . $hash . '.xml.tmp';
                $this->createElAndAppendToRootDoc($root, 'item', [
                    'path_to_file' => $pathToFileSheetTmp,
                    'hash_path_to_file' => $hash,
                ]);

                $hash = \md5($nameSharedStrings);
                $pathToFileSharedStringsTmp = $tmpDir . '/inilim-tools-' . $hash . '.xml.tmp';
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
        function findWorkbookRels()
        {
            $find = null;
            \Inilim\Tool\Method\Other\iteratorToDevNull(
                \Inilim\Tool\Method\Zip\findByFilterAsGenerator($this->zip, static function ($stat) use (&$find) {
                    // TODO регистр?
                    if (\basename($stat['name']) === 'workbook.xml.rels') {
                        $find = $stat;
                        return null;
                    }
                    return true;
                })
            );

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found "workbook.xml.rels" from zip',
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            $resource = $this->zip->getStreamIndex($find['index'], \ZipArchive::FL_UNCHANGED);

            if (!\is_resource($resource)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'ZipArchive()->getStreamIndex() failed',
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            return $resource;
        }

        /**
         * @param resorce $resource
         */
        function resourceWorkbookRelsToXml($resource): ?\DOMDocument
        {
            // TODO может стоит всетаки не читать все, а сохранить во временный файл и загружать из файла
            $content = \stream_get_contents($resource);
            \fclose($resource);

            if (!\is_string($content)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'stream_get_contents() failed',
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            $docRelWorkbook = new \DOMDocument();
            if ($docRelWorkbook->loadXML($content) !== true) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'DOMDocument()->loadXML() failed',
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            return $docRelWorkbook;
        }

        function findAttrTargetFromXml(\DOMDocument $doc): ?\DOMAttr
        {
            $xpath = new \DOMXpath($doc);
            $query = '//*[local-name()="Relationship"][@Id="' . $this->id . '"]';
            $search = $xpath->query($query);

            if (\is_bool($search)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('DOMXpath()->query(%s) failed', $query),
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            if ($search->count() !== 1) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('DOMXpath()->query(%s) find over 1', $query),
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            $search = \iterator_to_array($search->getIterator(), false);
            $search = \Inilim\Tool\Method\PF\array_first($search);
            /** @var \DOMNode|\DOMNameSpaceNode $search */

            return $search->attributes->getNamedItem('Target');
        }

        /**
         * @return ZipStatItem|null
         */
        function findStatItemFromZipByAttr(\DOMAttr $target): ?array
        {
            $find = null;
            \Inilim\Tool\Method\Other\iteratorToDevNull(
                \Inilim\Tool\Method\Zip\findByFilterAsGenerator($this->zip, static function ($stat) use (&$find, $target) {
                    // TODO регистр?
                    $name = \Inilim\Tool\Method\Path\normalize($stat['name']);
                    if (
                        \Inilim\Tool\Method\PF\str_ends_with($name, $target->value)
                    ) {
                        $find = $stat;
                        return null;
                    }
                    return true;
                })
            );

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Zip::findByFilter() failed',
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            return $find;
        }

        /**
         * @return resource|null
         */
        function getResourceFromZipByIdx(int $idx)
        {
            $res = $this->zip->getStreamIndex($idx, \ZipArchive::FL_UNCHANGED);

            if (!\is_resource($res)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('ZipArchive()->getStreamIndex(%s) failed', $idx),
                    $this->zip->filename,
                    -1
                );
                return null;
            }

            return $res;
        }

        /**
         * @return ZipStatItem|null
         */
        function findSharedStrsStatItemFromZip(): ?array
        {
            $find = null;
            \Inilim\Tool\Method\Other\iteratorToDevNull(
                \Inilim\Tool\Method\Zip\findByFilterAsGenerator($this->zip, static function ($stat) use (&$find) {
                    // TODO регистр?
                    if (
                        \basename($stat['name']) === 'sharedStrings.xml'
                    ) {
                        $find = $stat;
                        return null;
                    }
                    return true;
                })
            );

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Zip::findByNameFile() failed',
                    $this->zip->filename,
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
                    $this->zip->filename,
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
