<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Cell_excelReadCellsBySheetId_m2 from \TypeExp
 * @psalm-import-type DataCell_excelReadCellsBySheetId_m2 from \TypeExp
 * @ext xmlreader zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|\Generator<int,Cell_excelReadCellsBySheetId_m2>;
 */
function excelReadCellsBySheetId_m2($pathToFileOrZip, string $sheetId, int $offset = 0): ?\Generator
{
    \Inilim\Tool\Method\Assert\extPhp('xmlreader');
    \Inilim\Tool\Method\Assert\natural($offset);
    $convertResult = \Inilim\Tool\Method\Exp\excelExtractSheetToTmpFile($pathToFileOrZip, $sheetId);
    // de($convertResult);
    if ($convertResult === null) {
        return null;
    }

    $anonObj = new class(
        $convertResult,
        $offset
    ) {
        var array $convertResult;
        var int $countReadRows;
        var int $offset;
        var \XMLReader $sheet;
        var \XMLReader $sharedStrings;
        var string $fileExcel;
        var string $fileSharedStrings;
        var string $fileSheet;
        var $resourceTmpXml;

        function __construct(
            array $convertResult,
            int $offset
        ) {
            $this->convertResult = $convertResult;
            $this->fileExcel = $convertResult['info']['excel_file'];
            $this->fileSheet = $convertResult['sheet']['file'];
            $this->fileSharedStrings = $convertResult['shared_strings']['file'];
            $this->offset        = $offset;
        }

        function __invoke(): bool
        {
            $this->convertResult = [];
            $xmlSheet = new \XMLReader;
            if (!$xmlSheet->open($this->fileSheet)) {
                $xmlSheet->close();
                $this->setErr('XMLReader::open("%s") failed', $this->fileSheet);
                return false;
            }
            if (!$xmlSheet->read()) {
                $xmlSheet->close();
                $this->setErr('Check XMLReader::read("%s") failed', $this->fileSheet);
                return false;
            }
            $xmlSharedStrs = new \XMLReader;
            if (!$xmlSharedStrs->open($this->fileSharedStrings)) {
                $xmlSharedStrs->close();
                $this->setErr('XMLReader::open("%s") failed', $this->fileSharedStrings);
                return false;
            }
            if (!$xmlSharedStrs->read()) {
                $xmlSharedStrs->close();
                $this->setErr('Check XMLReader::read("%s") failed', $this->fileSharedStrings);
                return false;
            }

            // $tmpResource = \tmpfile();
            // if ($tmpResource === false) {
            //     $this->setErr('tmpfile() failed');
            //     return false;
            // }

            // $fileTmpXml = \stream_get_meta_data($tmpResource)['uri'];
            // dd($fileTmpXml);

            // INFO создаем упрощенный временный xml файл
            /**
             * \fwrite($tmpResource, '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><root>');
             */
            // $replaced = [
            //     '>' => '&gt;',
            //     '<' => '&lt;',
            // ];
            // while ($xmlSharedStrs->read()) {
            //     if ($xmlSharedStrs->nodeType === \XMLReader::ELEMENT && $xmlSharedStrs->name === 't') {
            //         \fwrite($tmpResource, '<t>' . \strtr($xmlSharedStrs->readString(), $replaced) . '</t>');
            //     }
            // }
            // \fwrite($tmpResource, '</root>');

            // $xmlSharedStrs->close();
            // if (!$xmlSharedStrs->open($fileTmpXml)) {
            //     $this->setErr('XMLReader::open("%s") failed', $fileTmpXml);
            //     \fclose($tmpResource);
            //     return false;
            // }

            // $this->resourceTmpXml = $tmpResource;
            $this->sharedStrings = $xmlSharedStrs;
            $this->sheet = $xmlSheet;

            return true;
        }

        /**
         * INFO этот метод не отлавливает ошибки!!!
         */
        function getGenerator(): \Generator
        {
            $sheet = $this->sheet;
            $i = 0;
            $start = time();
            while ($sheet->read()) {
                if ($sheet->nodeType === \XMLReader::ELEMENT && $sheet->name === 'c') {
                    // <c xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" r="A1" s="28" t="s"><v>0</v></c>
                    $cell = $this->parseCellTag($sheet);
                    if ($cell === null) {
                        dd('cell === null');
                        continue;
                    }
                    $cell = $this->defineCell($cell);
                    // if ($cell['id'] === 'AS9') {
                    de($cell);
                    // }
                    $cur = \time();
                    echo "Count: $i Start: $start Cur: $cur\r";
                    yield $cell;
                    $i++;

                    if ($i >= 100_000) {
                        echo "Count: $i Start: $start Cur: $cur";
                        de('End. Time diff: ' . ($cur - $start));
                    }
                }
            } // endforeach(cells)
            // \fclose($this->resourceTmpXml);
        }

        /**
         * @param DataCell_excelReadCellsBySheetId_m2 $cell
         * @return Cell_excelReadCellsBySheetId_m2
         */
        function defineCell(array &$cell): array
        {
            switch ($cell['type']) {
                case 'str':
                    // формула и его результат
                    if ($cell['formula'] === null || $cell['value'] === null) {
                        goto brokenCell;
                    }
                    $cell['type'] = 'formula';
                    return $cell;
                case 's':
                    // Строка в шаред
                    if ($cell['raw_value'] === null || $cell['value'] === null) {
                        goto brokenCell;
                    }
                    $cell['type'] = 'string';
                    return $cell;
                case 'e':
                    // error excel
                    $cell['type'] = 'error';
                    return $cell;
                case 'b':
                    // bool значение
                    if ($cell['value'] === null) {
                        goto brokenCell;
                    }
                    $cell['value'] = (bool)$cell['value'];
                    $cell['type'] = 'bool';
                    return $cell;
                case 'n':
                    // Число
                    if ($cell['raw_value'] === null) {
                        goto brokenCell;
                    }
                    if (\Inilim\Tool\Method\Integer\isNumeric($cell['raw_value'])) {
                        $cell['value'] = (int)$cell['raw_value'];
                        $cell['type'] = 'int';
                    } else {
                        $cell['value'] = (float)$cell['raw_value'];
                        $cell['type'] = 'float';
                    }
                    return $cell;
                case 'empty':
                    // пустая ячейка
                    return $cell;
                default:
                    // неизвестная ячейка.
                    de([
                        'type' => $cell['type'],
                        $cell['xml'],
                    ]);
                    $cell['type'] = 'unknown';
                    return $cell;
                    // Поломанныя ячейка
                    brokenCell:
                    $cell['type'] = 'broken';
                    return $cell;
            }
        }

        /**
         * @return ?DataCell_excelReadCellsBySheetId_m2
         */
        function parseCellTag(\XMLReader $cell): ?array
        {
            $data = [
                'type'      => \strtolower($cell->getAttribute('t') ?? 'empty'),
                'id'        => $cell->getAttribute('r'),
                'str_idx'   => null,
                'xml'       => $cell->readOuterXml(),
                'value'     => null,
                'raw_value' => null,
                'formula'   => null,
            ];
            if ($data['id'] === null) {
                // TODO хз что с этим делать, в практике еще не попадалось
                return null;
            }
            $tagV = \stripos($data['xml'], '</v>') !== false;
            $tagF = \stripos($data['xml'], '</f>') !== false;
            $inner = '';
            if ($tagV || $tagF) {
                $inner = $cell->readInnerXml();
            }

            if ($tagV) {
                // INFO value
                \preg_match(
                    '/' .
                        '>([^><]*)<\/v>' .
                        '/i',
                    $inner,
                    $match
                );
                $data['value'] = $match[1] ?? null;
                $match = [];
            }

            if ($tagF) {
                // INFO formula
                \preg_match(
                    '/' .
                        '>([^><]*)<\/f>' .
                        '/i',
                    $inner,
                    $match
                );
                $data['formula'] = $match[1] ?? null;
            }

            if ($data['type'] === 's' && $data['value'] !== null) {
                // поиск
                $data['str_idx'] = (int)$data['value'];
                $data['raw_value'] = $data['value'];
                $data['value'] = $this->getStringFromSharedStrs($data['str_idx']);
            }

            $data['id'] = \strtoupper($data['id']);

            // AE43 > AE 43
            [$colChar, $rowNum] = \preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $data['id'], 2);

            if ($colChar === null || $rowNum === null) {
                return null;
            }
            $data['row_num'] = (int)$rowNum;
            $data['col_char'] = $colChar;

            try {
                $colNum = \Inilim\Tool\Method\Exp\excelColCharToNum($colChar);
            } catch (\InvalidArgumentException $e) {
                $colNum = -1;
            }
            $data['col_num'] = $colNum;

            return $data;
        }

        function parseCellTag2(string $tag)
        {
            d($tag);
        }

        function getStringFromSharedStrs(int $idx): ?string
        {
            static $curIdx = 0;
            static $start = false;
            $shared = $this->sharedStrings;

            if ($start && $idx === $curIdx) {
                return $shared->readString();
            }

            if ($idx < $curIdx) {
                $shared->close();
                $start = false;
                $curIdx = 0;
                if (!$shared->open($this->fileSharedStrings)) {
                    throw new \Exception(\sprintf('reopen xml file "%s" failed', $this->fileSharedStrings));
                }
            }

            while ($shared->read()) {
                if ($shared->nodeType === \XMLReader::ELEMENT && $shared->name === 't') {
                    if ($start) {
                        $curIdx++;
                    }
                    $start = true;
                    if ($curIdx === $idx) {
                        // if ($idx === 1583) {
                        //     dd($shared->readOuterXml());
                        // }
                        return $shared->readString();
                    }
                }
            }

            return null;
        }

        function setErr(string $format, ...$values)
        {
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                \sprintf($format, ...$values),
                $this->fileExcel,
                -1
            );
        }
    };
    unset($convertResult);

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => $anonObj->__invoke(),
        static function () {
            de(func_get_args());
        }
    );
    /** @var null|bool $result */

    if ($result === true) {
        return $anonObj->getGenerator();
    }
    return null;
}
