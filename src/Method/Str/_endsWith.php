<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function _endsWith(string $haystack, string $needle): bool
{
    return \Inilim\Tool\Method\PF\str_ends_with($haystack, $needle);
}
