<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @psalm-assert object $value
 * @phpstan-assert object $value
 *
 * @param mixed $value
 * @param string $property
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function isInitialized($value, string $property, $message = '')
{
    \Inilim\Tool\Method\Assert\object($value);

    $reflectionProperty = new \ReflectionProperty($value, $property);

    if (!$reflectionProperty->isInitialized($value)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected property %s to be initialized.',
            $property
        ));
    }

    return $value;
}