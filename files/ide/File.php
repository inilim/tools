<?php

namespace Inilim\Tool;

class File
{
   /**
    * @template TValue of string
    * @template TKey of string|int
    * @param TValue|iterable<TKey,TValue> $pathToFile
    * @param ?\Throwable $e
    * @return ($pathToFile is iterable ? array<TKey,mixed> : mixed)
    */
   static function cacheRead($pathToFile, bool $throw = false, bool $abortIfErr = false, &$e = null) {}

   /**
    * @param mixed $value
    * @param ?int $lifetime default 1 year in seconds
    * @param ?\Throwable $e
    * @return bool
    * @throws \ErrorException
    */
   static function cacheSave(string $pathToFile, $value, ?int $lifetime = null, bool $throw = false, &$e = null) {}

   /**
    * analog function "file_get_contents"
    * @phpstan-import-type get_throw from \File
    * @see https://www.php.net/manual/ru/function.file-get-contents.php
    * @param null|resource|array $context
    * @param ?get_throw $e
    * @return null|string
    * @throws get_throw
    */
   static function get(string $filename, int $offset = 0, ?int $length = null, bool $useIncludePath = false, bool $throw = false, &$e = null, $context = null, ?array $contextParams = null) {}

   /**
    * analog function "file_get_contents"
    * @phpstan-import-type get_throw from \File
    * @see https://www.php.net/manual/ru/function.file-get-contents.php
    * @param array{filename:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,e?:get_throw|null,context?:resource|array,contextParams?:array} $params
    * @return null|string
    * @throws get_throw
    */
   static function getV2(array $params) {}

   /**
    * analog function "file_put_contents"
    * @phpstan-import-type get_throw from \File
    * @see https://www.php.net/manual/ru/function.file-put-contents.php
    * @param mixed $data
    * @param null|resource|array $context
    * @param null|array $contextParams
    * @param ?get_throw $e
    * @return int<-1,max> return -1 if error
    * @throws get_throw
    */
   static function put(string $filename, $data, int $flags = 0, bool $throw = false, &$e = null, $context = null, ?array $contextParams = null) {}
}
