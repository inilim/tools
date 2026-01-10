<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * Validate whether a given input is a Luhn number.
 *
 * @see https://en.wikipedia.org/wiki/Luhn_algorithm
 *
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Inilim
 * 
 * @psalm-assert-if-true string|int $value
 * @phpstan-assert-if-true string|int $value
 * 
 * @param mixed $value
 */
function luhnNumber($value): bool
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) {
        return false;
    }
    $value = (string) $value;
    if (\Inilim\Tool\Method\PF\str_starts_with($value, '-')) {
        return false;
    }

    $digits = [];
    foreach (\str_split($value) as $i) {
        $digits[] = (int)$i;
    }
    // $digits = \array_map('intval', \str_split($value));
    $sum = 0;
    $numDigits = \count($digits);
    $parity = $numDigits % 2;
    for ($i = 0; $i < $numDigits; ++$i) {
        $digit = $digits[$i];
        if ($parity == $i % 2) {
            $digit <<= 1;
            if (9 < $digit) {
                $digit = $digit - 9;
            }
        }
        $sum += $digit;
    }

    return $sum % 10 == 0;
}
