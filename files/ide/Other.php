<?php

namespace Inilim\Tool;

class Other
{
   /**
    * @return \Closure
    */
   static function clearClosure(\Closure $cls) {}

   /**
    * @return void
    */
   static function clearClosureRef(\Closure &$cls) {}

   /**
    * @return ?callable
    */
   static function getErrorHandler() {}

   /**
    * @template T of bool
    * @psalm-type Trace = (T is true ? array : string)
    * @psalm-return array{message:string,line:int,code:int,file:string,trace:Trace,class:class-string}
    * @param T $traceAsArray
    */
   static function getExceptionDetails(\Throwable $e, bool $traceAsArray = false) {}

   /**
    * Possibles values for the returned string are: "boolean" "integer" "float" "string" "array" "object" "object exception" "enum" "resource" "null" "unknown type" "resource (closed)"
    * @param mixed $v
    * @return string
    */
   static function getType($v) {}

   /**
    * @param class-string|object ...$classes
    * @return bool
    */
   static function instanceOfAll(object $obj, ...$classes) {}

   /**
    * @param (class-string|object)[] $classes
    * @return bool
    */
   static function instanceOfAllArray(object $obj, array $classes) {}

   /**
    * @param class-string|object ...$classes
    * @return bool
    */
   static function instanceOfAny(object $obj, ...$classes) {}

   /**
    * @param (class-string|object)[] $classes
    * @return bool
    */
   static function instanceOfAnyArray(object $obj, array $classes) {}

   /**
    * @param mixed $v
    * @return boolean
    */
   static function isEnum($v) {}

   /**
    * @param callable(int,int):bool $condition
    * @param callable(int,int) $onBreak
    * @return void
    */
   static function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null) {}

   /**
    * @return void
    */
   static function prepareArrayForSerializeRecursive(array &$value) {}

   /**
    * @return mixed
    */
   static function prepareObjForSerialize(object $obj) {}

   /**
    * @template C
    * @template D
    * @template A
    * 
    * @param callable(...A):C $callable
    * @param array<A> $args
    * @param D $default
    * @return C|D
    */
   static function tryCallCallable($callable, array $args = [], $default = null, ?\Throwable &$exception = null) {}

   /**
    * @template T of mixed
    * @param T $default
    * @param object|class-string $objectOrClass
    * @return mixed|T
    */
   static function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null, ?\Throwable &$exception = null) {}

   /**
    * @template TResult of mixed
    * @template TObj of \stdClass
    * @param callable(TObj):TResult $callable
    * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
    * @return TResult
    */
   static function tryCallWithErrHandler(callable $callable, ?callable $handler, int $errorLevels = \E_ALL) {}
}
