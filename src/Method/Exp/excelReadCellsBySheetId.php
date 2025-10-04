<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * INFO быстрый парсинг, но больше потребление памяти
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Cell_excelReadCellsBySheetId from \TypeExp
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|\Generator<int,Cell_excelReadCellsBySheetId>;
 */
function excelReadCellsBySheetId($pathToFileOrZip, string $sheetId, int $offset = 0): ?\Generator
{
    \Inilim\Tool\Method\Assert\natural($offset);
    $convertResult = \Inilim\Tool\Method\Exp\excelExtractSheetToTmpFile($pathToFileOrZip, $sheetId);
    if ($convertResult === null) {
        return null;
    }

    $anonObj = new class(
        $convertResult,
        $offset
    ) {
        var int $offset;
        /**
         * @var \DOMNodeList<\DOMElement>
         */
        var ?\DOMNodeList $cells;
        var ?\DOMNodeList $sharedStringsList;
        var string $fileExcel;
        var string $fileSharedStrings;
        var string $fileSheet;

        function __construct(
            array $convertResult,
            int $offset
        ) {
            $this->fileExcel = $convertResult['info']['excel_file'];
            $this->fileSheet = $convertResult['sheet']['file'];
            $this->fileSharedStrings = $convertResult['shared_strings']['file'];
            $this->offset = $offset;
        }

        function __invoke(): bool
        {
            $xmlSheet = new \DOMDocument;
            $xmlSheet->load($this->fileSheet);
            $xmlSharedStrs = new \DOMDocument;
            $xmlSharedStrs->load($this->fileSharedStrings);

            // INFO XPath::query бысрее чем DOMDocument::getElementsByTagName
            $sharedStringsList = (new \DOMXPath($xmlSharedStrs))->query('//*[local-name()="t"]');
            if ($sharedStringsList === false) {
                $this->setErr('xpath shared strings');
                return false;
            }
            /** @var \DOMNodeList<\DOMElement> $sharedStringsList */
            $this->sharedStringsList = $sharedStringsList;

            if ($this->offset > 0) {
                // INFO //*[local-name()="c"][position() > 1]
                $xpath = '//*[local-name()="c"][position() > ' . $this->offset . ']';
            } else {
                // $cells = $xmlSheet->getElementsByTagName('c');
                $xpath = '//*[local-name()="c"]';
            }

            $cells = (new \DOMXPath($xmlSheet))->query($xpath);
            if ($cells === false) {
                $this->setErr('xpath sheet');
                return false;
            }
            /** @var \DOMNodeList<\DOMElement> $cells */

            $this->cells = $cells;

            return true;
        }

        /**
         * @return \Generator<int,Cell_excelReadCellsBySheetId>
         */
        function getGenerator(): \Generator
        {
            $sharedStrsList = $this->sharedStringsList;
            $i = 0;
            $start = \time();
            foreach ($this->cells as $cell) {
                $cell = $this->defineCell($cell, $sharedStrsList);
                $cur = \time();
                $e = \sprintf('Count: %s Start: %s Cur: %s Diff: %s Cell: %s', $i, $start, $cur, ($cur - $start), $cell['id']);
                echo $e . "\r";
                yield $cell;
                $i++;
            } // endforeach
            $sharedStrsList = $this->sharedStringsList = $this->cells = null;
        }

        /**
         * TODO доделать выводимиый массив
         * @return Cell_excelReadCellsBySheetId
         */
        function defineCell(\DOMElement $cellEl, \DOMNodeList $sharedStrsList): array
        {
            $type   = $cellEl->getAttribute('t');
            $type   = \strtolower($type);
            $cellId = $cellEl->getAttribute('r');
            $cellId = \strtoupper($cellId);
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
                        'col_char'       => $colChar,
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
                        'col_char'  => $colChar,
                        'row_num'   => $rowNum,
                        'type'      => 'string',
                        'str_idx'   => $strIdx
                    ];
                case 'e':
                    // error excel
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col_char'       => $colChar,
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
                        'col_char'       => $colChar,
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
                    if (\Inilim\Tool\Method\Integer\isNumeric($raw_value)) {
                        $value = (int)$raw_value;
                        $type = 'int';
                    } else {
                        $value = (float)$raw_value;
                        $type = 'float';
                    }

                    return [
                        'value'     => $value,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col_char'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => $raw_value,
                        'type'      => $type,
                    ];
                case '':
                    // пустая ячейка
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col_char'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => \Inilim\Tool\Method\Xml\toXml($cellEl),
                        'type'      => 'empty',
                    ];
                default:
                    // неизвестная ячейка.
                    de([
                        'type' => $type,
                        \Inilim\Tool\Method\Xml\toXml($cellEl),
                    ]);
                    return [
                        'value'     => null,
                        'id'        => $cellId,
                        'col_num'   => $colNum,
                        'col_char'       => $colChar,
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
                        'col_char'       => $colChar,
                        'row_num'   => $rowNum,
                        'raw_value' => \Inilim\Tool\Method\Xml\toXml($cellEl),
                        'type'      => 'broken',
                    ];
            }
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
        // static function () {
        //     de(func_get_args());
        // }
        null
    );
    /** @var null|bool $result */

    if ($result === true) {
        return $anonObj->getGenerator();
    }
    return null;
}
