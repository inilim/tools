<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @return bool
 */
function str_contains(string $haystack, string $needle)
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return \str_contains($haystack, $needle);
    }
    return '' === $needle || false !== \strpos($haystack, $needle);
}
