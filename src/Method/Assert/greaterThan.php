<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 *
 * @param mixed $value
 * @param mixed $limit
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function greaterThan($value, $limit, $message = '')
{
    if ($value <= $limit) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value greater than %2$s. Got: %s',
            \Inilim\Tool\Method\Other\valueToString($value),
            \Inilim\Tool\Method\Other\valueToString($limit)
        ));
    }

    return $value;
}