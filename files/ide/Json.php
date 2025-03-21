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

        /**
 * @return integer
 */
    static function getLastErrorCode() {}

        /**
 * @return string
 */
    static function getLastErrorMsg() {}

        /**
 * gettype - вернет null если json не валидный
 * @return ?string
 */
    static function getTypeFromJson(?string $v) {}

        /**
 * @return bool
 */
    static function hasError() {}

        /**
 * @return boolean
 */
    static function isJson(?string $v) {}

        /**
 * @return bool
 */
    static function isJsonAsArrList(?string $v) {}

        /**
 * @return bool
 */
    static function isJsonAsArrOrObj(?string $v) {}

        /**
 * @return boolean
 */
    static function isJsonAsFloat(?string $v) {}

        /**
 * @return bool
 */
    static function isJsonAsInteger(?string $v) {}

        /**
 * @return bool
 */
    static function isJsonAsNumeric(?string $v) {}

        /**
 * @return bool
 */
    static function isJsonAsObject(?string $v) {}

        /**
 * @return boolean
 */
    static function isJsonAsString(?string $v) {}

        /**
 * @param mixed $v
 * @return bool
 */
    static function isJsonSerializable($v, int $flags = 0, int $depth = 512) {}

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
 * @return mixed[]|T
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