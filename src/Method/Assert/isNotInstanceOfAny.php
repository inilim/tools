<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @template T
 * @psalm-assert object|class-string $value
 * @phpstan-assert object|class-string $value
 *
 * @param mixed $value
 * @param iterable<class-string> $classes
 * @param string|callable():string $message
 *
 * @return mixed
 *
 * @throws \InvalidArgumentException
 */
function isNotInstanceOfAny($value, $classes, $message = '')
{
    \Inilim\Tool\Method\Assert\isIterable($classes);

    foreach ($classes as $class) {
        \Inilim\Tool\Method\Assert\string($class, 'Expected class as a string. Got: %s');

        if ($value instanceof $class) {
            $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
            \Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf(
                $message ?: 'Expected not an instance of %2$s. Got: %s',
                \Inilim\Tool\Method\Assert\__typeToString($value),
                \implode(', ', \array_map('\Inilim\Tool\Method\Other\valueToString', \iterator_to_array($classes)))
            ));
        }
    }

    return $value;
}