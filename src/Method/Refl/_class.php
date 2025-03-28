<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $objectOrClass
 * @return ?\ReflectionClass<T>
 */
function _class($objectOrClass, bool $throw = false)
{
    try {
        return new \ReflectionClass($objectOrClass);
    } catch (\ReflectionException $e) {
        return $throw
            ? throw $e
            : null;
    }
}
