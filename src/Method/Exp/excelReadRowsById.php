<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

use PhpParser\Node\Stmt\Break_;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Row_excelReadRowsById from \TypeExp
 * @psalm-import-type Cell_excelReadRowsById from \TypeExp
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|array{generator:\Generator<int,Cell_excelReadRowsById>,info:array}
 */
function excelReadRowsById($pathToFileOrZip, string $id, int $countReadRows = 100, int $offset = 0)
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    \Inilim\Tool\Method\Assert\positiveInteger($countReadRows);
    \Inilim\Tool\Method\Assert\natural($offset);

    $anonObj = new class(
        \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip),
        $id,
        $countReadRows,
        $offset
    ) {
        var \ZipArchive $zip;
        var string $id;
        var int $countReadRows;
        var int $offset;
        var string $zipPathToFile;
        var string $zipHashPathToFile;
        var ?string $zipHashFile;
        var string $fileInfo;
        var int $findCountRows = -1;
        var ?\DOMDocument $docSheet = null;
        var ?\DOMDocument $docSharedStrs = null;
        var ?string $defineRange = null;
        var int $countCreateTmpFiles = 0;
        var int $createInfoFile = 0;
        var int $refresh = 0;

        function __construct(
            \ZipArchive $zip,
            string $id,
            int $countReadRows,
            int $offset
        ) {
            $this->id                = $id;
            $this->zip               = $zip;
            $this->countReadRows     = $countReadRows;
            $this->offset            = $offset;
            $this->zipPathToFile     = \Inilim\Tool\Method\Path\normalize($zip->filename);
            $this->zipHashPathToFile = \md5($this->zipPathToFile);
        }

        function getInfo(): array
        {
            return [
                'id' => $this->id,
                'offset' => $this->offset,
                'refresh' => $this->refresh,
                'fileInfo' => $this->fileInfo,
                'defineRange' => $this->defineRange,
                'findCountRows' => $this->findCountRows,
                'countReadRows' => $this->countReadRows,
                'createInfoFile' => $this->createInfoFile,
                'pathToFileExcel' => $this->zipPathToFile,
                'countCreateTmpFiles' => $this->countCreateTmpFiles,
            ];
        }

        function __invoke(): bool
        {
            $resourceSheet = \Inilim\Tool\Method\Exp\excelGetResourceSheetById($this->zip, $this->id);
            if ($resourceSheet === null) {
                return false;
            }
            /** @var resource $resourceSheet */

            // ---------------------------------------------
            // sharedStrings.xml
            // ---------------------------------------------

            $resourceSharedStrings = $this->findSharedStrings();
            if ($resourceSharedStrings === null) {
                return false;
            }

            // ---------------------------------------------
            // создаем информационный файл
            // ---------------------------------------------

            $fileInfo = \Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir() . '/inilim-tools-excel-' . $this->zipHashPathToFile . '.xml.tmp');
            $this->fileInfo = $fileInfo;
            // TODO большие файлы это долго
            $this->zipHashFile = \md5_file($this->zipPathToFile);
            $countStartCreateInfo = 0;
            startCreateInfo:
            $countStartCreateInfo++;

            if ($countStartCreateInfo > 2) {
                $this->setErr('todo loop');
                return false;
            }

            if (\Inilim\Tool\Method\FS\isFile($fileInfo)) {
                // old
                $docInfo = \Inilim\Tool\Method\Xml\loadFile($fileInfo);
                if ($docInfo === null) {
                    \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($this->zip);
                    goto startCreateInfo;
                }
                /** @var \DOMDocument $docInfo */
                $rootInfo = $docInfo->getElementsByTagName('root')->item(0);
                if ($rootInfo === null) {
                    unset($docInfo);
                    \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($this->zip);
                    goto startCreateInfo;
                }
                /** @var \DOMNode $rootInfo */
                $changedXml = $this->changedExcelFile($docInfo);
            } else {
                // new
                $this->createInfoFile = 1;
                ['doc' => $docInfo, 'root' => $rootInfo] = $this->createDocWithRoot();
                if ($docInfo === null) {
                    $this->setErr('не удалось создать doc with root');
                    return false;
                }
                $this->createElAndAppendToRootDoc($rootInfo, 'zip', [
                    'file_name' => \basename($this->zipPathToFile),
                    'path_to_file' => $this->zipPathToFile,
                    'hash_path_to_file' => $this->zipHashPathToFile,
                    'hash_file' => $this->zipHashFile,
                ]);
                $changedXml = false;
                // INFO метод save не устанавливает значение в documentURI .... why????
                $docInfo->save($fileInfo);
                // INFO load отвязывает root от doc
                $docInfo->load($fileInfo);
                $rootInfo = $docInfo->getElementsByTagName('root')->item(0);
                /** @var \DOMNode $rootInfo */
            }

            if ($docInfo->documentURI === null) {
                $this->setErr('documentURI не установился');
                return false;
            }

            // ---------------------------------------------
            //
            // ---------------------------------------------

            if ($changedXml) {
                unset($docInfo, $rootInfo);
                \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($this->zip);
                $this->refresh = 1;
                goto startCreateInfo;
            }

            // ---------------------------------------------
            // переносим ресурсы в временный файл
            // ---------------------------------------------

            $pathToFileTmp = $this->saveResourceAndInfo($resourceSheet, $docInfo, $rootInfo);
            if ($pathToFileTmp === null) {
                return false;
            }
            \fclose($resourceSheet);
            unset($resourceSheet);
            $sheetDoc = new \DOMDocument;
            $sheetDoc->load($pathToFileTmp);
            $pathToFileTmp = $this->saveResourceAndInfo($resourceSharedStrings, $docInfo, $rootInfo);
            if ($pathToFileTmp === null) {
                return false;
            }
            \fclose($resourceSharedStrings);
            unset($resourceSharedStrings);
            $sharedStrsDoc = new \DOMDocument;
            $sharedStrsDoc->load($pathToFileTmp);

            if ($docInfo->save($docInfo->documentURI) === false) {
                $this->setErr('Не удалось сохранить doc info');
                return false;
            }

            unset(
                $fileInfo,
                $docInfo,
                $rootInfo,
                $pathToFileTmp,
                $countStartCreateInfo,
                $changedXml
            );

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $this->docSheet      = $sheetDoc;
            $this->docSharedStrs = $sharedStrsDoc;
            $rows = $sheetDoc->getElementsByTagName('row');
            $this->findCountRows = $rows->count();
            $this->defineRange = $this->defineRange($rows);

            return true;
        }

        /**
         * @param resource $res
         */
        function saveResourceAndInfo($res, \DOMDocument $docInfo, \DOMNode $rootInfo): ?string
        {
            $xpathInfo = new \DOMXpath($docInfo);
            $file = \stream_get_meta_data($res)['uri'];
            $file = \Inilim\Tool\Method\Path\normalize($file);
            $hash = \md5($file);
            // INFO ищем файл в инфо
            $pathToFileTmp = $this->findFileFromInfo($xpathInfo, $hash);
            // INFO создаем файл если он не был найден ИЛИ если были изменения в файле excel
            if ($pathToFileTmp === null || !\Inilim\Tool\Method\FS\isFile($pathToFileTmp)) {
                // TODO что если в инфо файла нету, а временный файл есть?
                $pathToFileTmp = \sys_get_temp_dir() . '/inilim-tools-excel-' . $hash . '.xml.tmp';
                // INFO переносим ресурс в временный файл
                if (!$this->resourceToFile($res, $pathToFileTmp)) {
                    return null;
                }
                $this->countCreateTmpFiles++;
                // INFO добавляем файл в инфо
                $t = $this->createElAndAppendToRootDoc($rootInfo, 'item', [
                    'path_to_file' => $pathToFileTmp,
                    'hash_path_to_file' => $hash,
                ]);

                if ($t === null) {
                    $this->setErr('не удалось добавить item в root "%s"', $pathToFileTmp);
                    return null;
                }
            }

            return $pathToFileTmp;
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
            $docSheet       = $this->docSheet;
            $docSharedStrs  = $this->docSharedStrs;
            // clears
            $this->docSheet = $this->docSharedStrs = null;

            if ($this->offset > 0) {
                $xpathSheet = new \DOMXPath($docSheet);
                // INFO //*[local-name()="row"][position() > 1]
                $rows = $xpathSheet->query('//*[local-name()="row"][position() > ' . $this->offset . ']');
                /** @var \DOMNodeList<\DOMElement> $rows */
            } else {
                $rows = $docSheet->getElementsByTagName('row');
            }

            $sharedStrsDocT = $docSharedStrs->getElementsByTagName('t');
            $countRows      = 0;
            foreach ($rows as $row) {
                $idxRow      = (int)$row->getAttribute('r');
                $cells       = $row->getElementsByTagName('c');
                $countCells  = $cells->count();
                $resultCells = [];
                foreach ($cells as $cell) {
                    $cell = $this->defineCell($row, $cell, $sharedStrsDocT);
                    $resultCells[$cell['id']] = $cell;
                } // endforeach(cells)
                $cells = null;

                yield $idxRow => [
                    'cells' => $resultCells,
                    'index' => $idxRow,
                    'xml'   => \Inilim\Tool\Method\Xml\toXml($row),
                    'count' => $countCells
                ];
                $resultCells = [];
                $countRows++;

                if ($countRows >= $this->countReadRows) {
                    break;
                }
            } // endforeach(rows)
        }

        /**
         * @return Cell_excelReadRowsById
         */
        function defineCell(\DOMElement $rowEl, \DOMElement $cellEl, \DOMNodeList $sharedStrsList): array
        {
            $type   = $cellEl->getAttribute('t');
            $type   = \strtolower($type);
            $cellId = $cellEl->getAttribute('r');
            $cellId = \strtolower($cellId);
            // AE43 > AE 43
            [$colChar, $rowNum] = \preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $cellId, 2);
            $rowNum = (int)$rowNum;
            try {
                $colNum = \Inilim\Tool\Method\Exp\excelColCharToNum($colChar);
            } catch (\InvalidArgumentException $e) {
                $colNum = -1;
                // TODO goto???
                // goto brokenCell;
            }

            switch ($type) {
                case 'str':
                    // формула и его результат
                    $formula = $cellEl->getElementsByTagName('f');
                    $formula = $formula->item(0);
                    if ($formula === null) {
                        goto brokenCell;
                    }
                    $formula = $formula->textContent;
                    $value   = $cellEl->getElementsByTagName('v');
                    $value   = $value->item(0);
                    if ($value === null) {
                        goto brokenCell;
                    }
                    $value = $value->textContent;
                    return [
                        'value'     => $value,
                        'raw_value' => $formula,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'type'      => 'formula',
                    ];
                case 's':
                    // Строка в шаред
                    $raw_value = $cellEl->getElementsByTagName('v');
                    $raw_value = $raw_value->item(0);
                    if ($raw_value === null) {
                        goto brokenCell;
                    }
                    $raw_value = $raw_value->textContent;
                    $strIdx    = (int)$raw_value;
                    $value     = $sharedStrsList->item($strIdx);
                    if ($value === null) {
                        goto brokenCell;
                    }
                    $value = $value->textContent;
                    return [
                        'value'     => $value,
                        'raw_value' => $raw_value,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'type'      => 'string',
                        'shared_id' => $strIdx
                    ];
                case 'e':
                    // error excel
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => \Inilim\Tool\Method\Xml\toXml($cellEl),
                        'type'      => 'error',
                    ];
                case 'b':
                    // bool значение
                    $raw_value = $cellEl->getElementsByTagName('v');
                    $raw_value = $raw_value->item(0);
                    if ($raw_value === null) {
                        goto brokenCell;
                    }
                    $raw_value = $raw_value->textContent;
                    return [
                        'value'     => (bool)$raw_value,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => $raw_value,
                        'type'      => 'bool',
                    ];
                case 'n':
                    // Число
                    $raw_value = $cellEl->getElementsByTagName('v');
                    $raw_value = $raw_value->item(0);
                    if ($raw_value === null) {
                        goto brokenCell;
                    }
                    $raw_value = $raw_value->textContent;
                    $value = \Inilim\Tool\Method\Integer\isNumeric($raw_value)
                        ? (int)$raw_value
                        : (float)$raw_value;
                    return [
                        'value'     => $value,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => $raw_value,
                        'type'      => 'number',
                    ];
                case '':
                    // пустая ячейка
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => \Inilim\Tool\Method\Xml\toXml($cellEl),
                        'type'      => 'empty',
                    ];
                default:
                    // неизвестная ячейка.
                    de([
                        'type' => $type,
                        \Inilim\Tool\Method\Xml\toXml($rowEl),
                        \Inilim\Tool\Method\Xml\toXml($cellEl),
                    ]);
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => \Inilim\Tool\Method\Xml\toXml($cellEl),
                        'type'      => 'unknown',
                    ];
                    // Поломанныя ячейка
                    brokenCell:
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => \Inilim\Tool\Method\Xml\toXml($cellEl),
                        'type'      => 'broken',
                    ];
            }
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
                $this->setErr('Not found "sharedStrings.xml" from archive');
                return null;
            }

            return $find;
        }

        function findFileFromInfo(\DOMXpath $xpathInfo, string $fileHash): ?string
        {
            $result = $xpathInfo->query('//*[local-name()="item"][@hash_path_to_file="' . $fileHash . '"]');
            if ($result === false || $result->count() !== 1) {
                return null;
            }
            $result = $result->item(0);
            /** @var \DOMNode|\DOMNameSpaceNode $result */
            $attr = $result->attributes->getNamedItem('path_to_file');
            if ($attr === null) {
                return null;
            }
            return $attr->value;
        }

        /**
         * @param resource $resource
         */
        function resourceToFile($resource, string $pathToFile): bool
        {
            if (!\Inilim\Tool\Method\Other\resourceContentWriteToFile($resource, $pathToFile)) {
                $this->setErr('Не удалось перевести ресурс в файл "%s"', $pathToFile);
                return false;
            }
            return true;
        }

        function setErr(string $format, ...$values)
        {
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                \sprintf($format, ...$values),
                $this->zipPathToFile,
                -1
            );
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
         * @return null|array{'doc':\DOMDocument,'root':\DOMNode}
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
            return ['doc' => $doc, 'root' => $doc->appendChild($el)];
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
