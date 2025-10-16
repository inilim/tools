<?php

namespace Inilim\Tool;

class FS
{
        /**
 * Get or set UNIX mode of a file or directory.
 * @return mixed
 */
    static function chmod(string $path, ?int $mode = null) {}

        /**
 * Ensure a directory exists.
 * @todo tests
 * @author Inilim
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @param null|resource|array $context
 * @return array{result:?bool,exception:?THROW_get_0}
 * @throws THROW_get_0
 */
    static function ensureDirExists(string $path, bool $throw = false, int $mode = 0755, bool $recursive = true, $context = null, ?array $contextParams = null): array {}

        /**
 * Determine if a file or directory exists.
 */
    static function exists(string $path): bool {}

        /**
 * @author inilim
 */
    static function fileExists(string $filename): bool {}

        
    static function fileModeOctal(string $filename): ?string {}

        /**
 * @link https://php.net/manual/en/function.fileperms.php
 */
    static function filePerms(string $filename): ?int {}

        /**
 * @author inilim
 * @see https://www.php.net/manual/ru/function.fstat.php
 * @param resource $stream
 */
    static function fstat($stream): ?array {}

        /**
 * Gigabytes to Bytes
 */
    static function gbToBytes(int $gb): int {}

        /**
 * @author inilim
 */
    static function isDir(string $filename): bool {}

        /**
 * @author inilim
 */
    static function isFile(string $filename): bool {}

        /**
 * Kilobytes to Bytes
 */
    static function kbToBytes(int $kb): int {}

        /**
 * Create a directory.
 * @todo tests
 * @author Inilim
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @param null|resource|array $context
 * @return array{result:?bool,exception:?THROW_get_0}
 * @throws THROW_get_0
 */
    static function makeDir(string $path, bool $throw = false, int $mode = 0755, bool $recursive = false, bool $force = false, $context = null, ?array $contextParams = null): array {}

        /**
 * Create a directory.
 * @todo tests
 * @author Inilim
 * 
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @param array{path:string,mode?:int,recursive?:bool,force?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:?bool,exception:?THROW_get_0}
 * @throws THROW_get_0
 */
    static function makeDirViaArray(array $params): array {}

        /**
 * Megabytes to Bytes
 */
    static function mbToBytes(int $mb): int {}

        /**
 * Determine if a file or directory is missing.
 */
    static function missing(string $path): bool {}

        /**
 * Move a file to a new location.
 */
    static function move(string $path, string $target): bool {}

        /**
 * @link https://php.net/manual/en/function.glob.php
 * @param \GLOB_* $flags
 * @return string[]|null
 */
    static function phpGlob(string $pattern, int $flags = 0): ?array {}

        /**
 * @author inilim
 * @see https://www.php.net/manual/ru/function.stat.php
 * @return null|array{dev: int, ino: int, mode: int, nlink: int, uid: int, gid: int, rdev: int, size: int, atime: int, mtime: int, ctime: int, blksize: int, blocks: int}
 */
    static function stat(string $filename): ?array {}

        /**
 * @author inilim
 * @param ?resource $context
 */
    static function unlink(string $filename, $context = null): bool {}

    }