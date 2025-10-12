<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Refl;

/**
 * @author Inilim
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $exceptMethods
 * @return \ReflectionMethod[]
 */
function methodsFromObjOrClass(
    $classOrObjOrRef,
    array $exceptMethods         = [],
    bool $throw                  = false,
    bool $exceptMagicMethods     = false,
    bool $exceptPrivateMethods   = false,
    bool $exceptProtectedMethods = false,
    bool $exceptPublicMethods    = false,
    bool $exceptParentMethods    = false
) {

    if ($classOrObjOrRef instanceof \ReflectionClass) {
        $ref = $classOrObjOrRef;
    } else {
        $ref = \Inilim\Tool\Method\Refl\_class($classOrObjOrRef, $throw);
    }

    if ($ref === null) return [];

    $methods = $ref->getMethods();

    if (!$methods) {
        return [];
    }

    if ($exceptParentMethods) {
        $refParent = $ref->getParentClass();
    }
    if ($exceptMagicMethods) {
        $magicMethods = \Inilim\Tool\Method\Data\magicMethodsAsArray();
    }

    foreach ($methods as $idx => $m) {

        if ($exceptParentMethods && $refParent && $m->class === $refParent->name) {
            unset($methods[$idx]);
            continue;
        }

        if ($exceptPrivateMethods && $m->isPrivate()) {
            unset($methods[$idx]);
            continue;
        }

        if ($exceptProtectedMethods && $m->isProtected()) {
            unset($methods[$idx]);
            continue;
        }

        if ($exceptPublicMethods && $m->isPublic()) {
            unset($methods[$idx]);
            continue;
        }

        if ($exceptMethods && \in_array($m->name, $exceptMethods)) {
            unset($methods[$idx]);
            continue;
        }

        if ($exceptMagicMethods && \in_array($m->name, $magicMethods)) {
            unset($methods[$idx]);
        }
    }

    return \array_values($methods);
}
