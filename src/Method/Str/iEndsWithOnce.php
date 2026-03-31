<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author inilim
 */
function iEndsWithOnce(string $haystack, string $needle): bool
{
    \Inilim\Tool\Method\Assert\extPhp('mbstring');
    return '' === $needle || \mb_stripos($haystack, $needle, -\mb_strlen($needle, 'UTF-8'), 'UTF-8') !== false;
}
