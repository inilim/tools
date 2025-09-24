<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 */
function bcdivmod(string $num1, string $num2, ?int $scale = null): ?array
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \bcdivmod($num1, $num2, $scale);
    }

    if (null === $quot = \bcdiv($num1, $num2, 0)) {
        return null;
    }
    $scale = $scale ?? (\PHP_VERSION_ID >= 70300 ? \bcscale() : (\ini_get('bcmath.scale') ?: 0));

    return [$quot, \bcmod($num1, $num2, $scale)];
}
