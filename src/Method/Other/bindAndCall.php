<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @todo tests
 * $callback after call clear bind
 * @template R
 * @template A
 * @param \Closure(A):R $callback
 * @param A ...$args
 * @return R
 */
function bindAndCall(object $object, \Closure $callback, ...$args)
{
    $result = $callback->bindTo($object, $object)->__invoke(...$args);
    \Inilim\Tool\Method\Other\clearClosure($callback);
    return $result;
}
