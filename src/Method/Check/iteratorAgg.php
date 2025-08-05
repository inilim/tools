<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true \IteratorAggregate $value
 * @phpstan-assert-if-true \IteratorAggregate $value
 * @param mixed $value
 */
function iteratorAgg($value): bool
{
    return $value instanceof \IteratorAggregate;
}
