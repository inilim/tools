<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author Ashot1995 <https://github.com/Ashot1995>
 * @author inilim
 * @ext mbstring
 * @param  string  $value
 * @param  string  $separator
 * @return string
 */
function initials(string $value, string $separator = '')
{
    \Inilim\Tool\Method\Assert\extPhp('mbstring');
    $value = \Inilim\Tool\Method\Str\trim($value);
    $value = \Inilim\Tool\Method\Str\unixNewLines($value, " ");
    return \implode($separator, \array_map(
        static fn($word) => \mb_strtoupper(\mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8'),
        \preg_split('/\s+/', $value)
    ));
}
