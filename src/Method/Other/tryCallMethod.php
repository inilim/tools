<?php

namespace Inilim\Method\Other;

use Inilim\Tool\Other;

Other::__include('tryCallCallable');

/**
 * @template T
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return mixed|T
 */
function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null, ?\Throwable &$exception = null)
{
    return Other::tryCallCallable([$objectOrClass, $methodName], $args, $default, $exception);
}
