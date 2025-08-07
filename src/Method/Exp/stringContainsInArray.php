<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 *
 * @param string[] $array
 */
function stringContainsInArray(array $array, string $needle, bool $ignoreCase = false): bool
{
    if ($ignoreCase) {
        return \Inilim\Tool\Method\Str\iContainsOnce(
            \implode('', $array),
            $needle
        );
    } else {
        return \Inilim\Tool\Method\PF\str_contains(
            \implode('', $array),
            $needle
        );
    }
}
