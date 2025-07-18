<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @psalm-pure
 * @psalm-assert countable $value
 * @param mixed  $value
 */
function isCountable($value): bool
{
    if (
        !\is_array($value)
        && !($value instanceof \Countable)
        && !($value instanceof \ResourceBundle)
        && !($value instanceof \SimpleXMLElement)
    ) {
        return false;
    }
    return true;
}
