<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @return ?object
 */
function getCallableThis(callable $callable)
{
    $type = \gettype($callable);
    if ($type === 'object') {
        /** @var object $callable */
        if ($callable instanceof \Closure) {
            return (new \ReflectionFunction($callable))->getClosureThis();
        }
        return $callable;
    } else if ($type === 'array' && \is_object($callable[0])) {
        return $callable[0];
    }
    return null;
}
