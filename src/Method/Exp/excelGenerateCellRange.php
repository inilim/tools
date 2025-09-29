<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author deepseek
 * 
 * @return \Generator<int,string>
 */
function excelGenerateCellRange(string $range): \Generator
{
    if (!\Inilim\Tool\Method\Str\isMatch('/^([A-Z]+)(\d+):([A-Z]+)(\d+)$/i', $range)) {
        throw new \InvalidArgumentException("Неверный формат диапазона: $range");
    }

    $anonObj = new class() {
        /**
         * @return \Generator<int,string>
         */
        function __invoke(string $range): \Generator
        {
            $range = \strtoupper($range);
            // Разбиваем диапазон на начальную и конечную ячейки
            \preg_match('/^([A-Z]+)(\d+):([A-Z]+)(\d+)$/', $range, $matches);

            $startCol = $matches[1];
            $startRow = (int)$matches[2];
            $endCol   = $matches[3];
            $endRow   = (int)$matches[4];


            // Генерируем ячейки для каждой строки и каждой колонки
            for ($row = $startRow; $row <= $endRow; $row++) {
                // Генерируем все колонки между startCol и endCol
                foreach ($this->generateColumnsBetween($startCol, $endCol) as $column) {
                    yield $column . $row;
                }
            }
        }

        /**
         * @return \Generator<int,string>
         */
        function generateColumnsBetween(string $start, string $end): \Generator
        {
            $current = $start;

            while ($current <= $end) {
                yield $current;
                $current = $this->incrementColumn($current);
                // TODO ....
                if ($current === $start) break; // Защита от бесконечного цикла
            }
        }

        function incrementColumn(string $column): string
        {
            $chars = \str_split(\strrev($column));
            $carry = true;
            $result = '';

            foreach ($chars as $char) {
                if ($carry) {
                    if ($char === 'Z') {
                        $result .= 'A';
                        $carry = true;
                    } else {
                        $result .= \chr(\ord($char) + 1);
                        $carry = false;
                    }
                } else {
                    $result .= $char;
                }
            }

            if ($carry) {
                $result .= 'A';
            }

            return \strrev($result);
        }
    };

    return $anonObj->__invoke($range);
}
