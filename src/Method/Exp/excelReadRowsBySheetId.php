<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Row_excelReadRowsById from \TypeExp
 * @psalm-import-type Cell_excelReadRowsById from \TypeExp
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|\Generator<int,Row_excelReadRowsById>
 */
function excelReadRowsBySheetId($pathToFileOrZip, string $sheetId, int $countReadRows = 100, int $offset = 0): ?\Generator
{
    \Inilim\Tool\Method\Assert\positiveInteger($countReadRows);
    \Inilim\Tool\Method\Assert\natural($offset);
    $convertResult = \Inilim\Tool\Method\Exp\excelExtractSheetToTmpFile($pathToFileOrZip, $sheetId);
    if ($convertResult === null) {
        return null;
    }

    $anonObj = new class(
        $convertResult,
        $countReadRows,
        $offset
    ) {
        var array $convertResult;
        var int $countReadRows;
        var int $offset;
        var int $findCountRows = -1;
        /**
         * @var \DOMNodeList<\DOMElement>
         */
        var \DOMNodeList $rows;
        var \DOMNodeList $sharedStringsList;

        function __construct(
            array $convertResult,
            int $countReadRows,
            int $offset
        ) {
            $this->convertResult = $convertResult;
            $this->countReadRows = $countReadRows;
            $this->offset        = $offset;
        }

        function __invoke(): bool
        {
            $r = $this->convertResult;
            $this->convertResult = [];
            $fileSheet = $r['sheet']['file'];
            /** @var string $fileSheet */
            $fileShared = $r['shared_strings']['file'];
            /** @var string $fileShared */

            $rows = $xmlSheet->getElementsByTagName('row');
            $this->findCountRows = $rows->count();

            $this->sharedStringsList = $xmlSharedStrs->getElementsByTagName('t');

            if ($this->offset > 0) {
                $xpathSheet = new \DOMXPath($xmlSheet);
                // INFO //*[local-name()="row"][position() > 1]
                $rows = $xpathSheet->query('//*[local-name()="row"][position() > ' . $this->offset . ']');
                if ($rows === false) {
                    $this->setErr('offset xpath position');
                    return false;
                }
                /** @var \DOMNodeList<\DOMElement> $rows */
            } else {
                $rows = $xmlSheet->getElementsByTagName('row');
            }

            $this->rows = $rows;

            return true;
        }

        function getGenerator(): \Generator
        {
            $countRows      = 0;
            $sharedStrsList = $this->sharedStringsList;
            foreach ($this->rows as $row) {
                $idxRow      = (int)$row->getAttribute('r');
                $cells       = $row->getElementsByTagName('c');
                $countCells  = $cells->count();
                $resultCells = [];
                foreach ($cells as $cell) {
                    $cell = $this->defineCell($row, $cell, $sharedStrsList);
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

        function setErr(string $format, ...$values)
        {
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                \sprintf($format, ...$values),
                $this->convertResult['info']['excel_file'],
                -1
            );
        }
    };
    unset($convertResult);

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => $anonObj->__invoke(),
        static function () {
            d(func_get_args());
        }
    );
    /** @var null|bool $result */

    if ($result === true) {
        return $anonObj->getGenerator();
    }
    return null;
}
