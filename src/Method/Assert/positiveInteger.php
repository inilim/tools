<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert positive-int $value
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function positiveInteger($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\positiveInteger($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a positive integer. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
