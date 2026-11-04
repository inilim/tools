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
    static function _refDots(array $array): array {
        throw new \Exception;
    }

        /**
 * @author https://github.com/shipfastlabs/agent-detector/
 * @author inilim
 * 
 * @ext mbstring
 * 
 * @return array{status:bool,name:?string}
 */
    static function agentDetector(): array {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @return array<array{file:string|null,line:int|null,method:string|null,type:string|null,class:class-string|null,object:object|null,args:mixed[]|null}>
 */
    static function backtrace(int $limit = 0, int $reset = 0, int $flags = \DEBUG_BACKTRACE_IGNORE_ARGS, bool $reverse = true) {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @template R
 * @template A
 * @param \Closure(A):R $callback
 * @param A ...$args
 * @return R
 */
    static function bindAndCall(object $object, \Closure $callback, ...$args) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @param class-string $class
 */
    static function classPhp(string $class, bool $rechecking = false, bool $autoload = true): bool {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @template T of \Closure
 * @param T $cls
 * @return ?T
 */
    static function clearClosure(\Closure $cls): ?Closure {
        throw new \Exception;
    }

        /**
 */
    static function colorHexToAnsi(string $hex): int {
        throw new \Exception;
    }

        /**
 * @author google/ai
 * @todo add assert len $hex 3 or 6
 *
 * @return array{red:int,green:int,blue:int}
 */
    static function colorHexToRgb(string $hex): array {
        throw new \Exception;
    }

        /**
 */
    static function colorRgbToHex(int $red, int $green, int $blue, bool $withGrid = false): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param string $colorHexText
 * @param string|null $colorHexBackground
 * @param 'bold'|'un_bold'|'dim'|'un_dim'|'underlined'|'un_underlined'|'blink'|'un_blink'|'reverse'|'un_reverse'|'hidden'|'un_hidden'|null $style
 */
    static function colorStrCli(string $text, string $colorHexText, ?string $colorHexBackground = null, ?string $style = null): string {
        throw new \Exception;
    }

        /**
 * @author nette/utils
 * Compares two values in the same way that PHP does. Recognizes operators: >, >=, <, <=, =, ==, ===, !=, !==, <>
 * @param mixed $left
 * @param mixed $right
 */
    static function compareViaOperator($left, string $operator, $right): bool {
        throw new \Exception;
    }

        /**
 * Data from \Composer\InstalledVersions::getInstalledPackages()
 * @author inilim
 * @todo tests
 * @return string[]|mixed[]|null
 */
    static function composerInstalledPackages(): ?array {
        throw new \Exception;
    }

        /**
 * Data from \Composer\InstalledVersions::getRootPackage()
 * @author inilim
 * @todo tests
 * @return mixed[]|null
 */
    static function composerRootPackage(): ?array {
        throw new \Exception;
    }

        /**
 * @author guzzle/guzzle
 * 
 * Returns the default cacert bundle for the current system.
 *
 * First, the openssl.cafile and curl.cainfo php.ini settings are checked.
 * If those settings are not configured, then the common locations for
 * bundles found on Red Hat, CentOS, Fedora, Ubuntu, Debian, FreeBSD, OS X
 * and Windows are checked. If any of these file locations are found on
 * disk, they will be utilized.
 *
 * Note: the result of this function is cached for subsequent calls.
 *
 * @throws \Exception if no bundle can be found.
 *
 * INFO defaultCaBundle will be removed in guzzlehttp/guzzle:8.0. This method is not needed in PHP 5.6+.
 */
    static function defaultCaBundle(): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * is not php function \error_clear_last()
 */
    static function errorClearLast(): void {
        throw new \Exception;
    }

        /**
 * @author inilim
 * is not php function \error_get_last()
 * @return null|array{type:int,message:string,file:string,line:int}
 */
    static function errorGetLast(): ?array {
        throw new \Exception;
    }

        /**
 * @api
 * @author https://github.com/thesis-php/exceptionally
 *
 * @template T
 * @param callable(): (T|false) $function
 * @return T
 * @throws \ErrorException
 */
    static function exceptionally(callable $function, int $errorLevels = \E_ALL & ~\E_DEPRECATED & ~\E_USER_DEPRECATED) {
        throw new \Exception;
    }

        /**
 * @author inilim
 */
    static function extPhp(string $ext, bool $rechecking = false): bool {
        throw new \Exception;
    }

        /**
 * @author inilim
 */
    static function funcPhp(string $function, bool $rechecking = false): bool {
        throw new \Exception;
    }

        /**
 * @tests tests/Method/Other/getCallableThisTest.php
 * @author inilim
 */
    static function getCallableThis(callable $callable): ?object {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * 
 * @return null|class-string
 */
    static function getClosureScopeClass(\Closure $cls): ?string {
        throw new \Exception;
    }

        /**
 * @author Internet
 * @return ?callable
 */
    static function getErrorHandler() {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @template T of \Throwable
 * @param T $e
 * @return array{message:string,line:int,code:int|string,file:string,trace:($traceAsArray is true ? mixed[] : string),class:class-string<T>}
 */
    static function getExceptionDetails(\Throwable $e, bool $traceAsArray = false, bool $dots = false): array {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @param resource $resource
 */
    static function getPathFromResource($resource): ?string {
        throw new \Exception;
    }

        /**
 * @param resource $value
 * @return int return -1 if failed
 */
    static function getSizeResource($value): int {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @see https://php.net/manual/en/function.gettype.php
 * 
 * @param mixed $v
 * @param bool $trueFalseAsSeparateType if true type bool as 'true'|'false'
 * @return ($trueFalseAsSeparateType is true ? 'null'|'array'|'float'|'enum'|'exception'|'object'|'true'|'false'|'int'|'string'|'resource'|'resource_closed'|'unknown_type' : 'null'|'array'|'float'|'enum'|'exception'|'object'|'bool'|'int'|'string'|'resource'|'resource_closed'|'unknown_type')
 */
    static function getType($v, bool $trueFalseAsSeparateType = false): string {
        throw new \Exception;
    }

        /**
 * @todo to check
 * @author Inilim
 * @param class-string|object ...$classes
 */
    static function instanceOfAll(object $obj, ...$classes): bool {
        throw new \Exception;
    }

        /**
 * @todo to check
 * @author Inilim
 * @param (class-string|object)[] $classes
 */
    static function instanceOfAllArray(object $obj, array $classes): bool {
        throw new \Exception;
    }

        /**
 * @todo to check
 * @author Inilim
 * @param class-string|object ...$classes
 */
    static function instanceOfAny(object $obj, ...$classes): bool {
        throw new \Exception;
    }

        /**
 * @todo to check
 * @author Inilim
 * @param (class-string|object)[] $classes
 */
    static function instanceOfAnyArray(object $obj, array $classes): bool {
        throw new \Exception;
    }

        /**
 * @todo to check
 * @author Inilim
 * @param mixed $v
 */
    static function isEnum($v): bool {
        throw new \Exception;
    }

        /**
 * [EN] the function checks whether the library is in the cloning state.
 * [RU] функция проверяет, находится ли библиотека в состоянии клонирования.
 * @author inilim
 * @todo tests
 */
    static function itLibClone(): bool {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @param callable(int $curIteration,int $maxIterations):bool $condition
 * @param callable(int $curIteration,int $maxIterations) $onBreak
 */
    static function iterateWhile(callable $condition, int $maxIterations = 5, ?callable $onBreak = null): void {
        throw new \Exception;
    }

        /**
 * @author inilim
 * as iterator_to_array, but, without forming an array
 */
    static function iteratorToDevNull(\Traversable $iterator): void {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @template T of object
 * @param T|class-string<T> $scope
 * @param string $method
 * @param mixed[] $args
 * @return mixed
 */
    static function methodFromScope($scope, string $method, array $args = []) {
        throw new \Exception;
    }

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
    static function pagination(int $curPage, int $limitOnePage, int $countRecords): array {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 */
    static function phpInfo(int $flags = \INFO_ALL): ?string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 */
    static function phpInfoCache(int $flags = \INFO_ALL, bool $fresh = false): ?string {
        throw new \Exception;
    }

        /**
 * php://input
 * @author Inilim
 */
    static function phpInput(): string {
        throw new \Exception;
    }

        /**
 * Возвращает отпечаток текущего PHP-рантайма.
 *
 * Учитывает всё, что влияет на конфигурацию исполнения:
 *  - SAPI (cli, fpm-fcgi, apache2handler, ...)
 *  - путь к бинарнику
 *  - версию PHP
 *  - загруженный php.ini и просканированные доп. .ini
 */
    static function phpRuntimeFingerprint(): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @template T of object
 * @param T|class-string<T> $scope
 * @param string[] $props
 * @return array<string,mixed>
 */
    static function propsFromScope($scope, array $props): array {
        throw new \Exception;
    }

        /**
 * @author Internet
 * @return array<string,string>
 */
    static function requestHeaders(?array $_server = null) {
        throw new \Exception;
    }

        /**
 * @author Symfony
 * @deprecated use requestHeaders_m2
 * @return array<string,string>
 */
    static function requestHeadersV2(?array $_server = null): array {
        throw new \Exception;
    }

        /**
 * @author Symfony
 * @return array<string,string>
 */
    static function requestHeaders_m2(?array $_server = null): array {
        throw new \Exception;
    }

        /**
 * @author Internet
 * @return string
 */
    static function requestMethod(): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * @param resource $resource
 * @param string $pathToFile file overwrite
 */
    static function resourceContentWriteToFile($resource, string $pathToFile): ?string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * @param resource $resource
 */
    static function resourceContentWriteToTmpFile($resource): ?string {
        throw new \Exception;
    }

        /**
 * via php://temp
 * @author inilim
 * @todo tests
 * @return resource|false
 */
    static function resourceFromString(string $string) {
        throw new \Exception;
    }

        /**
 * via tmpfile()
 * @author inilim
 * @todo tests
 * @return resource|false
 */
    static function resourceFromString_m2(string $string) {
        throw new \Exception;
    }

        /**
 * via create file
 * @author inilim
 * @todo tests
 * @return resource|false
 */
    static function resourceFromString_m3(string $string) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 */
    static function sqliteLibVersion(): ?string {
        throw new \Exception;
    }

        /**
 * INFO phpinfo берем из кеш файла
 * @author inilim
 * @todo tests
 */
    static function sqliteLibVersion_m2(bool $fresh = false): ?string {
        throw new \Exception;
    }

        /**
 * INFO version берем из обьекта \PDO
 * @author inilim
 * @todo tests
 * @ext pdo pdo_sqlite
 */
    static function sqliteLibVersion_m3(): ?string {
        throw new \Exception;
    }

        /**
 * @author https://github.com/kylekatarnls
 * @todo tests
 * @throws \InvalidArgumentException
 * @throws \ValueError
 */
    static function throwValueErrorIfAvailable($message = '', $code = 0, ?\Throwable $previous = null): void {
        throw new \Exception;
    }

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
    static function timedMsCall(callable $callable): array {
        throw new \Exception;
    }

        /**
 * @author laravel
 * Conditionally compile classes from an array into a CSS class list.
 */
    static function toCssClasses(array $array): string {
        throw new \Exception;
    }

        /**
 * @author Laravel
 * Conditionally compile styles from an array into a style list.
 */
    static function toCssStyles(array $array): string {
        throw new \Exception;
    }

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
    static function tryCallCallable(callable $callable, array $args = [], $default = null): array {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @template T of mixed
 * @param T $default
 * @param object|class-string $objectOrClass
 * @return array{result:mixed|T,exception:null|\Throwable,"...":array{mixed|T,null|\Throwable}}
 */
    static function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null): array {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @template TResult
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return ?TResult
 */
    static function tryCallWithErrHandler(callable $callable, ?callable $handler, int $errorLevels = \E_ALL) {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @template TResult
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return ?TResult
 */
    static function tryCallWithErrHandler_m2(callable $callable, ?callable $handler = null, int $errorLevels = \E_ALL) {
        throw new \Exception;
    }

        /**
 * @author guzzle/guzzle
 * Safely opens a PHP stream resource using a filename.
 *
 * When fopen fails, PHP normally raises a warning. This function adds an
 * error handler that checks for errors and throws an exception instead.
 *
 * @param string $filename File to open
 * @param string $mode     Mode used to open the file
 *
 * @return resource
 *
 * @throws \RuntimeException if the file cannot be opened
 */
    static function tryFopen(string $filename, string $mode) {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * @return string
 */
    static function unprefixVar(string $name) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @param mixed $value
 */
    static function valueToString($value): string {
        throw new \Exception;
    }

    }