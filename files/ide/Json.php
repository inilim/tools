<?php

namespace Inilim\Tool;

class Json
{
        /**
 * @param mixed $default
 * @return mixed
 */
    static function dataGetFromJson(?string $json, string $dotKey, $default = null) {}

        /**
 * @return mixed
 */
    static function decode(string $v, ?bool $associative = null, int $depth = 512, int $flags = 0) {}

        /**
 * @param mixed $v
 * @return string|false
 */
    static function encode($v, int $flags = 0, int $depth = 512) {}

        /**
 * @return array{code:int,msg:string}
 */
    static function getLastError() {}

        
    static function getLastErrorCode(): int {}

        /**
 * @return string
 */
    static function getLastErrorMsg() {}

        /**
 * вернет null если json не валидный
 * @return ?string
 */
    static function getNativeTypeFromJson(?string $v): ?string {}

        /**
 * вернет null если json не валидный
 * @return ?string
 */
    static function getTypeFromJson(?string $v): ?string {}

        
    static function hasError(): bool {}

        /**
 * @deprecated use Check::isJson()
 */
    static function isJson(?string $v): bool {}

        /**
 * @deprecated use Check::isJson()
 */
    static function is(?string $v): bool {}

        
    static function isJsonAsArrList(?string $v): bool {}

        
    static function isJsonAsArrOrObj(?string $v): bool {}

        
    static function isJsonAsFloat(?string $v): bool {}

        
    static function isJsonAsInteger(?string $v): bool {}

        
    static function isJsonAsNativeNumeric(?string $v): bool {}

        
    static function isJsonAsNumeric(?string $v): bool {}

        
    static function isJsonAsObject(?string $v): bool {}

        
    static function isJsonAsString(?string $v): bool {}

        /**
 * @param mixed $v
 */
    static function isJsonSerializable($v, int $flags = 0, int $depth = 512): bool {}

        /**
 * @author <http://stackoverflow.com/questions/6054033/pretty-printing-json-with-php>
 * @todo tests
 * @param string $json A JSON formatted object definition
 * @return string The nicely formatted JSON definition
 */
    static function prettyPrint(string $json) {}

        /**
 * the method does not throw exceptions JsonException, instead it returns the default value
 * 
 * @template T
 * @param T $default
 * @return mixed|T
 */
    static function tryDecode(string $v, ?bool $associative = null, int $depth = 512, int $flags = 0, $default = null) {}

        /**
 * @template T of mixed
 * @param T $default
 * @return list<mixed>|T
 */
    static function tryDecodeAsArrList(?string $v, $default = null) {}

        /**
 * object to array
 * 
 * @template T
 * @param T $default
 * @return array<int|string,mixed>|T
 */
    static function tryDecodeAsArray(?string $v, $default = null) {}

        /**
 * @template T of mixed
 * @param T $default
 * @return float|T
 */
    static function tryDecodeAsFloat(?string $v, $default = null) {}

        /**
 * @template T of mixed
 * @param T $default
 * @return int|T
 */
    static function tryDecodeAsInteger(?string $v, $default = null) {}

        /**
 * @template T of mixed
 * @param T $default
 * @return int|float|numeric-string|T
 */
    static function tryDecodeAsNumeric(?string $v, $default = null) {}

        /**
 * @template T of mixed
 * @param T $default
 * @return object|T
 */
    static function tryDecodeAsObject(?string $v, $default = null) {}

        /**
 * @template T of mixed
 * @param T $default
 * @return string|T
 */
    static function tryDecodeAsString(?string $v, $default = null) {}

        /**
 * the method does not throw exceptions JsonException, instead it returns the default value
 * 
 * @template T of mixed
 * @param T $default return default if failed encode
 * @param mixed $v
 * @return string|T
 */
    static function tryEncode($v, int $flags = 0, int $depth = 512, $default = null) {}

    }