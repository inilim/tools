<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template T of mixed
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return array{result:mixed|T,exception:null|\Throwable,"...":array{mixed|T,null|\Throwable}}
 */
function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null): array
{
    return \Inilim\Tool\Method\Other\tryCallCallable([$objectOrClass, $methodName], $args, $default);
}
