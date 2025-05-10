<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Convert the given number to its percentage equivalent.
 *
 * @param  int|float  $number
 * @return string|false
 */
function percentage($number, int $precision = 0, ?int $maxPrecision = null, ?string $locale = null)
{
    if (!\Inilim\Tool\Method\Other\extPhp('intl')) {
        throw new \RuntimeException('The "intl" PHP extension is required to use the [spell] function.');
    }

    $formatter = new \NumberFormatter($locale ?? \Inilim\Tool\Method\Integer\__state()->locale, \NumberFormatter::PERCENT);

    if ($maxPrecision !== null) {
        $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, $maxPrecision);
    } else {
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $precision);
    }

    return $formatter->format($number / 100);
}
