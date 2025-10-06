<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author inilim
 * @psalm-pure
 * @param mixed  $value
 * @throws \InvalidArgumentException
 */
function regex($value, string $message = '')
{
    if (!\Inilim\Tool\Method\Check\regex($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Expected a regex. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }
}
