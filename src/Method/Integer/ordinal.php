<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Convert the given number to ordinal form.
 *
 * @param  int|float  $number
 * @return string
 */
function ordinal($number, ?string $locale = null)
{
    if (!\Inilim\Tool\Method\Other\extPhp('intl')) {
        throw new \RuntimeException('The "intl" PHP extension is required to use the [spell] function.');
    }

    $formatter = new \NumberFormatter($locale ?? \Inilim\Tool\Method\Integer\__state()->locale, \NumberFormatter::ORDINAL);

    return $formatter->format($number);
}
