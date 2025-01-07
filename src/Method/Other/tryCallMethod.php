<?php

namespace Inilim\Tool\Method\Other;

\Inilim\Tool\Other::__include('tryCallCallable');

/**
 * @template T
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return mixed|T
 */
function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null, ?\Throwable &$exception = null)
{
    return tryCallCallable([$objectOrClass, $methodName], $args, $default, $exception);
}
