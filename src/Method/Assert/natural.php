<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert positive-int|0 $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function natural($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\natural($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a non-negative integer. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
