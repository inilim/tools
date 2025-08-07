<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 *
 * @param string[] $array
 */
function stringStartsWithInArray(array $array, string $needle, bool $ignoreCase = false): bool
{
    foreach ($array as $string) {
        if ($ignoreCase) {
            if (\Inilim\Tool\Method\Str\iStartsWithOnce($string, $needle)) {
                return true;
            }
        } else {
            if (\Inilim\Tool\Method\PF\str_starts_with($string, $needle)) {
                return true;
            }
        }
    }
    return false;
}
