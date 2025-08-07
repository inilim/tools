<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 *
 * @param string[] $array
 */
function stringEndsWithInArray(array $array, string $needle, bool $ignoreCase = false): bool
{
    foreach ($array as $string) {
        if ($ignoreCase) {
            if (\Inilim\Tool\Method\Str\iEndsWithOnce($string, $needle)) {
                return true;
            }
        } else {
            if (\Inilim\Tool\Method\PF\str_ends_with($string, $needle)) {
                return true;
            }
        }
    }
    return false;
}
