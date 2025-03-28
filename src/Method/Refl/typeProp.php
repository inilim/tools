<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @skip_build
 * @template T of object
 * @param T|class-string<T> $objectOrClass
 * @return null|\ReflectionNamedType
 */
function typeProp($objectOrClass, string $name, bool $throw = false)
{
    $prop = \Inilim\Tool\Method\Refl\getProp($objectOrClass, $name, $throw);
    if ($prop === null) {
        return null;
    }

    return $prop->getType();
}
