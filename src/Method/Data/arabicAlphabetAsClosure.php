<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

/**
 * @return \Closure():string[]
 * @ext mbstring
 */
function arabicAlphabetAsClosure()
{
    \Inilim\Tool\Method\Assert\extPhp('mbstring');
    return static function () {
        $result = [];
        foreach ([1571, 1576, 1578, 1579, 1580, 1581, 1582, 1583, 1584, 1585, 1586, 1587, 1588, 1589, 1590, 1591, 1592, 1593, 1594, 1601, 1602, 1603, 1604, 1605, 1606, 1607, 1600, 1608, 1610] as $code) {
            $result[] = \mb_chr($code, 'UTF-8');
        }
        return $result;
    };
}
