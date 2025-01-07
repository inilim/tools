<?php

namespace Inilim\Tool\Method\Other;

\Inilim\Tool\Data::__include('magicMethodsAsArray');
\Inilim\Tool\Other::__include('getReflectionClass');

/**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $except_methods
 * @return \ReflectionMethod[]|array{}
 */
function getRefMethodsFromObjOrClass(
    $classOrObjOrRef,
    array $except_methods          = [],
    bool $throw                    = false,
    bool $except_magic_methods     = false,
    bool $except_private_methods   = false,
    bool $except_protected_methods = false,
    bool $except_public_methods    = false,
    bool $except_parent_methods    = false
): array {

    if ($classOrObjOrRef instanceof \ReflectionClass) {
        $ref = $classOrObjOrRef;
    } else {
        $ref = getReflectionClass($classOrObjOrRef, $throw);
    }

    if ($ref === null) return [];

    $methods = $ref->getMethods();

    if (!$methods) {
        return [];
    }

    if ($methods && $except_parent_methods) {
        $refParent = $ref->getParentClass();
        if ($refParent) {
            $parent_class = $refParent->name;
            $methods = \array_filter($methods, static fn($m) => $m->class !== $parent_class);
        }
    }
    unset($refParent, $parent_class, $ref);

    if ($methods && $except_private_methods) {
        $methods = \array_filter($methods, static fn($m) => !$m->isPrivate());
    }

    if ($methods && $except_protected_methods) {
        $methods = \array_filter($methods, static fn($m) => !$m->isProtected());
    }

    if ($methods && $except_public_methods) {
        $methods = \array_filter($methods, static fn($m) => !$m->isPublic());
    }

    if ($methods && $except_methods) {
        $methods = \array_filter($methods, static fn($m) => !\in_array($m->name, $except_methods));
    }

    if ($methods && $except_magic_methods) {
        $magic_methods = \Inilim\Tool\Method\Data\magicMethodsAsArray();
        $methods = \array_filter($methods, static fn($m) => !\in_array($m->name, $magic_methods));
        unset($magic_methods);
    }

    return $methods;
}
