<?php

namespace Inilim\Tool\Method\Other;

use Inilim\Tool\Other;

Other::__include('getRefMethodsFromObjOrClass');

/**
 * @param object|class-string|\ReflectionClass $class_or_obj_or_ref
 * @param string[] $except_methods
 * @return string[]|array{}
 */
function getNameMethodsFromObjOrClass(
    $class_or_obj_or_ref,
    array $except_methods          = [],
    bool $throw                    = false,
    bool $except_magic_methods     = false,
    bool $except_private_methods   = false,
    bool $except_protected_methods = false,
    bool $except_public_methods    = false,
    bool $except_parent_methods    = false,
): array {
    return \array_column(Other::getRefMethodsFromObjOrClass(
        class_or_obj_or_ref: $class_or_obj_or_ref,
        except_methods: $except_methods,
        throw: $throw,
        except_magic_methods: $except_magic_methods,
        except_private_methods: $except_private_methods,
        except_protected_methods: $except_protected_methods,
        except_public_methods: $except_public_methods,
        except_parent_methods: $except_parent_methods,
    ), 'name');
}
