<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * 
 * @psalm-pure
 *
 * @psalm-assert !empty $value
 *
 * @param string|callable():string $message
 *
 * @return mixed
 * 
 * @throws \InvalidArgumentException
 */
function notEmpty($value, $message = '')
{
    if (!\Inilim\Tool\Method\Check\notEmpty($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a non-empty value. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}
