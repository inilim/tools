<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'clamp',
    'getCurLenMaxInt',
]);

function getRandomIntByLength(int $length): int
{
    $max_len = Integer::getCurLenMaxInt();
    $length = Integer::clamp($length, 1, $max_len);
    if ($length === 1) {
        $start = 0;
        $end   = 9;
    } else {
        $start = \intval(1 . \str_repeat('0', ($length - 1)));
        $end   = $max_len === $length ? \PHP_INT_MAX : \intval(\str_repeat('9', $length));
    }
    return \mt_rand($start, $end);
}
