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
        $prop = $ref->getProperty($name);
        if (!\Inilim\Tool\Method\Check\php81()) {
            $prop->setAccessible(true);
        }
        return $prop;
    } catch (\ReflectionException $e) {
        if ($throw) {
            throw $e;
        }
        return null;
    }
}
