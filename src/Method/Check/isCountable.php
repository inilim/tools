<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * @deprecated use Check::countable
 * @psalm-pure
 * @psalm-assert-if-true mixed[]\Countable|\ResourceBundle|\SimpleXMLElement $value
 * @phpstan-assert-if-true mixed[]\Countable|\ResourceBundle|\SimpleXMLElement $value
 * 
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
