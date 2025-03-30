<?php

namespace Inilim\Tool;

class Other
{
        /**
 * @author Inilim
 * @template T of \Closure
 * @param T $cls
 * @return T
 */
    static function clearClosure(\Closure $cls) {}

        /**
 * @author Inilim
 * @return null|class-string
 */
    static function getClosureScopeClass(\Closure $cls) {}

        /**
 * @author Internet
 * @return ?callable
 */
    static function getErrorHandler() {}

        /**
 * @author Inilim
 * @template T of bool
 * @psalm-type Trace = (T is true ? array : string)
 * @psalm-return array{message:string,line:int,code:int,file:string,trace:Trace,class:class-string}
 * @param T $traceAsArray
 */
    static function getExceptionDetails(\Throwable $e, bool $traceAsArray = false) {}

        /**
 * @author Inilim
 * Possibles values for the returned string are: "boolean" "integer" "float" "string" "array" "object" "object exception" "enum" "resource" "null" "unknown type" "resource (closed)"
 * @param mixed $v
 * @return string
 */
    static function getType($v) {}

        /**
 * @author Inilim
 * @param class-string|object ...$classes
 * @return bool
 */
    static function instanceOfAll(object $obj, ...$classes) {}

        /**
 * @author Inilim
 * @param (class-string|object)[] $classes
 * @return bool
 */
    static function instanceOfAllArray(object $obj, array $classes) {}

        /**
 * @author Inilim
 * @param class-string|object ...$classes
 * @return bool
 */
    static function instanceOfAny(object $obj, ...$classes) {}

        /**
 * @author Inilim
 * @param (class-string|object)[] $classes
 * @return bool
 */
    static function instanceOfAnyArray(object $obj, array $classes) {}

        /**
 * @author Inilim
 * @param mixed $v
 * @return boolean
 */
    static function isEnum($v) {}

        /**
 * @author Inilim
 * @param callable(int,int):bool $condition
 * @param callable(int,int) $onBreak
 * @return void
 */
    static function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null) {}

        /**
 * @author Inilim
 * @return string
 */
    static function phpInput() {}

        /**
 * @author Internet
 * @return array<string,string>
 */
    static function requestHeaders(?array $_server = null) {}

        /**
 * @author Symfony
 * @return array<string,string>
 */
    static function requestHeadersV2(?array $_server = null) {}

        /**
 * @author Internet
 * @return string
 */
    static function requestMethod() {}

        /**
 * @author Inilim
 * @template C of mixed
 * @template D of mixed
 * @template A of mixed
 * 
 * @param callable(...A):C $callable
 * @param array<A> $args
 * @param D $default
 * @return array{result:C|D,exception:null|\Throwable}
 */
    static function tryCallCallable(callable $callable, array $args = [], $default = null) {}

        /**
 * @author Inilim
 * @template T of mixed
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return array{result:mixed|T,exception:null|\Throwable}
 */
    static function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null) {}

        /**
 * @author Inilim
 * @template TResult of mixed
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return TResult
 */
    static function tryCallWithErrHandler(callable $callable, ?callable $handler, int $errorLevels = \E_ALL) {}

        /**
 * @author Inilim
 * @return string
 */
    static function unprefixVar(string $name) {}

    }