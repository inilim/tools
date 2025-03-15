<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @return \ReflectionAttribute[]|null
 */
function attrProperty(\ReflectionProperty $prop)
{
    if (\PHP_VERSION_ID < 80000) {
        return null;
    }

    return $prop->getAttributes();
}
