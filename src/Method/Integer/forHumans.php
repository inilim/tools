<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Convert the number to its human-readable equivalent.
 * @param  int|float  $number
 * @return false|string
 */
function forHumans($number, int $precision = 0, ?int $maxPrecision = null, bool $abbreviate = false)
{
    return \Inilim\Tool\Method\Integer\__summarize(
        $number,
        $precision,
        $maxPrecision,
        $abbreviate ? [
            3  => 'K',
            6  => 'M',
            9  => 'B',
            12 => 'T',
            15 => 'Q',
        ] : [
            3  => ' thousand',
            6  => ' million',
            9  => ' billion',
            12 => ' trillion',
            15 => ' quadrillion',
        ]
    );
}
