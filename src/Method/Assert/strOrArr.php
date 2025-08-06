<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string|mixed[] $value
 * @phpstan-assert string|mixed[] $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function strOrArr($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\strOrArr($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a string or array. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
