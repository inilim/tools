<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return bool
 */
function _startsWith(string $haystack, string $needle)
{
    return \Inilim\Tool\Method\PF\str_starts_with($haystack, $needle);
}
