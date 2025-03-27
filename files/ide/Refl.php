<?php

namespace Inilim\Tool;

class Refl
{
        /**
 * @template T of object|class-string
 * @param T $objectOrClass
 * @return ?\ReflectionClass<T>
 */
    static function _class($objectOrClass, bool $throw = false) {}

        /**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @return \ReflectionAttribute[]|null
 */
    static function attrClass($classOrObjOrRef, bool $throw = false) {}

        /**
 * @return \ReflectionAttribute[]|null
 */
    static function attrMethod(\ReflectionMethod $method) {}

        /**
 * @return \ReflectionAttribute[]|null
 */
    static function attrProperty(\ReflectionProperty $prop) {}

        /**
 * @template T of object
 * @param T|\ReflectionClass<T> $object
 * @return null|\ReflectionProperty
 */
    static function getProp($object, string $name, bool $throw = false) {}

        /**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $exceptMethods
 * @return \ReflectionMethod[]
 */
    static function methodsFromObjOrClass($classOrObjOrRef, array $exceptMethods = [], bool $throw = false, bool $exceptMagicMethods = false, bool $exceptPrivateMethods = false, bool $exceptProtectedMethods = false, bool $exceptPublicMethods = false, bool $exceptParentMethods = false) {}

        /**
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $exceptMethods
 * @return string[]
 */
    static function nameMethodsFromObjOrClass($classOrObjOrRef, array $exceptMethods = [], bool $throw = false, bool $exceptMagicMethods = false, bool $exceptPrivateMethods = false, bool $exceptProtectedMethods = false, bool $exceptPublicMethods = false, bool $exceptParentMethods = false): array {}

        /**
 * @return bool
 */
    static function setValueProp(object $object, string $name, $value, bool $throw = false) {}

    }