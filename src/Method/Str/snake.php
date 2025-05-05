<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @todo проблема с php74 preg_replace отдает null из-за модификатора "u"
 * Convert a string to snake case.
 */
function snake(string $value, string $delimiter = '_'): string
{
    if (!\Inilim\Tool\Method\PF\ctype_lower($value)) {
        $modeU = \Inilim\Tool\Method\Check\php80() ? 'u' : '';
        $value = \preg_replace('/\s+/' . $modeU, '', \ucwords($value));
        $value = \Inilim\Tool\Method\Str\lower(\preg_replace('/(.)(?=[A-Z])/' . $modeU, '$1' . $delimiter, $value));
    }

    return $value;
}
