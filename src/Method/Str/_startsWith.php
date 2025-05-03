<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function _startsWith(string $haystack, string $needle): bool
{
    return \Inilim\Tool\Method\PF\str_starts_with($haystack, $needle);
}
