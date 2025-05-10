<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Format the given number according to the current locale.
 *
 * @param  int|float  $number
 * @param  int|null  $precision
 * @param  int|null  $maxPrecision
 * @param  string|null  $locale
 * @return string|false
 */
function format($number, ?int $precision = null, ?int $maxPrecision = null, ?string $locale = null)
{
    if (!\Inilim\Tool\Method\Other\extPhp('intl')) {
        throw new \RuntimeException('The "intl" PHP extension is required to use the [format] function.');
    }

    $formatter = new \NumberFormatter($locale ?? \Inilim\Tool\Method\Integer\__state()->locale, \NumberFormatter::DECIMAL);

    if ($maxPrecision !== null) {
        $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, $maxPrecision);
    } elseif ($precision !== null) {
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $precision);
    }

    return $formatter->format($number);
}
