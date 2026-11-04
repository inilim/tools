<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 * @template T as callable
 *
 * @param T $expression
 * @param class-string<\Throwable> $class
 * @param string|callable():string $message
 *
 * @return T
 *
 * @throws \InvalidArgumentException
 */
function throws($expression, string $class = \Throwable::class, $message = '')
{
    \Inilim\Tool\Method\Assert\string($class);
    \Inilim\Tool\Method\Assert\isCallable($expression);

    $actual = 'none';

    try {
        $expression();
    } catch (\Throwable $e) {
        $actual = \get_class($e);
        if ($e instanceof $class) {
            return $expression;
        }
    }

    $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);

    \Inilim\Tool\Method\Assert\__reportInvalidArgument($message ?: \sprintf(
        'Expected to throw "%s", got "%s"',
        $class,
        $actual
    ));
}