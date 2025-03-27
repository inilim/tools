<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @template T of object
 * @param T|\ReflectionClass<T> $object
 * @return null|\ReflectionProperty
 */
function getProp($object, string $name, bool $throw = false)
{
    if ($object instanceof \ReflectionClass) {
        $ref = $object;
    } else {
        $ref = \Inilim\Tool\Method\Refl\_class($object, $throw);
        if ($ref === null) {
            return null;
        }
    }

    try {
        return $ref->getProperty($name);
    } catch (\ReflectionException $e) {
        return $throw
            ? throw $e
            : null;
    }
}
