<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $object
 * @return null|\ReflectionProperty<T>
 */
function getProp($objectOrClass, string $name, bool $throw = false)
{
    $name = \Inilim\Tool\Method\Other\unprefixVar($name);
    $ref = \Inilim\Tool\Method\Refl\_class($objectOrClass, $throw);
    if ($ref === null) {
        return null;
    }

    try {
        return $ref->getProperty($name);
    } catch (\ReflectionException $e) {
        return $throw
            ? throw $e
            : null;
    }
}
