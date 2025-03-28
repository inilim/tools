<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @return \ReflectionAttribute[]|null
 */
function attrClass($classOrObjOrRef, bool $throw = false)
{
    if (\PHP_VERSION_ID < 80000) {
        return null;
    }

    if ($classOrObjOrRef instanceof \ReflectionClass) {
        $ref = $classOrObjOrRef;
    } else {
        $ref = \Inilim\Tool\Method\Refl\_class($classOrObjOrRef, $throw);
    }

    if ($ref === null) {
        return null;
    }
    return $ref->getAttributes();
}
