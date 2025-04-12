<?php

namespace Inilim\Tool;

class File
{
        /**
 * @todo tests
 * @template TValue of string
 * @template TKey of string|int
 * @param TValue|iterable<TKey,TValue> $pathToFile
 * @return array{result:($pathToFile is iterable ? array<TKey,mixed> : mixed),exception:null|\Throwable}
 */
    static function cacheRead($pathToFile, bool $throw = false, bool $abortIfErr = false) {}

        /**
 * @todo tests
 * @param mixed $value
 * @param ?int $lifetime default 1 year in seconds
 * @return array{result:bool,exception:null|\ErrorException}
 * @throws \ErrorException
 */
    static function cacheSave(string $pathToFile, $value, ?int $lifetime = null, bool $throw = false) {}

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param null|resource|array $context
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
    static function get(string $filename, int $offset = 0, ?int $length = null, bool $useIncludePath = false, bool $throw = false, $context = null, ?array $contextParams = null) {}

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param array{filename:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
    static function getV2(array $params) {}

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_put_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @return array{result:int<-1,max>,exception:null|get_throw} return result -1 if error
 * @throws get_throw
 */
    static function put(string $filename, $data, int $flags = 0, bool $throw = false, $context = null, ?array $contextParams = null) {}

        /**
 * @todo tests
 * @author Inilim
 * @return \Generator<array{iter:int,posFrom:int,posTo:int},string>
 */
    static function toCharsGenerator(string $pathToFile, int $chunk = 1) {}

    }