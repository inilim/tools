<?php

namespace Inilim\Tool;

class Refl
{
   /**
    * @template T
    * @param object<T>|class-string<T> $objectOrClass
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
}
