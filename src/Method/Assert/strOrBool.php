<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert string|bool $value
 * @phpstan-assert string|bool $value
 * 
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function strOrBool($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\strOrBool($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a string or bool. Got: %s',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
}
