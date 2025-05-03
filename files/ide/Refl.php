<?php

namespace Inilim\Tool;

class Refl
{
        /**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $classOrObj
 * @return ?\ReflectionClass<T>
 */
    static function _class($classOrObj, bool $throw = false) {}

        /**
 * @author Inilim
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @return \ReflectionAttribute[]|null
 */
    static function attrClass($classOrObjOrRef, bool $throw = false) {}

        /**
 * @author Inilim
 * @return \ReflectionAttribute[]|null
 */
    static function attrMethod(\ReflectionMethod $method) {}

        /**
 * @author Inilim
 * @return \ReflectionAttribute[]|null
 */
    static function attrProp(\ReflectionProperty $prop) {}

        /**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $object
 * @return null|\ReflectionProperty<T>
 */
    static function getProp($objectOrClass, string $name, bool $throw = false) {}

        /**
 * @author Inilim
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $exceptMethods
 * @return \ReflectionMethod[]
 */
    static function methodsFromObjOrClass($classOrObjOrRef, array $exceptMethods = [], bool $throw = false, bool $exceptMagicMethods = false, bool $exceptPrivateMethods = false, bool $exceptProtectedMethods = false, bool $exceptPublicMethods = false, bool $exceptParentMethods = false) {}

        /**
 * @author Inilim
 * @param object|class-string|\ReflectionClass $classOrObjOrRef
 * @param string[] $exceptMethods
 * @return string[]
 */
    static function nameMethodsFromObjOrClass($classOrObjOrRef, array $exceptMethods = [], bool $throw = false, bool $exceptMagicMethods = false, bool $exceptPrivateMethods = false, bool $exceptProtectedMethods = false, bool $exceptPublicMethods = false, bool $exceptParentMethods = false): array {}

        /**
 * @author Inilim
 * @template T of object
 * @param T|class-string<T> $objectOrClass
 * @param mixed $value
 */
    static function setValueProp($objectOrClass, string $name, $value, bool $throw = false): bool {}

    }