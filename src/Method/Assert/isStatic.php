<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @author webmozarts/assert
 *
 * @param mixed $callable
 * @param string|callable():string $message
 *
 * @return \Closure|string
 *
 * @throws \InvalidArgumentException
 */
function isStatic($callable, $message = '')
{
    \Inilim\Tool\Method\Assert\isCallable($callable, $message);

    if (\is_string($callable) && \function_exists($callable)) {
        $reflection = new \ReflectionFunction($callable);
    } elseif ($callable instanceof \Closure) {
        $reflection = new \ReflectionFunction($callable);
    } else {
        $callable = \Closure::fromCallable($callable);
        $reflection = new \ReflectionFunction($callable);
    }

    if (!$reflection->isStatic()) {
        $message = \Inilim\Tool\Method\Assert\__resolveMessage($message);
        \Inilim\Tool\Method\Assert\__reportInvalidArgument(
            $message ?: 'Closure is not static.'
        );
    }

    return $callable;
}