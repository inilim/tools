<?php

namespace Inilim\Tool;

class Other
{
        /**
 * @author inilim
 * 
 * @template TValue og mixed
 * @template TArray of array<int|string,TValue>
 * @template TDots of array{"...":TValue[]}
 * 
 * @param TArray $array
 * @return array{...TArray, ...TDots}
 */
    static function _refDots(array $array): array {}

        /**
 * @author Inilim
 * @return array<array{file:string|null,line:int|null,method:string|null,type:string|null,class:class-string|null,object:object|null,args:mixed[]|null}>
 */
    static function backtrace(int $limit = 0, int $reset = 0, int $flags = \DEBUG_BACKTRACE_IGNORE_ARGS, bool $reverse = true) {}

        /**
 * @author Inilim
 * @template T of \Closure
 * @param T $cls
 * @return T
 */
    static function clearClosure(\Closure $cls) {}

        /**
 * @author nette/utils
 * Compares two values in the same way that PHP does. Recognizes operators: >, >=, <, <=, =, ==, ===, !=, !==, <>
 * @param mixed $left
 * @param mixed $right
 */
    static function compareViaOperator($left, string $operator, $right): bool {}

        /**
 * @author inilim
 */
    static function extPhp(string $ext, bool $rechecking = false): bool {}

        /**
 * @author inilim
 */
    static function funcPhp(string $function, bool $rechecking = false): bool {}

        /**
 * @tests tests/Method/Other/getCallableThisTest.php
 * @author inilim
 * @return ?object
 */
    static function getCallableThis(callable $callable) {}

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
 * @template T of \Throwable
 * @param T $e
 * @return array{message:string,line:int,code:int|string,file:string,trace:($traceAsArray is true ? mixed[] : string),class:class-string<T>}
 */
    static function getExceptionDetails(\Throwable $e, bool $traceAsArray = false, bool $dots = false): array {}

        /**
 * @author Inilim
 * Possibles values for the returned string are: "boolean" "integer" "float" "string" "array" "object" "exception" "enum" "resource" "null" "unknown type" "resource (closed)"
 * @param mixed $v
 * @return 'null'|'array'|'float'|'enum'|'exception'|'object'|'bool'|'int'|'string'|'resource'|'resource (closed)'|'unknown type'
 */
    static function getType($v) {}

        /**
 * @todo to check
 * @author Inilim
 * @param class-string|object ...$classes
 */
    static function instanceOfAll(object $obj, ...$classes): bool {}

        /**
 * @todo to check
 * @author Inilim
 * @param (class-string|object)[] $classes
 */
    static function instanceOfAllArray(object $obj, array $classes): bool {}

        /**
 * @todo to check
 * @author Inilim
 * @param class-string|object ...$classes
 */
    static function instanceOfAny(object $obj, ...$classes): bool {}

        /**
 * @todo to check
 * @author Inilim
 * @param (class-string|object)[] $classes
 */
    static function instanceOfAnyArray(object $obj, array $classes): bool {}

        /**
 * @todo to check
 * @author Inilim
 * @param mixed $v
 */
    static function isEnum($v): bool {}

        /**
 * @author Inilim
 * @param callable(int,int):bool $condition
 * @param callable(int,int) $onBreak
 * @return void
 */
    static function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null) {}

        /**
 * @author inilim
 * @template T of object
 * @param T|class-string<T> $scope
 * @param string $method
 * @param mixed[] $args
 * @return mixed[]
 */
    static function methodFromScope($scope, string $method, array $args = []) {}

        /**
 * @author inilim
 *
 * @param int $curPage
 * @param int $limitOnePage
 * @param int $countRecords
 * @return array{
 * pageCount:int,
 * recordCount:int,
 * recordPerPage:int,
 * curPage:int,
 * offset:int,
 * next:?int,
 * prev:?int,
 * isLast:bool,
 * isFirst:bool
 * }
 */
    static function pagination(int $curPage, int $limitOnePage, int $countRecords) {}

        /**
 * @author Inilim
 * @return string
 */
    static function phpInput(): string {}

        /**
 * @author inilim
 * @template T of object
 * @param T|class-string<T> $scope
 * @param string[] $props
 * @return array<string,mixed>
 */
    static function propsFromScope($scope, array $props) {}

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
 * @author inilim
 * 
 * @template R of mixed
 * @template Time of int
 * @template Memory of int
 * 
 * @param callable():R $callable
 * @return array{result:R,time:Time,memory:Memory,"...":array{R,Time,Memory}}
 */
    static function timedMsCall(callable $callable): array {}

        /**
 * @author laravel
 * Conditionally compile classes from an array into a CSS class list.
 */
    static function toCssClasses(array $array): string {}

        /**
 * @author Laravel
 * Conditionally compile styles from an array into a style list.
 */
    static function toCssStyles(array $array): string {}

        /**
 * @author Inilim
 * @template C of mixed
 * @template D of mixed
 * @template A of mixed
 * 
 * @param callable(...A):C $callable
 * @param array<A> $args
 * @param D $default
 * @return array{result:C|D,exception:null|\Throwable,"...":array{C|D,null|\Throwable}}
 */
    static function tryCallCallable(callable $callable, array $args = [], $default = null) {}

        /**
 * @author Inilim
 * @template T of mixed
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return array{result:mixed|T,exception:null|\Throwable,"...":array{mixed|T,null|\Throwable}}
 */
    static function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null) {}

        /**
 * @author Inilim
 * @template TResult of mixed
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return ?TResult
 */
    static function tryCallWithErrHandler(callable $callable, ?callable $handler, int $errorLevels = \E_ALL) {}

        /**
 * @author Inilim
 * @return string
 */
    static function unprefixVar(string $name) {}

        /**
 * @author webmozarts/assert
 * @param mixed $value
 */
    static function valueToString($value): string {}

    }