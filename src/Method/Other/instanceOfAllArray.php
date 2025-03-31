<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @param (class-string|object)[] $classes
 * @return bool
 */
function instanceOfAllArray(object $obj, array $classes)
{
    foreach ($classes as $class) {
        $class = \is_object($class) ? \get_class($class) : $class;
        if (!\is_a($obj, $class)) {
            return false;
        }
    }
    return true;
}
