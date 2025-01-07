<?php

namespace Inilim\Tool\Method\Other;

\Inilim\Tool\Other::__include('getReflectionClass');

/**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @return \ReflectionAttribute[]|array{}|null
 */
function getRefAttrClass($classOrObjOrRef, bool $throw = false): ?array
{
    if (\PHP_VERSION_ID < 80000) {
        return null;
    }

    if ($classOrObjOrRef instanceof \ReflectionClass) {
        $ref = $classOrObjOrRef;
    } else {
        $ref = getReflectionClass($classOrObjOrRef, $throw);
    }

    if ($ref === null) {
        return null;
    }
    return $ref->getAttributes();
}
