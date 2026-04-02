<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true iterable $value
 * @phpstan-assert-if-true iterable $value
 * 
 * 
 * @param mixed $value
 */
function isIterable($value): bool
{
    // return \is_array($value) || $value instanceof \Traversable;
    return \is_iterable($value);
}
