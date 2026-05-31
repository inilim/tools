<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @template R
 * @template A
 * @param \Closure(A):R $callback
 * @param A ...$args
 * @return R
 */
function bindAndCall(object $object, \Closure $callback, ...$args)
{
    return $callback->bindTo($object, $object)(...$args);;
}
