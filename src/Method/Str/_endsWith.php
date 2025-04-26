<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return bool
 */
function _endsWith(string $haystack, string $needle)
{
    return \Inilim\Tool\Method\PF\str_ends_with($haystack, $needle);
}
