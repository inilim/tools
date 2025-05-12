<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $classOrObj
 * @return ?\ReflectionClass<T>
 */
function _class($classOrObj, bool $throw = false)
{
    try {
        return new \ReflectionClass($classOrObj);
    } catch (\ReflectionException $e) {
        if ($throw) {
            throw $e;
        }
        return null;
    }
}
