<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @return \ReflectionAttribute[]|null
 */
function attrProp(\ReflectionProperty $prop)
{
    if (\PHP_VERSION_ID < 80000) {
        return null;
    }

    return $prop->getAttributes();
}
