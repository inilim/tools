<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Convert the number to its human-readable equivalent.
 * @param  int|float  $number
 * @return string|false
 */
function __summarize($number, int $precision = 0, ?int $maxPrecision = null, array $units = [])
{
    if (!$units) {
        $units = [
            3  => 'K',
            6  => 'M',
            9  => 'B',
            12 => 'T',
            15 => 'Q',
        ];
    }

    switch (true) {
        case \floatval($number) === 0.0:
            return $precision > 0 ? \Inilim\Tool\Method\Integer\format(0, $precision, $maxPrecision) : '0';
        case $number < 0:
            return \sprintf('-%s', \Inilim\Tool\Method\Integer\__summarize(\abs($number), $precision, $maxPrecision, $units));
        case $number >= 1e15:
            return \sprintf('%s' . \end($units), \Inilim\Tool\Method\Integer\__summarize($number / 1e15, $precision, $maxPrecision, $units));
    }

    $numberExponent = \floor(\log10($number));
    $displayExponent = $numberExponent - ($numberExponent % 3);
    $number /= \pow(10, $displayExponent);

    return \trim(\sprintf('%s%s', \Inilim\Tool\Method\Integer\format($number, $precision, $maxPrecision), $units[$displayExponent] ?? ''));
}
