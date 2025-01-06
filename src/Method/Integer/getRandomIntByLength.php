<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'clamp',
    'getCurLenMaxInt',
]);

function getRandomIntByLength(int $length): int
{
    $maxLen = \Inilim\Tool\Method\Integer\getCurLenMaxInt();
    $length = \Inilim\Tool\Method\Integer\clamp($length, 1, $maxLen);
    if ($length === 1) {
        $start = 0;
        $end   = 9;
    } else {
        $start = \intval(1 . \str_repeat('0', ($length - 1)));
        $end   = $maxLen === $length ? \PHP_INT_MAX : \intval(\str_repeat('9', $length));
    }
    return \mt_rand($start, $end);
}
