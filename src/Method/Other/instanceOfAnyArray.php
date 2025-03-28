<?php

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @param (class-string|object)[] $classes
 * @return bool
 */
function instanceOfAnyArray(object $obj, array $classes)
{
    foreach ($classes as $class) {
        $class = \is_object($class) ? \get_class($class) : $class;
        if (\is_a($obj, $class)) {
            return true;
        }
    }
    return false;
}
