<?php

namespace Inilim\Tool;

class Other
{
        /**
 * @template T of \Closure
 * @param T $cls
 * @return T
 */
    static function clearClosure(\Closure $cls) {}

        /**
 * @return ?callable
 */
    static function getErrorHandler() {}

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
 * @template TResult of mixed
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return TResult
 */
    static function tryCallWithErrHandler(callable $callable, ?callable $handler, int $errorLevels = \E_ALL) {}

    }