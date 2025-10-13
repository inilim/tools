<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * like str_decrement only with support for negative numbers
 * @author inilim
 * @throws \InvalidArgumentException
 */
function strDecrement(string $value): string
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($value)) {
        return \Inilim\Tool\Method\PF\str_decrement($value);
    }

    if ($value === '0') {
        return '-' . \Inilim\Tool\Method\PF\str_increment($value);
    } elseif (\Inilim\Tool\Method\PF\str_starts_with($value, '-')) {
        $value = \ltrim($value, '-');
        return '-' . \Inilim\Tool\Method\PF\str_increment($value);
    }
    return \Inilim\Tool\Method\PF\str_decrement($value);
}
