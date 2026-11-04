<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T as class-string|object
 *
 * @param T $classOrObject
 * @param string $property
 * @param string|callable():string $message
 *
 * @return T
 *
 * @throws \InvalidArgumentException
 */
function propertyNotExists($classOrObject, $property, $message = '')
{
    if (!(\is_string($classOrObject) || \is_object($classOrObject)) || \property_exists($classOrObject, $property)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected the property %s to not exist.',
            \Inilim\Tool\Method\Other\valueToString($property)
        ));
    }

    return $classOrObject;
}