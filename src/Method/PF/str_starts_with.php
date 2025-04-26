<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @return bool
 */
function str_starts_with(string $haystack, string $needle)
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return \str_starts_with($haystack, $needle);
    }
    return 0 === \strncmp($haystack, $needle, \strlen($needle));
}
