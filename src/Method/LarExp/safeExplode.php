<?php

namespace Inilim\Tool\Method\LarExp;

/**
 * @build_skip
 * @param mixed $fill
 * @return $fill is string ? list<string> : list<mixed>
 */
function safeExplode(string $value, string $delimiter, int $limit = \PHP_INT_MAX, $fill = null): array
{
    $maxSize = \substr_count($value, $delimiter) + 1;
    // $length = match (true) {
    //     $limit === 0 => 1,
    //     $limit < 0 => $maxSize - $limit,
    //     $limit > $maxSize => $maxSize,
    //     default => $limit,
    // };

    switch (true) {
        case $limit === 0:
            $length = 1;
            break;
        case $limit < 0:
            $length = $maxSize - $limit;
            break;
        case $limit > $maxSize:
            $length = $maxSize;
            break;
        default:
            $length = $limit;
    }

    return \array_pad(\explode($delimiter, $value, $limit), $length, $fill);
}
