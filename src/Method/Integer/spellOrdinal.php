<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Spell out the given number in the given locale in ordinal form.
 *
 * @param  int|float  $number
 * @return string
 */
function spellOrdinal($number, ?string $locale = null)
{
    if (!\Inilim\Tool\Method\Other\extPhp('intl')) {
        throw new \RuntimeException('The "intl" PHP extension is required to use the [spell] function.');
    }

    $formatter = new \NumberFormatter($locale ?? \Inilim\Tool\Method\Integer\__state()->locale, \NumberFormatter::SPELLOUT);

    $formatter->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, '%spellout-ordinal');

    return $formatter->format($number);
}
