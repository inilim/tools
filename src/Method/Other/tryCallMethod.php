<?php

namespace Inilim\Tool\Method\Other;

/**
 * @template T of mixed
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return mixed|T
 */
function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null, ?\Throwable &$exception = null)
{
    return \Inilim\Tool\Method\Other\tryCallCallable([$objectOrClass, $methodName], $args, $default, $exception);
}
