<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated use PF::str_contains
 */
function _contains(string $haystack, string $needle): bool
{
    return \Inilim\Tool\Method\PF\str_contains($haystack, $needle);
}
