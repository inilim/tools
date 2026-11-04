<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert int<1,max> $value
 * @phpstan-assert int<1,max> $value
 * 
 * @template T
 * 
 * @param mixed  $value
 * @param string|callable():string $message
 * @return T
 * @throws \InvalidArgumentException
 */
function positiveInteger($value, $message = '')
{

    if (!\Inilim\Tool\Method\Check\positiveInteger($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a positive integer. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value)
        ));
    }

    return $value;
}
