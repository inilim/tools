<?php

namespace Inilim\Tool\Method\Other;

/**
 * @param object|class-string $objectOrClass
 * @return ?\ReflectionClass
 */
function getReflectionClass($objectOrClass, bool $throw = false)
{
    if (\is_string($objectOrClass)) {
        if (!\class_exists($objectOrClass)) {
            return $throw
                ? throw new \ReflectionException('class not found ' . $objectOrClass)
                : null;
        }
    }
    return new \ReflectionClass($objectOrClass);
}
