<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $objectOrClass
 * @param mixed $value
 */
function setValueProp($objectOrClass, string $name, $value, bool $throw = false): bool
{
    $prop = \Inilim\Tool\Method\Refl\getProp($objectOrClass, $name, $throw);
    if ($prop === null) {
        return false;
    }

    $prop->setAccessible(true);

    try {
        $prop->setValue($objectOrClass, $value);
    } catch (\Throwable $e) {
        if ($throw) {
            throw $e;
        }
        return null;
    }
    return true;
}
