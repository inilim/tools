<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

function str_starts_with(string $haystack, string $needle): bool
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return \str_starts_with($haystack, $needle);
    }
    return 0 === \strncmp($haystack, $needle, \strlen($needle));
}
