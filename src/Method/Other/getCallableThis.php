<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @tests tests/Method/Other/getCallableThisTest.php
 * @author inilim
 */
function getCallableThis(callable $callable): ?object
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
