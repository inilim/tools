<?php

namespace Inilim\Tool\Method\Refl;

/**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $exceptMethods
 * @return string[]
 */
function nameMethodsFromObjOrClass(
    $classOrObjOrRef,
    array $exceptMethods         = [],
    bool $throw                  = false,
    bool $exceptMagicMethods     = false,
    bool $exceptPrivateMethods   = false,
    bool $exceptProtectedMethods = false,
    bool $exceptPublicMethods    = false,
    bool $exceptParentMethods    = false
): array {
    return \array_column(\Inilim\Tool\Method\Refl\methodsFromObjOrClass(
        $classOrObjOrRef,
        $exceptMethods,
        $throw,
        $exceptMagicMethods,
        $exceptPrivateMethods,
        $exceptProtectedMethods,
        $exceptPublicMethods,
        $exceptParentMethods,
    ), 'name');
}
