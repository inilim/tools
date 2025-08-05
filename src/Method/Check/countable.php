<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author webmozarts/assert
 * @psalm-import-type Main_Countable from \TypeMain
 * @psalm-assert-if-true Main_Countable $value
 * @phpstan-assert-if-true Main_Countable $value
 * 
 * @param mixed $value
 */
function countable($value): bool
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
