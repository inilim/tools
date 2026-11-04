<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @psalm-pure
 * @template T as class-string|object
 *
 * @param T $classOrObject
 * @param string $method
 * @param string|callable():string $message
 *
 * @return T
 *
 * @throws \InvalidArgumentException
 */
function methodNotExists($classOrObject, $method, $message = '')
{
    \Inilim\Tool\Method\Assert\objectish($classOrObject);

    if (\method_exists($classOrObject, $method)) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
            $message ?: 'Expected the method %s to not exist.',
            \Inilim\Tool\Method\Other\valueToString($method)
        ));
    }

    return $classOrObject;
}