<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T1 of mixed
 * @template T2 of mixed
 * @psalm-assert T2 $value
 * @phpstan-assert T2 $value
 * 
 *
 * @param T1 $value
 * @param T2 $expect
 * 
 * @throws \InvalidArgumentException
 */
function same($value, $expect, string $message = '')
{
    if ($expect !== $value) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a value identical to %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($expect)
        ));
    }
}
