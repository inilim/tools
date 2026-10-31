<?php

namespace Inilim\Tool;

class File
{
        /**
 * @todo tests
 * @template TValue of string
 * @template TKey of string|int
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param TValue|iterable<TKey,TValue> $pathToFile
 * @return array{result:($pathToFile is iterable ? array<TKey,mixed> : mixed),exception:null|TYPE_EXCEPTION_ITERATOR}
 */
    static function cacheRead($pathToFile, bool $throw = false, bool $abortIfErr = false) {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @param mixed $value
 * @param ?int $lifetime default 1 year in seconds
 * @return array{result:bool,exception:null|\ErrorException}
 * @throws \ErrorException
 */
    static function cacheSave(string $pathToFile, $value, ?int $lifetime = null, bool $throw = false) {
        throw new \Exception;
    }

        /**
 * @author Laravel
 * Delete the file at a given path.
 * @param  string[]|string  $paths
 */
    static function delete($paths): bool {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author Inilim
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @return array{result:-1,exception:TYPE_EXCEPTION_ITERATOR}|array{result:int<0,max>,exception:null}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function ensurePut(string $filename, $data, int $flags = 0, bool $throw = false, int $mode = 0755, $context = null, ?array $contextParams = null): array {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * 
 * 
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @psalm-import-type Return_get from \TypeFile
 * 
 * 
 * @param null|resource|array $context
 * @return Return_get
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function get(string $pathToFile, int $offset = 0, ?int $length = null, bool $useIncludePath = false, bool $throw = false, $context = null, ?array $contextParams = null): array {
        throw new \Exception;
    }

        /**
 * Get the returned value of a file.
 *
 * @param string[] $pathToFiles
 * @param mixed[] $data
 * @return array<string,mixed>
 * @throws \Exception
 */
    static function getBulkRequire(array $pathToFiles, array $data = [], bool $once = false): array {
        throw new \Exception;
    }

        /**
 * Get the returned value of a file.
 *
 * @param mixed[] $data
 * @return mixed
 * @throws \Exception
 */
    static function getRequire(string $pathToFile, array $data = [], bool $once = false) {
        throw new \Exception;
    }

        /**
 * Get the returned value of a file.
 *
 * @param mixed[] $data
 * @return mixed
 * @throws \Exception
 */
    static function getRequireOnce(string $pathToFile, array $data = []) {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * 
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @psalm-import-type Return_get from \TypeFile
 * 
 * @param array{pathToFile:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return Return_get
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function getViaArray(array $params): array {
        throw new \Exception;
    }

        /**
 * Determine if two files are the same by comparing their hashes.
 */
    static function hasSameHash(string $firstFile, string $secondFile): ?bool {
        throw new \Exception;
    }

        /**
 * Get the contents of a file as decoded JSON.
 * @param  mixed  $default
 * @param  int  $flags json_decode flags
 * @return mixed
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @throws TYPE_EXCEPTION_ITERATOR
 * @throws \JsonException
 */
    static function json(string $pathToFile, int $flags = 0, bool $lock = false, bool $throw = false, $default = null) {
        throw new \Exception;
    }

        /**
 * Get the contents of a file as decoded JSON.
 * @param array{pathToFile:string,flags?:int,lock?:bool,throw?:bool,default?:mixed} $params
 * @return mixed
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @throws TYPE_EXCEPTION_ITERATOR
 * @throws \JsonException
 */
    static function jsonViaArray(array $params) {
        throw new \Exception;
    }

        /**
 * @deprecated use lines_v2()
 * Get the contents of a file one line at a time.
 * @return \Closure():\Generator<string>
 * @throws \InvalidArgumentException
 */
    static function lines(string $pathToFile): Closure {
        throw new \Exception;
    }

        /**
 * Get the contents of a file one line at a time.
 * @return \Generator<int,string>
 * @throws \InvalidArgumentException
 */
    static function lines_v2(string $pathToFile, int $startLine = 0): Generator {
        throw new \Exception;
    }

        /**
 * Closes an open file pointer
 * @link https://php.net/manual/en/function.fclose.php
 * @param resource $stream
 */
    static function phpfclose($stream): bool {
        throw new \Exception;
    }

        /**
 * Opens file or URL
 * @link https://php.net/manual/en/function.fopen.php
 * @param resource $stream
 * @param ?resource $context
 * @return resource|false
 */
    static function phpfopen(string $filename, string $mode, bool $use_include_path = false, $context = null) {
        throw new \Exception;
    }

        /**
 * Binary-safe file read
 * @link https://php.net/manual/en/function.fread.php
 * @param resource $stream
 * @return string|false
 */
    static function phpfread($stream, int $length) {
        throw new \Exception;
    }

        /**
 * Seeks on a file pointer
 * @link https://php.net/manual/en/function.fseek.php
 * @param resource $stream
 */
    static function phpfseek($stream, int $offset, int $whence = \SEEK_SET): int {
        throw new \Exception;
    }

        /**
 * Returns the current position of the file read/write pointer
 * @link https://php.net/manual/en/function.ftell.php
 * @param resource $stream
 * @return int|false
 */
    static function phpftell($stream) {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_put_contents"
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @return array{result:int<0,max>,exception:null}|array{result:-1,exception:TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function put(string $filename, $data, int $flags = 0, bool $throw = false, $context = null, ?array $contextParams = null): array {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author Inilim
 * analog function "file_put_contents"
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * 
 * @param array{filename:string,data:mixed,flags?:int,context?:resource,contextParams?:array,throw?:bool} $params
 * @return array{result:int<0,max>,exception:null}|array{result:-1,exception:TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function putViaArray(array $params): array {
        throw new \Exception;
    }

        /**
 * Get contents of a file with shared access.
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @return array{result:string,exception:null}|array{result:null,exception:TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function sharedGet(string $pathToFile, bool $throw = false): array {
        throw new \Exception;
    }

        /**
 * Get the file size of a given file.
 * @return int<-1,max>
 */
    static function size(string $pathToFile): int {
        throw new \Exception;
    }

        /**
 * @author laravel from Number::fileSize
 * Convert the given number to its file size equivalent.
 * @param int|float $bytes
 * 
 * @throws \Exception
 * @throws \InvalidArgumentException
 * 
 * @ext intl
 */
    static function sizeConvert($bytes, int $precision = 0, ?int $maxPrecision = null): string {
        throw new \Exception;
    }

        /**
 * @todo tests rename
 * @deprecated use toCharsGenerator_v2()
 * @ext mbstring
 * @author Inilim
 * @return \Generator<array{iter:int,posFrom:int,posTo:int},string>
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
    static function toCharsGenerator(string $pathToFile, int $chunk = 1): Generator {
        throw new \Exception;
    }

        /**
 * @todo rename / убрать зависимость mbstring
 * @ext mbstring
 * @author Inilim
 * @return \Closure():\Generator<array{iter:int,posFrom:int,posTo:int},string>
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
    static function toCharsGenerator_v2(string $pathToFile, int $chunk = 1): Closure {
        throw new \Exception;
    }

        /**
 * Get the contents of a file as serialize.
 * @todo tests
 * @author inilim
 * @param  mixed  $default
 * @return mixed
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function unserialize(string $pathToFile, array $options = [], bool $lock = false, bool $throw = false, $default = null) {
        throw new \Exception;
    }

        /**
 * Get the contents of a file as serialize.
 * @todo tests
 * @author inilim
 * @param array{pathToFile:string,options?:int,lock?:bool,throw?:bool,default?:mixed} $params
 * @return mixed
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @throws TYPE_EXCEPTION_ITERATOR
 */
    static function unserializeAsArray(array $params) {
        throw new \Exception;
    }

    }