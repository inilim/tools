<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

use function Inilim\Tool\Method\Other\timedMsCall;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Cell_excelReadRowsById from \TypeExp
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|\Generator<int,Cell_excelReadRowsById>;
 */
function excelReadCellsBySheetId($pathToFileOrZip, string $sheetId, int $offset = 0): ?\Generator
{
    \Inilim\Tool\Method\Assert\natural($offset);
    $convertResult = \Inilim\Tool\Method\Exp\excelConvertSheetToDocXml($pathToFileOrZip, $sheetId);
    if ($convertResult === null) {
        return null;
    }

    $xpathSheet = new \DOMXPath($convertResult['sheet']['xml']);
    $xpathSheet->query('//*[local-name()="c"][position() <= 10]');
    // $xpathSheet->query('//*[local-name()="c"][position() >= 0 and position() <= 10]');
    de(123123123);

    $anonObj = new class(
        $convertResult,
        $offset
    ) {
        var array $convertResult;
        var int $countReadRows;
        var int $offset;
        /**
         * @var \DOMNodeList<\DOMElement>
         */
        var \DOMNodeList $cells;
        var \DOMNodeList $sharedStringsList;

        function __construct(
            array $convertResult,
            int $offset
        ) {
            $this->convertResult = $convertResult;
            $this->offset        = $offset;
        }

        function __invoke(): bool
        {
            $r = $this->convertResult;
            $this->convertResult = [];
            $xmlSheet = $r['sheet']['xml'];
            /** @var \DOMDocument $xmlSheet */
            $xmlSharedStrs = $r['shared_strings']['xml'];
            /** @var \DOMDocument $xmlSharedStrs */

            $xpathSheet = new \DOMXPath($xmlSharedStrs);
            // $this->sharedStringsList = $xmlSharedStrs->getElementsByTagName('t');
            $sharedStringsList = $xpathSheet->query('//*[local-name()="t"]');
            if ($sharedStringsList === false) {
                $this->setErr('xpath shared strings');
                return false;
            }
            /** @var \DOMNodeList<\DOMElement> $sharedStringsList */
            $this->sharedStringsList = $sharedStringsList;

            $xpathSheet = new \DOMXPath($xmlSheet);
            if ($this->offset > 0) {
                // INFO //*[local-name()="c"][position() > 1]
                $xpath = '//*[local-name()="c"][position() > ' . $this->offset . ']';
            } else {
                // $cells = $xmlSheet->getElementsByTagName('c');
                $xpath = '//*[local-name()="c"]';
            }

            $cells = $xpathSheet->query($xpath);
            if ($cells === false) {
                $this->setErr('xpath sheet');
                return false;
            }
            /** @var \DOMNodeList<\DOMElement> $cells */

            $this->cells = $cells;

            return true;
        }

        function getGenerator(): \Generator
        {
            $sharedStrsList = $this->sharedStringsList;
            $i = 0;
            foreach ($this->cells as $cell) {
                $i++;
                d($i);
                yield $this->defineCell2($cell, $sharedStrsList);
            } // endforeach(cells)
        }

        /**
         * @return Cell_excelReadRowsById
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

        function defineCell2(\DOMElement $cellEl, \DOMNodeList $sharedStrsList): array
        {
            return [];
            // $cellStr = \Inilim\Tool\Method\Xml\toXml($cellEl);
            // d($cellStr);
            // $cStr = \Inilim\Tool\Method\Str\before($cellStr, '>');
            // d($cStr);
            // \preg_match_all('#r="?<id>([a-z]+\d+)"|t="?<type>([a-z]+)"#i', $cStr, $matches, \PREG_SET_ORDER);
            // de($matches);
            // $type = $matches['type'];
            // $cellId = $matches['id'];
            // $matches = [];
            // de([
            //     '$type' => $type,
            //     '$cellId' => $cellId,
            // ]);
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
