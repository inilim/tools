<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert false $value
 * @phpstan-assert false $value
 * 
 * @param mixed $value
 * @throws \InvalidArgumentException
 */
function boolFalse($value, string $message = '')
{
    if ($value !== false) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a value to be false. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
