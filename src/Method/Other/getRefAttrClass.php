<?php

namespace Inilim\Method\Other;

use Inilim\Tool\Other;

Other::__include('getReflectionClass');

/**
 * @param object|class-string|\ReflectionClass $class_or_obj_or_ref
 * @return \ReflectionAttribute[]|array{}|null
 */
function getRefAttrClass($class_or_obj_or_ref, bool $throw = false): ?array
{
    if ($class_or_obj_or_ref instanceof \ReflectionClass) {
        $ref = $class_or_obj_or_ref;
    } else {
        $ref = Other::getReflectionClass($class_or_obj_or_ref, $throw);
    }
    return $ref?->getAttributes();
}
