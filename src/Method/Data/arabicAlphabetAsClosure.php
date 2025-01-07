<?php

namespace Inilim\Tool\Method\Data;

function arabicAlphabetAsClosure(): \Closure
{
    return static fn() => \array_map(static fn($code) => \mb_chr($code, 'UTF-8'), [1571, 1576, 1578, 1579, 1580, 1581, 1582, 1583, 1584, 1585, 1586, 1587, 1588, 1589, 1590, 1591, 1592, 1593, 1594, 1601, 1602, 1603, 1604, 1605, 1606, 1607, 1600, 1608, 1610]);
}
