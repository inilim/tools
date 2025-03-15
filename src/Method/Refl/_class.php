<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @template T
 * @param object<T>|class-string<T> $objectOrClass
 * @return ?\ReflectionClass<T>
 */
function _class($objectOrClass, bool $throw = false)
{
    if (\is_string($objectOrClass)) {
        if (!\class_exists($objectOrClass)) {
            return $throw
                ? throw new \ReflectionException('class not found ' . $objectOrClass)
                : null;
        }
    } elseif ($objectOrClass instanceof \ReflectionClass) {
        return $objectOrClass;
    }
    return new \ReflectionClass($objectOrClass);
}
