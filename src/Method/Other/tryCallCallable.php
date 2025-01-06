<?php

namespace Inilim\Method\Other;

/**
 * @template C
 * @template D
 * @template A
 * 
 * @param callable(...A):C $callable
 * @param array<A> $args
 * @param D $default
 * @return C|D
 */
function tryCallCallable($callable, array $args = [], $default = null, ?\Throwable &$exception = null)
{
    try {
        if (!\is_callable($callable)) {
            throw new \Exception('$callable give not callable');
        }
        $result = \call_user_func($callable, ...$args);
    } catch (\Throwable $e) {
        $exception = $e;
        return $default;
    }
    return $result;
}
