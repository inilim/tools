<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Spell out the given number in the given locale.
 *
 * @param  int|float  $number
 * @param  string|null  $locale
 * @param  int|null  $after
 * @param  int|null  $until
 * @return string
 */
function spell($number, ?string $locale = null, ?int $after = null, ?int $until = null)
{
    if (!\Inilim\Tool\Method\Other\extPhp('intl')) {
        throw new \RuntimeException('The "intl" PHP extension is required to use the [spell] function.');
    }

    if ($after !== null && $number <= $after) {
        return \Inilim\Tool\Method\Integer\format($number, null, null, $locale);
    }

    if ($until !== null && $number >= $until) {
        return \Inilim\Tool\Method\Integer\format($number, null, null, $locale);
    }

    $formatter = new \NumberFormatter($locale ?? \Inilim\Tool\Method\Integer\__state()->locale, \NumberFormatter::SPELLOUT);

    return $formatter->format($number);
}
