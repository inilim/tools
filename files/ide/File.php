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
 * Delete the file at a given path.
 * @param  string[]|string  $paths
 */
    static function delete($paths): bool {}

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
    static function get(string $pathToFile, int $offset = 0, ?int $length = null, bool $useIncludePath = false, bool $throw = false, $context = null, ?array $contextParams = null): array {}

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param array{pathToFile:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
    static function getViaArray(array $params) {}

        /**
 * Determine if two files are the same by comparing their hashes.
 */
    static function hasSameHash(string $firstFile, string $secondFile): ?bool {}

        /**
 * Get the contents of a file as decoded JSON.
 * @param  mixed  $default
 * @return mixed
 * @phpstan-import-type get_throw from \File
 * @throws get_throw
 * @throws \JsonException
 */
    static function json(string $pathToFile, int $flags = 0, bool $lock = false, bool $throw = false, $default = null) {}

        /**
 * Get the contents of a file as decoded JSON.
 * @param array{pathToFile:string,flags?:int,lock?:bool,throw?:bool,default?:mixed} $params
 * @return mixed
 * @phpstan-import-type get_throw from \File
 * @throws get_throw
 * @throws \JsonException
 */
    static function jsonViaArray(array $params) {}

        /**
 * Get the contents of a file one line at a time.
 * @return \Closure():\Generator<string>
 * @throws \ValueError
 */
    static function lines(string $pathToFile): Closure {}

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
 * Get contents of a file with shared access.
 * @phpstan-import-type get_throw from \File
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
    static function sharedGet(string $pathToFile, bool $throw = false): array {}

        /**
 * Get the file size of a given file.
 * @return int<-1,max>
 */
    static function size(string $pathToFile): int {}

        /**
 * @author laravel from Number::fileSize
 * Convert the given number to its file size equivalent.
 * @param int|float $bytes
 * 
 * @throws \Exception
 * @throws \InvalidArgumentException
 */
    static function sizeConvert($bytes, int $precision = 0, ?int $maxPrecision = null, bool $useBinaryPrefix = false): string {}

        /**
 * @todo tests
 * @author Inilim
 * @return \Generator<array{iter:int,posFrom:int,posTo:int},string>
 */
    static function toCharsGenerator(string $pathToFile, int $chunk = 1): Generator {}

    }