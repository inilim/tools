<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @param mixed $value
 * @phpstan-assert-if-true \IteratorAggregate $value
 */
function iteratorAgg($value): bool
{
    if ($value instanceof \IteratorAggregate) {
        return true;
    }
    return false;
}
