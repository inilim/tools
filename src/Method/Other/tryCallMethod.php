<?php

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template T of mixed
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return array{result:mixed|T,exception:null|\Throwable}
 */
function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null)
{
    return \Inilim\Tool\Method\Other\tryCallCallable([$objectOrClass, $methodName], $args, $default);
}
