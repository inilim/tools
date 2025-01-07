<?php

namespace Inilim\Tool\Method\Other;

\Inilim\Tool\Other::__include('getRefMethodsFromObjOrClass');

/**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $except_methods
 * @return string[]|array{}
 */
function getNameMethodsFromObjOrClass(
    $classOrObjOrRef,
    array $except_methods          = [],
    bool $throw                    = false,
    bool $except_magic_methods     = false,
    bool $except_private_methods   = false,
    bool $except_protected_methods = false,
    bool $except_public_methods    = false,
    bool $except_parent_methods    = false
): array {
    return \array_column(getRefMethodsFromObjOrClass(
        $classOrObjOrRef,
        $except_methods,
        $throw,
        $except_magic_methods,
        $except_private_methods,
        $except_protected_methods,
        $except_public_methods,
        $except_parent_methods,
    ), 'name');
}
