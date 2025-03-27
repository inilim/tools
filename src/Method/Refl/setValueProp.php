<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @return bool
 */
function setValueProp(object $object, string $name, $value, bool $throw = false)
{
    $prop = \Inilim\Tool\Method\Refl\getProp($object, $name, $throw);
    if ($prop === null) {
        return false;
    }
    $prop->setAccessible(true);
    $prop->setValue($object, $value);
    return true;
}
