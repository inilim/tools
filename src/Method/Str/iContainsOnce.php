<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author inilim
 * @ext mbstring
 */
function iContainsOnce(string $haystack, string $needle): bool
{
    return '' === $needle || \mb_stripos($haystack, $needle, 0, 'UTF-8') !== false;
}
